<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Family\UpdateFamily;
use App\Models\Family;
use App\Models\Ward;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::orderby('ward_id', 'desc')->paginate(config('constants.limit_page'));
        return view('admin.family.index', compact('families'));
    }

    public function edit($id)
    {
        $family = Family::findOrFail($id);
        $wards = Ward::all();
        return view('admin.family.edit', compact('family', 'wards'));
    }

    public function update(UpdateFamily $request, $id)
    {
        $data = $request->validated();
        Family::findOrFail($id)->update($data);
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
