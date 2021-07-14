@extends('common.admin-layout')
@section('title','编辑专家信息')
@section('content')
    <!-- 配置文件 -->
    <script type="text/javascript" src="/admin/assets/js/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/admin/assets/js/ueditor/ueditor.all.js"></script>
    <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
    <script type="text/javascript" src="/admin/assets/js/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script src="/admin/assets/js/ajaxfileupload.js"></script>
    
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="app_content_div" id="app_content_div_301Index">
        <h3>编辑信息</h3>
    </div>
    <form class="form-horizontal"  method="post" action="/adm/expert/edit-expert">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
        <input type="hidden" name="id" id="id" value="{{$expert->id}}">
        <div class="form-group">
            <label for="doc_name" class="col-sm-2 control-label"><span style="color:red;">*</span>姓名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{$expert->name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="upload_file" class="col-sm-2 control-label"><span style="color:#ff0000;">*</span>缩略图</label>
            <div class="col-sm-10">
                <input  id="upload_file" name="upload_file"  type="file" onchange="saveThumb()"/>
                <input type="hidden" class="form-control" id="photo" name="photo" value="{{$expert->photo}}">
                <img style="width:160px;height:200px;" alt="" id="thumb" src="{{$expert->photo}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="doc_position" class="col-sm-2 control-label"><span style="color:red;">*</span>科室</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="department" name="department" value="{{$expert->department}}" >
            </div>
        </div>
        <div class="form-group">
            <label for="doc_department" class="col-sm-2 control-label"><span style="color:red;">*</span>职称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id=“title" name="title" value="{{$expert->title}}">
            </div>
        </div>
        <div class="form-group">
            <label for="doc_department" class="col-sm-2 control-label"><span style="color:red;">*</span>职务</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id=“postion" name="postion" value="{{$expert->postion}}">
            </div>
        </div>
        <div class="form-group">
            <label for="doc_department" class="col-sm-2 control-label"><span style="color:red;">*</span>医院</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id=“hospital" name="hospital" value="{{$expert->hospital}}">
            </div>
        </div>
        <div class="form-group" >
            <label for="doc_introduction" class="col-sm-2 control-label"><span style="color:red;">*</span>简介</label>
            <div class="col-sm-10">
                <script id="description" name="description" type="text/plain"> {{$expert->description}} </script>
                <script type="text/javascript">
                    var editor = UE.getEditor('description')
                </script>
            </div>
        </div>
        <div class="form-group" >
            <label for="doc_introduction" class="col-sm-2 control-label"><span style="color:red;">*</span>接受教育</label>
            <div class="col-sm-10">
                <script id="education" name="education" type="text/plain"> {{$expert->education}} </script>
                <script type="text/javascript">
                    var editor = UE.getEditor('education')
                </script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">确定</button>
            </div>
        </div>
        <script type="text/javascript">
            function saveThumb() {
                $.ajaxFileUpload({
                    url: "/adm/expert/upload-doc-thumb",
                    secureuri: false,
                    fileElementId: "upload_file",
                    dataType: "json",
                    data:{_token:$("#_token").val()},
                    success: function(data, status) {
                        if(data.success){
                            $("#photo").val(data.photo);
                            $("#thumb").attr("src", data.photo);
                            alert("上传成功");
                        }else{
                            alert(data.msg);}
                    }
                })
            }
        </script>
    </form>
@endsection