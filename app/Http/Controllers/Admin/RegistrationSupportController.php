<?php

namespace App\Http\Controllers\Admin;

use App\Enum\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\RegistrationSupport;
use Illuminate\Http\Request;

class RegistrationSupportController extends Controller
{
    public function index(Request $request)
    {
        $registrations = RegistrationSupport::orderby('created_at', 'desc')
            ->when(isset($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })->paginate(5)->withQueryString();
        return view('admin.registration.index', compact('registrations'));
    }

    public function detail($id)
    {
        $registration = RegistrationSupport::findOrFail($id);
        return view('admin.registration.detai', compact('registration'));
    }

    public function confirm($id)
    {
        $registration = RegistrationSupport::findOrFail($id);
        if ($registration->status === RegistrationStatus::PROCESSING) {
            $registration->update([
                'status' => RegistrationStatus::PROCESSED
            ]);
            return back()->with('alert-success', 'Duyệt thành công');
        }
        return back()->with('alert-fail', 'Duyệt thất bại');
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
        return back()->with('alert-fail', 'Hủy thất bại');
    }
}
