@extends('default_users')
@section('contents')
    @include('_errors')
    {{--<div class="container">--}}
        {{--<h1>用户登录</h1>--}}
    {{--<form method="post" action="{{ route('login') }}">--}}
        {{--姓名:<input type="text" name="name"><br>--}}
        {{--密码: <input type="password" name="password"><br>--}}
        {{--<div class="checkbox">--}}
            {{--<label for="">--}}
                {{--<input type="checkbox" name="rememberMe" value="1">:记住我--}}
            {{--</label>--}}
        {{--</div>--}}
        {{--{{ csrf_field() }}--}}
      {{--<button type="submit" class="btn btn-info">提交</button>--}}
    {{--</form>--}}
    {{--</div>--}}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">商家用户密码登录</h4>
        </div>
        <div class="modal-body">
            <form  action="{{ route('login') }}" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="手机/邮箱/用户名" value="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="密码" value="">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember_token" value="1">下次自动登录
                    </label>
                </div>
                <button class="btn btn-primary btn-block">登录</button>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="modal-footer">
            {{--<a href="javascript:;" style="float: left">扫码登录</a>--}}
            <a href="{{route('register')}}">立即注册</a>
        </div>
        <div class="modal-footer">
            {{--<a href="javascript:;" style="float: left">扫码登录</a>--}}
            {{--<a href="{{route('admin.edit',[auth()->admin()->id])}}">修改密码</a>--}}
        </div>
    </div>
@endsection
