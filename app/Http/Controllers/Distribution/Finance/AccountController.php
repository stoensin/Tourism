<?php

namespace App\Http\Controllers\Distribution\Finance;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Distribution;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 财务帐户
 * @package App\Http\Controllers\
 */
class AccountController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $distributionId = $request->input('distributionId');

        $lists = Apply::where(function ($query) use ($key, $distributionId) {
            if ($distributionId) {
                $query->where('distributionId', $distributionId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.finance.apply.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $apply = new Apply();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $apply->Rules(), $apply->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/apply/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $apply->fill($input);
                $apply->save();
                if ($apply) {
                    return redirect('/manage/apply')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $distributions = Distribution::all();
            return view('manage.apply.create', compact('apply', 'distributions'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
