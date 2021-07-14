@extends('common.admin-layout')
@section('title','编辑用户')
@section('content')
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>修改密码</h3>
    </div>
    <form action="/adm/user/edit-user" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="hidden" name="id" id="id" value="{{$user->id}}" readonly>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名</label>
            <input type="text" class="form-control" id="username" name="username" style="width: 500px" value="{{$user->username}}" readonly>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <input type="password" class="form-control" id="password" name="password" style="width: 500px" value="{{$user->password}}">
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" style="width: 500px" value="{{$user->password}}">
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label"><button type="submit" class="btn btn-primary">确认</button></label>
        </div>
    </form>
@endsection
