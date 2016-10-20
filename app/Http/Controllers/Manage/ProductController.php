<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Facades\Qianfan;
use App\Models\Product;
use App\Models\Scenic;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $supplierId = $request->supplierId;
        $scenicId = $request->scenicId;
        $lists = Product::where(function ($query) use ($key, $supplierId, $scenicId) {
            if ($supplierId) {
                $query->where('supplierId', $supplierId);
            }
            if ($scenicId) {
                $query->where('scenicId', $scenicId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//商品名称
                $query->orWhere('attention', 'like', '%' . $key . '%');//注意事项
                $query->orWhere('parprice', $key);//票面价
                $query->orWhere('price', $key);//成本价格
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.supplier.product.index', compact('lists'));
    }


    public function create(Request $request)
    {
        try {
            $product = new Product();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $product->Rules(), $product->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/product/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $product->fill($input);
                $product->save();
                if ($product) {
                    return redirect('/manage/supplier/product/list')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            $supplier = Supplier::all();
            $scenic = Scenic::all();
            return view('manage.supplier.product.create', compact('product', 'supplier', 'scenic'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }


    public function edit($id, Request $request)
    {
        try {

            $product = Product::find($id);
            if (!$product) {
                return Redirect::back()->withErrors('数据加载失败！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $product->Rules(), $product->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/product/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $product->fill($input);
                $product->save();
                if ($product) {
                    return redirect('/manage/supplier/product/list')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            $supplier = Supplier::all();
            $scenic = Scenic::all();
            return view('manage.supplier.product.edit', compact('product', 'supplier', 'scenic'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }


    public function delete($id, Request $request)
    {
        try {
            $product = new Product();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $product->Rules(), $product->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/product/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $product->fill($input);
                $product->save();
                if ($product) {
                    return redirect('/manage/supplier/product/list')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            $supplier = Supplier::all();
            $scenic = Scenic::all();
            return view('manage.supplier.product.create', compact('product', 'supplier', 'scenic'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function sync($id, Request $request)
    {
        try {
            $supplier = Supplier::find($id);
            if ($supplier == null) {
                return Redirect::back()->withErrors('供应商不存在！');
            }
            $data = null;
            switch ($supplier->platform) {
                case "have"://自有平台
                    break;
                case "qianfan"://千番分销
                    $data = Qianfan::getProducts();
                    $xml = simplexml_load_string($data->out); //创建 SimpleXML对象
                    if ($xml->code == "OS09999") {
                        foreach ($xml->content->products->product as $item => $value) {
                            $product = new Product();
                            $product->supplierId = $id;
                            $product->name = $value->prod_name;
                            $product->code = $value->prod_code;
                            $product->description = $value->description;
                            $product->attention = $value->pay_attention;
                            $product->parprice = $value->parprice;
                            $product->payType = $value->cpgqlx == 2 ? 0 : 1;
                            $product->price = $value->price;
                            $product->beginDate = $value->begin_date;
                            $product->endDate = $value->end_date;
                            $product->save();
                        }
                    }
                    break;
            }
            if (isset($request->json)) {
                return Response::json($data);
            }
            return redirect('/manage/supplier/product/list/' . $id)->withSuccess('同步成功！');
        } catch (Exception $ex) {

            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
