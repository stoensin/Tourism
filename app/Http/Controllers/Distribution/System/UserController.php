<?php

namespace App\Http\Controllers\Distribution\System;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Models\Distribution;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 用户管理
 * @package App\Http\Controllers\
 */
class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $type = $request->type;

        $lists = User::where(function ($query) use ($key, $type) {
            $query->where('parentId', Base::uid());//默认条件
            $query->where('type', 1);//默认条件

            if ($type) {
                $query->where('type', $type);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('distribution.system.user.index', compact('lists'));
    }

    public function edit(Request $request)
    {
        try {
            $user = Auth::user();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $user->Rules(), $user->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/distribution/system/user/edit')
                        ->withInput()
                        ->withErrors($validator);
                }

                $user->fill($input);
                $user->password = bcrypt($request->input('password'));
                $user->save();
                if ($user) {
                    return redirect('/distribution/system/user')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $systems = Distribution::all();
            return view('distribution.system.user.edit', compact('user', 'systems'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
