<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Period;
use Illuminate\Http\Request;

class HandoverHistoryController extends Controller
{
    public function index()
    {
        $periods = Period::orderby('date_end', 'desc')
            ->whereHas('families', function ($query) {
                $query->where('ward_id', auth()->user()->info->ward_id);
            })
            ->where('ward_id', auth()->user()->info->ward_id)
            ->paginate(config('constants.limit_page'));
        return view('admin.handover_history.index', compact('periods'));
    }

    public function detail($periodId)
    {
        $period = Period::find($periodId);
        $family = Family::where('user_id', auth()->id())->first();
        $handovers = $family->handovers()->where('period_id', $periodId)->get();
        
        if ($handovers->count() > 0) {
            $money = $handovers->whereNotNull('money')->pluck('money')->first();
            $goodsDetail = $handovers->whereNull('money');
            return view('admin.handover_history.handovered', compact('period', 'money', 'goodsDetail'));
        }
        return view('admin.handover_history.unhandover');
    }
}
