<?php

namespace App\Http\Controllers\Manage\Member;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 会员中心
 * @package App\Http\Controllers\
 */
class MemberController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Member::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.member.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $member = new Member();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $member->Rules(), $member->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/member/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $member->fill($input);
                $member->save();
                if ($member) {
                    return redirect('/manage/member')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $distributions = Distribution::all();


            return view('manage.member.create', compact('member', 'distributions'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
