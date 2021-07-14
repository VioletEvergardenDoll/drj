@extends('common.admin-layout')
@section('title','添加新用户')
@section('content')
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>新增管理员</h3>
    </div>
    <form action="/adm/user/add-user" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名</label>
            <input type="text" class="form-control" id="username" name="username" style="width: 500px" @if(isset($data)) value="{{$data['username']}}"@endif>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <input type="password" class="form-control" id="password" name="password" style="width: 500px" @if(isset($data)) value="{{$data['password']}}"@endif>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" style="width: 500px" @if(isset($data)) value="{{$data['password']}}"@endif>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label"><button type="submit" class="btn btn-primary">确认</button></label>
        </div>
    </form>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection