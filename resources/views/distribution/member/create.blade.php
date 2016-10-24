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
                <div class="panel panel-default">
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="submit" class="btn  btn-primary">保存</button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>帐户信息</legend>

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">姓名：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   style="width: auto;"
                                                   value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">
                                            <input id="mobile" type="text" class="form-control" name="mobile"
                                                   placeholder="手机号"
                                                   style="width: auto;"
                                                   value="{{ old('mobile') }}" autofocus>

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-3 control-label">电子邮件：</label>

                                        <div class="col-md-9">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   style="width: 300px;"
                                                   value="{{ old('email') }}" autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-3 control-label">密码：</label>

                                        <div class="col-md-9">
                                            <input id="password" type="password" class="form-control" name="password"
                                                   style="width: auto;"
                                                   value="{{ old('email') }}" autofocus>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>基本信息</legend>
                                    <div class="form-group{{ $errors->has('idCard') ? ' has-error' : '' }}">
                                        <label for="idCard" class="col-md-3 control-label">身份证号：</label>

                                        <div class="col-md-9">
                                            <input id="idCard" type="text" class="form-control" name="idCard"
                                                   style="width: 300px;"
                                                   value="{{ old('idCard') }}" autofocus>

                                            @if ($errors->has('idCard'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('idCard') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                        <label for="birthday" class="col-md-3 control-label">生日：</label>

                                        <div class="col-md-9">
                                            <input id="birthday" type="text" class="form-control" name="birthday"
                                                   style="width: auto;"
                                                   value="{{ old('birthday') }}" autofocus>

                                            @if ($errors->has('birthday'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                        <label for="sex" class="col-md-3 control-label">性别：</label>

                                        <div class="col-md-9">
                                            <select id="sex" name="sex" class="form-control" style="width: auto;">
                                                <option value="0">未知</option>
                                                <option value="1">男</option>
                                                <option value="2">女</option>
                                            </select>

                                            @if ($errors->has('sex'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label for="province" class="col-md-3 control-label">所在省：</label>

                                        <div class="col-md-9">
                                            <input id="province" type="text" class="form-control" name="province"
                                                   style="width: 300px;"
                                                   value="{{ old('province') }}" autofocus>

                                            @if ($errors->has('province'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label for="city" class="col-md-3 control-label">所在市：</label>

                                        <div class="col-md-9">
                                            <input id="city" type="text" class="form-control" name="city"
                                                   style="width: 300px;"
                                                   value="{{ old('city') }}" autofocus>

                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                                        <label for="addres" class="col-md-3 control-label">地址：</label>

                                        <div class="col-md-9">
                                            <input id="addres" type="text" class="form-control" name="addres"
                                                   value="{{ old('addres') }}" autofocus>

                                            @if ($errors->has('addres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('addres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>联系方式</legend>


                                    <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                        <label for="tel" class="col-md-3 control-label">坐机电话：</label>

                                        <div class="col-md-9">
                                            <input id="tel" type="text" class="form-control" name="tel"
                                                   style="width: auto;"
                                                   value="{{ old('tel') }}" autofocus>

                                            @if ($errors->has('tel'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('qq') ? ' has-error' : '' }}">
                                        <label for="qq" class="col-md-3 control-label">QQ：</label>

                                        <div class="col-md-9">
                                            <input id="qq" type="text" class="form-control" name="qq"
                                                   style="width: auto;"
                                                   value="{{ old('qq') }}" autofocus>

                                            @if ($errors->has('fax'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('qq') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('weibo') ? ' has-error' : '' }}">
                                        <label for="weibo" class="col-md-3 control-label">微博：</label>

                                        <div class="col-md-9">
                                            <input id="weibo" type="text" class="form-control" name="weibo"
                                                   style="width: 300px;"
                                                   value="{{ old('weibo') }}" autofocus>

                                            @if ($errors->has('weibo'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('weibo') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('weixin') ? ' has-error' : '' }}">
                                        <label for="weixin" class="col-md-3 control-label">微信号：</label>

                                        <div class="col-md-9">
                                            <input id="weixin" type="text" class="form-control" name="weixin"
                                                   style="width: 300px;"
                                                   value="{{ old('weixin') }}">

                                            @if ($errors->has('weixin'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('weixin') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>渠道信息</legend>
                                    @if($distributions )
                                        <div class="form-group{{ $errors->has('distributionId') ? ' has-error' : '' }}">
                                            <label for="distributionId" class="col-md-3 control-label">分销商：</label>

                                            <div class="col-md-9">
                                                <select name="distributionId" class="form-control" style="width: auto;">
                                                    @foreach($distributions as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('distributionId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('distributionId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group{{ $errors->has('memberId') ? ' has-error' : '' }}">
                                        <label for="memberId" class="col-md-3 control-label">推荐人ID：</label>

                                        <div class="col-md-9">
                                            <input id="memberId" type="text" class="form-control" name="memberId"
                                                   value="{{ old('memberId') }}" style="width: auto;">

                                            @if ($errors->has('memberId'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('memberId') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control" style="width: auto;">
                                                <option value="0">正常</option>
                                                <option value="1">禁用</option>
                                            </select>

                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('remark') ? ' has-error' : '' }}">
                                        <label for="remark" class="col-md-3 control-label">内部备注：</label>

                                        <div class="col-md-9">

                                            <textarea id="remark" type="text" class="form-control"
                                                      name="remark"
                                                      style=" height: 100px"
                                            >{{old('refundable') }}</textarea>

                                            @if ($errors->has('remark'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('remark') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                @include("common.success")
                @include("common.errors") </div>
        </div>
    </div>
@endsection
