@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">资源供应</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">资源供应</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/list')}}"  class="active">供应商列表</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/supplier/product/list')}}">原始资源</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/scenic/list')}}">景区配置</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/produits/list')}}">产品中心</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">资源供应列表</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/supplier/create')}}"
                                                     class="btn btn-primary">新增</a></div>
                            <div class="col-md-8">
                                <form method="get" cssClass="form-horizontal">
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="关键字"
                                               name="key" value=""> <span class="input-group-btn">
								<button class="btn btn-default" type="submit">搜索</button>
							</span>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form method="Post" class="form-inline">
                        <fieldset>
                            <table class="table table-bordered table-hover  table-condensed">
                                <thead>
                                <tr style="text-align: center" class="text-center">
                                    <th style="width: 20px"><input type="checkbox"
                                                                   name="CheckAll" value="Checkid"/></th>
                                    <th style="width: 80px;"><a href="">编号</a></th>
                                    <th><a href="">简称</a></th>
                                    <th><a href="">全称</a></th>
                                    <th><a href="">联系人</a></th>
                                    <th><a href="">手机号</a></th>
                                    <th><a href="">电话</a></th>
                                    <th><a href="">责任人</a></th>
                                    <th><a href="">状态</a></th>
                                    <th style="width: 180px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr>
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td style="text-align: center">
                                            <a href="{{url('/manage/supplier/product/'.$item->id)}}">{{$item->name}}</a>
                                        </td>
                                        <td style="text-align: center">{{$item->enterprise}}</td>
                                        <td style="text-align: center">{{$item->linkMan}}</td>
                                        <td style="text-align: center">{{$item->mobile}}</td>
                                        <td style="text-align: center">{{$item->tel}}</td>
                                        <td style="text-align: center">{{$item->liableUser->name}}</td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>

                                        <td><a
                                                    href="{{url('/manage/supplier/edit/'.$item->id)}}">详情</a>
                                            |
                                            <a
                                                    href="{{url('/manage/supplier/delete/'.$item->id)}}">删除</a>
                                            <br>
                                            <a href="{{url('/manage/supplier/product/list/'.$item->id)}}">供应产品({{$item->products()->count()}}
                                                )</a>
                                            |
                                            <a href="{{url('/manage/supplier/product/sync/'.$item->id)}}">同步</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                    </form>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"><a
                                        href="{{url('/supplier/resources/guide/create/')}}"
                                        class="btn btn-primary">批量删除</a></div>
                            <div class="col-md-8 text-right">
                                {!! $lists->links() !!}
                            </div>
                        </div>

                    </div>
                </div>
                @include("common.success")
                @include("common.errors")
            </div>
        </div>
    </div>
@endsection