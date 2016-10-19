<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Produits;
use App\Models\ReserveRule;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


/**
 * 预定规则
 * @package App\Http\Controllers\
 */
class RuleController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $lists = ReserveRule::where('produitsId', $id)->orderBy('created_at', 'desc')->paginate($this->pageSize);
        return view('manage.produits.rule.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $rule = new ReserveRule();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $rule->Rules(), $rule->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/produits/rule/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $rule->fill($input);
                $rule->save();
                if ($rule) {
                    return redirect('/manage/produits/rule/list')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $produits = Produits::all();

            return view('manage.produits.rule.create', compact('rule', 'produits'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}