<?php

namespace App\Http\Controllers\Manage\Distribution;

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
    public function index(Request $request)
    {

        $key = $request->key;
        $distributionId = $request->input('distributionId');

        $lists = Credit::where(function ($query) use ($key, $distributionId) {
            if ($distributionId) {
                $query->where('distributionId', $distributionId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);
        
         
        return view('manage.distribution.credit.index', compact('lists'));
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
                    return redirect('/manage/distribution/credit/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $credit->fill($input);
                $credit->save();
                if ($credit) {
                    return redirect('/manage/distribution/credit')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            $distributions = Distribution::all();

            return view('manage.distribution.credit.create', compact('credit', 'distributions', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
