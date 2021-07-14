@extends('common.admin-layout')
@section('title','专家管理列表')
@section('content')
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>专家管理列表</h3>
    </div>

    <div>
        <div style="float:right;">
            <button type="button" class="btn btn-primary" onclick="window.location.href='/adm/expert/add-expert'">新增专家</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>职称</th>
            <th>科室</th>
            <th>医院</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($experts as $v)
            <tr>
                <th scope="row">{{$v->id}}</th>
                <td>{{$v->name}}</td>
                <td>{{$v->title}}</td>
                <td>{{$v->department}}</td>
                <td>{{$v->hospital}}</td>
                <td>
                    <a href="/adm/expert/edit-expert/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a onclick="deleteExpert({{$v->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$experts->links()}}

    <script type="text/javascript" language="javascript">

        function deleteExpert(id)
        {
            var r = confirm("确认删除这个专家吗？");
            if( r == true )
            {

                var url="/adm/expert/delete-expert";
                var token="{{csrf_token()}}";
                $.post(url,{'_token':token,'id':id},function(data){
                    alert(data);
                    location.reload();
                });
            }
        }

    </script>
@endsection
