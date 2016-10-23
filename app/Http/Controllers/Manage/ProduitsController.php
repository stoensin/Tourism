<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Produits;
use App\Models\Scenic;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 产品列表
 * @package App\Http\Controllers\
 */
class ProduitsController extends Controller
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
        $lists = Produits::where(function ($query) use ($key, $supplierId, $scenicId) {
            if ($supplierId) {
                $query->where('supplierId', $supplierId);
            }
            if ($scenicId) {
                $query->where('scenicId', $scenicId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//商品名称
                $query->orWhere('attention', 'like', '%' . $key . '%');//注意事项
                $query->orWhere('refundable', 'like', '%' . $key . '%');//退改规则
                $query->orWhere('parprice', $key);//票面价
                $query->orWhere('price', $key);//成本价格
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        $suppliers = Supplier::all();
        $scenics = Scenic::all();

        return view('manage.produits.index', compact('lists', 'suppliers', 'scenics'));
    }

    public function create(Request $request)
    {
        try {
            $produits = new Produits();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $produits->Rules(), $produits->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/produits/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $produits->fill($input);
                $produits->save();
                if ($produits) {
                    return redirect('/manage/produits')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $suppliers = Supplier::all();
            $products = Product::all();
            $scenics = Scenic::all();

            return view('manage.produits.create', compact('produits', 'products', 'suppliers', 'scenics'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }


    public function original($id, Request $request)
    {
        try {
            $produits = new Produits();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $produits->Rules(), $produits->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/produits/original/' . $id)
                        ->withInput()
                        ->withErrors($validator);
                }

                $produits->fill($input);
                $produits->save();
                if ($produits) {
                    return redirect('/manage/produits')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $product = Product::find($id);

            if ($product) {
                $produits->productId = $id;
                $produits->supplierId = $product->supplierId;
                $produits->name = $product->name;
                $produits->attention = $product->attention;
                $produits->refundable = $product->refundable;
                $produits->parprice = $product->parprice;
                $produits->price = $product->price;
                $produits->payType = $product->payType;

            } else {
                return Redirect::back()->withErrors('无记录！');
            }
            $scenics = Scenic::all();
            return view('manage.produits.original', compact('produits', 'scenics'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
