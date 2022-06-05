<?php

namespace App\Http\Controllers\Client;

use App\Enum\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Period;
use App\Models\RegistrationSupport;
use App\Models\RegistrationSupportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationSupportController extends Controller
{
    public function index()
    {
        $periods = Period::whereDate('date_end', '>=', now())->get();
        $goods = Goods::all();
        return view('client.registration_support.index', compact('periods', 'goods'));
    }

    public function save(Request $request)
    {
        if (count($request->data) === 0 && is_null('money')) {
            return back()->with('alert-fail', trans('alert.create.fail'));
        }
        try {
            DB::transaction(function () use ($request) {
                $newRegistration = RegistrationSupport::create([
                    'period_id' => $request->period_id,
                    'user_id' => auth()->id(),
                    'status' => RegistrationStatus::PROCESSING
                ]);
                if (count($request->data) > 0) {
                    foreach ($request->data as $id => $money) {
                        RegistrationSupportDetail::create([
                            'registration_support_id' => $newRegistration->id,
                            'goods_id' => $id,
                            'qty' => $money,
                        ]);
                    }
                }
                if (!is_null($request->money)) {
                    RegistrationSupportDetail::create([
                        'registration_support_id' => $newRegistration->id,
                        'money' => $request->money
                    ]);
                }
            });
            return back()->with('alert-success', trans('alert.create.success'));
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('alert-fail', trans('alert.create.fail'));
        }
    }

    public function cancel($id) 
    {
        $registration = RegistrationSupport::findOrFail($id);
        if ($registration->status === RegistrationStatus::PROCESSING) {
            $registration->update([
                'status' => RegistrationStatus::CANCEL
            ]);
            return back()->with('alert-success', 'Hủy thành công');
        }
        return back()->with('alert-fail', 'Không thể hủy');
    }

    public function history()
    {
        $registrationSupports = RegistrationSupport::query()
            ->selectRaw('*, DATE(created_at) as created_date')
            ->where('user_id', auth()->id())
            ->orderby('created_at', 'desc')
            ->with(['detailGoods', 'detailMoney'])
            ->get();
        return view('client.registration_support.history', compact('registrationSupports'));
    }
}
