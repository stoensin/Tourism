@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">会员中心</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">会员中心</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/member')}}" class="active">会员管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/member/order')}}">订单管理</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/scenic')}}">会员统计</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">会员管理</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/member/create')}}"
                                                     class="btn btn-primary">新增</a></div>
                            <div class="col-md-8 text-right">
                                <form method="get" class="form-inline">
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
                                    <th><a href="">姓名</a></th>
                                    <th><a href="">邮件</a></th>
                                    <th><a href="">手机号</a></th>
                                    <th><a href="">QQ</a></th>
                                    <th><a href="">推荐人</a></th>
                                    <th><a href="">注册时间</a></th>
                                    <th><a href="">微信绑定</a></th>
                                    <th><a href="">状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr>
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td style="text-align: center">
                                            <a href="{{url('/manage/member/product/'.$item->id)}}">{{$item->name}}</a>
                                        </td>
                                        <td style="text-align: center">{{$item->email}}</td>
                                        <td style="text-align: center">{{$item->mobile}}</td>
                                        <td style="text-align: center">{{$item->qq}}</td>
                                        <td style="text-align: center">{{isset($item->recommend) ? $item->recommend->name:''}}</td>
                                        <td style="text-align: center">{{$item->created_at}}</td>
                                        <td style="text-align: center">{{isset($item->openId)?'未绑定':'已绑定'}}</td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>

                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/member/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a
                                                    href="{{url('/manage/member/delete/'.$item->id)}}">删除</a>

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
                                        href="{{url('/member/resources/guide/create/')}}"
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
