@extends('layouts.manage')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">订单管理</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">订单中心</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="./order/create">新增订单</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="btn-group">
                    <button type="button" class="btn btn-default">新增订单</button>
                    <button type="button" class="btn btn-default">Middle</button>
                    <button type="button" class="btn btn-default">Right</button>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">订单列表</div>
                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
