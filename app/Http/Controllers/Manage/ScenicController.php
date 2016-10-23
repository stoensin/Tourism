<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Scenic;
use Exception;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use zgldh\QiniuStorage\QiniuStorage;

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
        $key = $request->key;
        $lists = Scenic::where(function ($query) use ($key) {

            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

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
                if ($request->hasFile('titlePic')) {

                    $pathName=$request->titlePic->store('scenic');

//
//                    $disk = Storage::disk('qiniu');
//
//
//
//                    $pathName = $disk->put('scenic', $request->file('titlePic'));
//
                    if ($pathName) {
//                        $picUrl = $disk->imagePreviewUrl($pathName, 'imageView2/0/w/100/h/200');

                        $scenic->titlePic = $pathName;
                    }
                }

                $scenic->save();
                if ($scenic) {
                    return redirect('/manage/scenic')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('manage.scenic.create', compact('scenic'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $scenic = Scenic::find($id);
            if (!$scenic) {
                return Redirect::back()->withErrors('数据加载失败！');
            }
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
                    return redirect('/manage/scenic')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('manage.scenic.edit', compact('scenic'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
