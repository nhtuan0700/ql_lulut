<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Period\StorePeriod;
use App\Http\Requests\Period\UpdatePeriod;
use App\Models\Period;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::paginate(config('constants.limit_page'));
        return view('admin.period.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.period.create');
    }

    public function store(StorePeriod $request)
    {
        $new_period = Period::create([
            'id' => $this->getNewId(),
            'name' => $request->name,
            'description' => $request->description,

        ]);
        return redirect(route('admin.period.edit', ['id' => $new_period->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $period = Period::findOrFail($id);
        dd($period);
        return view('admin.period.edit', compact('period'));
    }

    public function update(UpdatePeriod $request, $id)
    {
        $period = Period::findOrFail($id);

        return back()->with('alert-success', trans('alert.update.success'));
    }

    private function getNewId()
    {
        $now = Carbon::now();
        $year = $now->format('y');
        $month = $now->format('m');
        $order = 1;
        $last_field = Period::where('id', 'like', sprintf('%s%s', $year, $month))
            ->orderby('created_at', 'desc')->first();
        if ($last_field) {
            $order += 1;
        }
        $order = str_pad($order, 2, '0', STR_PAD_LEFT);
        $new_id = $year . $month . $order;
        return $new_id;
    }
}
