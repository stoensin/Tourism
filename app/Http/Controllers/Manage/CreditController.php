<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Credit;
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
class CreditController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        if ($id) {
            $lists = Credit::where('distributionId', $id)->orderBy('created_at', 'desc')->paginate($this->pageSize);
        } else {
            $lists = Credit::orderBy('created_at', 'desc')->paginate($this->pageSize);
        }
        return view('manage.credit.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $credit = new Credit();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $credit->Rules(), $credit->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/credit/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $credit->fill($input);
                $credit->save();
                if ($credit) {
                    return redirect('/manage/credit/list')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            $distributions = Distribution::all();

            return view('manage.credit.create', compact('credit', 'distributions', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
