<?php

namespace App\Http\Controllers\Admin;

use App\Enum\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyPeriod;
use App\Models\Period;
use App\Models\RegistrationSupportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FamilyRegistrationController extends Controller
{
    public function index()
    {
        $periods = Period::orderby('date_end', 'desc')
            ->where('ward_id', auth()->user()->info->ward_id)
            ->paginate(config('constants.limit_page'));
        return view('admin.family-registration.index', compact('periods'));
    }

    public function detail($periodId)
    {
        $wardId = auth()->user()->info->ward_id;
        $families = Family::where('ward_id', $wardId)->get();
        $period = Period::where('id', $periodId)->first();
        if ($period->families->count() > 0) {
            $family_registrations = FamilyPeriod::where('period_id', $period->id)
                ->whereHas('period', function ($query) use ($wardId) {
                    $query->where('ward_id', $wardId);
                })->with('period', function ($query) use ($wardId) {
                    $query->where('ward_id', $wardId);
                })->get();
            $registrationSupports = RegistrationSupportDetail::query()
                ->whereHas('registration', function ($query) use ($period) {
                    $query->where('period_id', $period->id)
                        ->whereNotIn('status', [RegistrationStatus::CANCEL, RegistrationStatus::PROCESSING]);
                })->with('registration', function ($query) use ($period) {
                    $query->where('period_id', $period->id)
                        ->whereNotIn('status', [RegistrationStatus::CANCEL, RegistrationStatus::PROCESSING]);
                })->get();
            $total_money = $registrationSupports->whereNotNull('money')->sum('money');
            $registrationGoods = $registrationSupports->whereNull('money')->groupBy('goods_id')->map(function ($item) {
                $temp = $item->first();
                $temp['qty_total'] = $item->sum('qty');
                return $temp;
            });
            return view('admin.family-registration.registered', compact('family_registrations', 'period', 'registrationGoods', 'total_money'));
        }
        return view('admin.family-registration.detail', compact('families', 'period'));
    }

    public function register(Request $request, $periodId)
    {
        if (!$request->families || count($request->families) === 0) {
            return back()->with('alert-fail', 'Số lượng chưa phù hợp');
        };
        try {
            DB::transaction(function () use ($request, $periodId) {
                foreach ($request->families as $key => $item) {
                    FamilyPeriod::create([
                        'family_id' => $key,
                        'period_id' => $periodId,
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
