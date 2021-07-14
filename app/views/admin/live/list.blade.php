@extends('common.admin-layout')
@section('title','直播/录播管理')
@section('content')
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>直播录播管理</h3>
    </div>

    <div>
        <div style="float:right;">
            <button type="button" class="btn btn-primary" onclick="window.location.href='/adm/live/add-live'">新增视频</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>科室</th>
            <th>专家</th>
            <th>类型</th>
            <th>直播开始时间</th>
            <th>直播结束时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lives as $v)
            <tr>
                <th scope="row">{{$v->id}}</th>
                <td>{{$v->title}}</td>
                <td>{{$v->exdepartment}}</td>
                <td>{{$v->relation}}</td>
                <td>@if($v->type==1)录播 @else 直播 @endif</td>
                <td>{{$v->start_time}}</td>
                <td>{{$v->end_time}}</td>
                <td>
                    <a href="/adm/live/edit-live/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a onclick="deletelive('/adm/live/delete-live/{{$v->id}}')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$lives->links()}}

    <script>
        function deletelive(url){
            if(confirm('确定要删除该条记录吗？')){
                window.location.href = url;
            }
        }
    </script>
@endsection
