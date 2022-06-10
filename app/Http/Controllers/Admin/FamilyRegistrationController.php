<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyPeriod;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FamilyRegistrationController extends Controller
{
    public function index()
    {
        $wardId = auth()->user()->info->ward_id;
        $families = Family::where('ward_id', $wardId)->get();
        $period = Period::where('date_end', '>=', now())->where('ward_id', $wardId)->first();
        if (is_null($period)) {
        }
        if ($period->families->count() > 0) {
            $family_registrations = FamilyPeriod::where('period_id', $period->id)
                ->whereHas('period', function($query) use ($wardId) {
                    $query->where('ward_id', $wardId);
                })->with('period', function($query) use ($wardId) {
                    $query->where('ward_id', $wardId);
                })->get();
            return view('admin.family-registration.registered', compact('family_registrations', 'period'));
        }
        return view('admin.family-registration.index', compact('families', 'period'));
    }

    public function register(Request $request)
    {
        if (!$request->families || count($request->families) === 0) {
            return back()->with('alert-fail', 'Số lượng chưa phù hợp');
        };
        try {
            DB::transaction(function () use ($request) {
                $period = Period::where('date_end', '>=', now())->where('ward_id', auth()->user()->info->ward_id)->first();
                foreach ($request->families as $key => $item) {
                    FamilyPeriod::create([
                        'family_id' => $key,
                        'period_id' => $period->id,
                        'description' => $request->families_desc[$key]
                    ]);
                }
            });
            return back()->with('alert-success', 'Đăng ký thành công');
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('alert-fail', 'Đăng ký thất bại');
        }
    }
}
