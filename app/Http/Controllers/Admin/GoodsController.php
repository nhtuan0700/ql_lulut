<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Goods\StoreGoodsRequest;
use App\Http\Requests\Goods\UpdateGoodsRequest;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index()
    {
        $goodsList = Goods::orderby('id', 'desc')
            ->paginate(config('constants.limit_page'));
        return view('admin.goods.index', compact('goodsList'));
    }

    public function create()
    {
        $unitList = config('common.data.unitList');
        return view('admin.goods.create', compact('unitList'));
    }

    public function store(StoreGoodsRequest $request)
    {
        $data = $request->validated();
        $goods = Goods::create($data);
        return redirect(route('admin.goods.edit', ['id' => $goods->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $goods = Goods::findOrFail($id);
        $unitList = config('common.data.unitList');
        return view('admin.goods.edit', compact('goods', 'unitList'));
    }

    public function update(UpdateGoodsRequest $request, $id)
    {
        $data = $request->validated();
        $goods = Goods::findOrFail($id);
        $data['unit'] = config('common.data.unitList')[$data['unit']];
        $goods->update($data);
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
