<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Period\StorePeriod;
use App\Http\Requests\Period\UpdatePeriod;
use App\Models\Period;
use App\Models\Ward;
use Carbon\Carbon;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderby('date_end', 'desc')->paginate(config('constants.limit_page'));
        return view('admin.period.index', compact('periods'));
    }

    public function create()
    {
        $wards = Ward::with(['periods' => function ($query) {
            $query->whereDate('date_end', '>=', now());
        }])->get();
        return view('admin.period.create', compact('wards'));
    }

    public function store(StorePeriod $request)
    {
        if (Carbon::createFromFormat('d/m/Y', $request->date_end)->format('Y-m-d') <= now()) {
            return back()->with('alert-fail', 'Ngày kết thúc chưa phù hợp');
        }
        $new_period = Period::create([
            'id' => $this->getNewId(),
            'name' => $request->name,
            'date_end' => $request->date_end,
            'ward_id' => $request->ward_id
        ]);
        return redirect(route('admin.period.edit', ['id' => $new_period->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $period = Period::findOrFail($id);
        return view('admin.period.edit', compact('period'));
    }

    public function update(UpdatePeriod $request, $id)
    {
        $period = Period::findOrFail($id);
        if ($period->getRawOriginal('date_end') < now()) {
            return back()->with('alert-fail', 'Không thể cập nhật!');
        }
        $period->update($request->validated());
        return back()->with('alert-success', trans('alert.update.success'));
    }

    private function getNewId()
    {
        $now = Carbon::now();
        $year = $now->format('y');
        $month = $now->format('m');
        $order = 1;
        $last_field = Period::where('id', 'like', sprintf('%s%s', $year, $month) . '%')
            ->orderby('created_at', 'desc')->first();
        if ($last_field) {
            $order = intval(substr($last_field->id, -2)) + 1;
        }
        $order = str_pad($order, 2, '0', STR_PAD_LEFT);
        $new_id = $year . $month . $order;
        return $new_id;
    }
}
