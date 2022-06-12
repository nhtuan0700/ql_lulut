<?php

namespace App\Http\Controllers\Admin;

use App\Enum\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\FamilyPeriod;
use App\Models\Period;
use App\Models\RegistrationSupportDetail;
use Illuminate\Http\Request;

class HandoverController extends Controller
{
    public function index()
    {
        $periods = Period::orderby('date_end', 'desc')
            ->orderby('status', 'asc')
            ->paginate(config('constants.limit_page'));
        return view('admin.handover.index', compact('periods'));
    }

    public function detail($periodId)
    {
        $period = Period::where('id', $periodId)->first();
        $family_registrations = FamilyPeriod::where('period_id', $period->id)
            ->whereHas('period', function ($query) use ($period) {
                $query->where('ward_id', $period->ward_id);
            })->with('period', function ($query) use ($period) {
                $query->where('ward_id', $period->ward_id);
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
        return view('admin.handover.detail', compact('family_registrations', 'period', 'registrationGoods', 'total_money'));
    }

    public function handover($periodId)
    {
        $period = Period::where('id', $periodId)->first();
        $period->update([
            'status' => 1,
        ]);
        return back()->with('alert-success', 'Bàn giao thành công');
    }

    public function print($periodId)
    {
        $period = Period::where('id', $periodId)->first();
        $family_registrations = FamilyPeriod::where('period_id', $period->id)
            ->whereHas('period', function ($query) use ($period) {
                $query->where('ward_id', $period->ward_id);
            })->with('period', function ($query) use ($period) {
                $query->where('ward_id', $period->ward_id);
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
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML(view('admin.handover.print', compact('family_registrations', 'period', 'registrationGoods', 'total_money')));
        return $pdf->stream();
    }
}
