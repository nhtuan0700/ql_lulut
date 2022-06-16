<?php

namespace App\Http\Controllers\Admin;

use App\Enum\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyHandover;
use App\Models\FamilyPeriod;
use App\Models\Period;
use App\Models\RegistrationSupportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyHandoverController extends Controller
{
    public function index()
    {
        $periods = Period::orderby('date_end', 'desc')
            ->where('ward_id', auth()->user()->info->ward_id)
            ->paginate(config('constants.limit_page'));
        return view('admin.family-handover.index', compact('periods'));
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
            $familyHandovers = Family::query()
                ->whereHas('handovers', function ($query) use ($periodId) {
                    $query->where('period_id', $periodId);
                })
                ->get();
            if ($period->status === 0 ) {
                return view('admin.family-handover.unhandover', compact('familyHandovers', 'period', 'registrationGoods', 'total_money'));
            }
            if ($familyHandovers->count() > 0) {
                return view('admin.family-handover.handovered', compact('familyHandovers', 'period', 'registrationGoods', 'total_money'));
            }
            return view('admin.family-handover.registered', compact('family_registrations', 'period', 'registrationGoods', 'total_money'));
        }
        return redirect(route('admin.family_registration.detail', ['periodId' => $periodId]));
    }

    public function handover(Request $request, $periodId)
    {
        $wardId = auth()->user()->info->ward_id;
        $period = Period::where('id', $periodId)->first();
        DB::transaction(function () use ($request, $period) {
            foreach ($request->family as $fanilyId => $familyItem) {
                if ($familyItem['money']) {
                    FamilyHandover::create([
                        'family_id' => $fanilyId,
                        'period_id' => $period->id,
                        'money' => $familyItem['money']
                    ]);
                }
                if ($familyItem['goods']) {
                    foreach ($familyItem['goods'] as $goodsId => $qty) {
                        if ($qty > 0) {
                            FamilyHandover::create([
                                'period_id' => $period->id,
                                'family_id' => $fanilyId,
                                'goods_id' => $goodsId,
                                'qty' => $qty
                            ]);
                        }
                    }
                }
            }

            $period->update([
                'status' => 2
            ]);
        });

        return back()->with('alert-success', 'Bàn giao thành công');
    }
}
