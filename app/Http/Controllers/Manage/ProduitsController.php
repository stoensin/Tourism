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
        $lists = Produits::orderBy('created_at', 'desc')->paginate($this->pageSize);
        return view('manage.produits.index', compact('lists'));
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
                    return redirect('/manage/produits/list')->withSuccess('保存成功！');
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
                    return redirect('/manage/produits/list')->withSuccess('保存成功！');
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
