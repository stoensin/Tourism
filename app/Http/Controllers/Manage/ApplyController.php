<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Distribution;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 应用中心
 * @package App\Http\Controllers\
 */
class ApplyController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        if ($id) {
            $lists = Apply::where('distributionId', $id)->orderBy('created_at', 'desc')->paginate($this->pageSize);
        } else {
            $lists = Apply::orderBy('created_at', 'desc')->paginate($this->pageSize);
        }
        return view('manage.apply.index', compact('lists'));
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
                    return redirect('/manage/apply/list')->withSuccess('保存成功！');
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
