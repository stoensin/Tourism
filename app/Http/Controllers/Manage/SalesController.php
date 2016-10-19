<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Produits;
use App\Models\Sales;
use App\Models\Distribution;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 授信管理
 * @package App\Http\Controllers\
 */
class SalesController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = Sales::orderBy('created_at', 'desc')->paginate($this->pageSize);
        return view('manage.sales.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $sales = new Sales();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $sales->Rules(), $sales->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/sales/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $sales->fill($input);
                $sales->save();
                if ($sales) {
                    return redirect('/manage/sales/list')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            $distributions = Distribution::all();
            $produits = Produits::all();

            return view('manage.sales.create', compact('sales', 'distributions', 'produits', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
