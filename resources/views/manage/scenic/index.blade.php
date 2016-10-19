@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li><a href="#">资源供应</a></li>
            <li class="active">景区配置</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">资源供应</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/list')}}">供应商列表</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/supplier/product/list')}}">原始资源</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/scenic/list')}}" class="active">景区配置</a>
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
                    <div class="panel-heading">景区列表</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/scenic/create')}}"
                                                     class="btn btn-primary">新增</a></div>
                            <div class="col-md-8">
                                <form method="get" class="form-horizontal">
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
                                    <th style="width: 60px;"><a href="">编号</a></th>
                                    <th><a href="">景点名称</a></th>
                                    <th><a href="">推荐理由</a></th>
                                    <th style="width: 200px;"><a href="">注意事项</a></th>
                                    <th style="width: 80px;"><a href="">评级</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 180px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr title="{{$item->attention}}">
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td>{{$item->name}}</td>
                                        <td> {{$item->recommend}}</td>
                                        <td> {{$item->attention}}
                                        </td>
                                        <td style="text-align: center"> {{$item->grade}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>

                                        <td><a
                                                    href="{{url('/manage/scenic/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a href="{{url('/manage/scenic/delete/'.$item->id)}}">删除</a>
                                            <hr/>
                                            <a href="{{url('/manage/product/list/'.$item->id)}}">原始资源({{$item->product->count()}})</a>
                                            | <a href="{{url('/manage/produits/list/'.$item->id)}}">产品中心({{$item->produits->count()}})</a>
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
                                分页
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
