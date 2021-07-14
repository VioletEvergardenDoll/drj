<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet">
    <script src="/admin/assets/js/jquery.min.js"></script>
    <script src="/admin/assets/js/bootstrap.js"></script>
    <link href="/admin/assets/css/font-awesome.css" rel="stylesheet">
    <link href="/admin/assets/css/custom.css" rel="stylesheet">


    <title>管理后台登录</title>
</head>
<body>
<div>
    <div class="page-header">
        <h1> <small>管理系统后台登录</small></h1>
    </div>

    <form action="/login" accept-charset="UTF-8" class="form-horizontal" style="margin-top:200px;width:400px;margin-left:500px;" method="post">


        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group" style="">
            <label for="username" class="col-sm-2 control-label" style="width:100px;">用户名：</label>
            <div class="col-sm-10" style="width:300px;">
                <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label" style="width:100px;">密码：</label>
            <div class="col-sm-10" style="width:300px;">
                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" style="margin-left:27px;" onclick="login()">登录</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<script type="text/javascript">
    function login(){
        var username=document.getElementById('username');
        var password=document.getElementById('password');
        $.ajax({
            data:{"username":username.value,"password":password.value},
            url: "/login",
            dataType:"json",
            type:"post",
            header: {'X-CRSF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
                if(!data.status){
                    alert("登录失败，用户名或密码错误！");
                    window.location.href="/login";
                }
                else{
                    alert("登录成功！");
                    window.location.href="/adm";
                }
            },
            error:function(data){
                alert("错误信息");
            }
        })
    }