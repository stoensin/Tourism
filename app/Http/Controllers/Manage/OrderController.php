<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Http\Facades\Qianfan;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

class OrderController extends Controller
{


    public function __construct()
    {
        // Qianfan::init("fxqflx", "FX90b6f199-3504-44b5-8825-7c5ca8ada1ad");
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas=Order::all();
        if (isset($request->json)) {
            return Response::json($datas);
        }


        return view('manage.order.index', compact('datas'));
    }


    public function create(Request $request)
    {
        try {
            $order = new Order();
            if ($request->isMethod('POST')) {
                $input = Input::all();

                $validator = Validator::make($input, $order->createRules(), $order->messages());
                if ($validator->fails()) {
                    return redirect('/supplier/resources/fleet/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $order->fill($input);
                $order->eid = Base::eid();
                $order->createid = Base::uid();
                $order->save();
                if ($order) {
                    return redirect('/supplier/resources/fleet/')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            return view('manage.order.create', compact('order'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
