<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Scenic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 景区配置
 * @package App\Http\Controllers\
 */
class ScenicController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = Scenic::orderBy('created_at', 'desc')->paginate($this->pageSize);
        return view('manage.scenic.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $scenic = new Scenic();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $scenic->Rules(), $scenic->messages());
                if ($validator->fails()) {
                    return redirect('/manage/scenic/create/')
                        ->withInput()
                        ->withErrors($validator);
                }
                $scenic->fill($input);
                $scenic->save();
                if ($scenic) {
                    return redirect('/manage/scenic/list')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('manage.scenic.create', compact('scenic'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
