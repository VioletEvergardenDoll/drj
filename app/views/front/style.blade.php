@extends("common.front-layout")
@section("title","名家风采")
@section("content")
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a href="/front/forum">名家讲堂</a></li>
            <li><a href="/front/style" class="current">名家风采</a></li>
            <li><a href="/front/pv">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="export">
        <div class="export_list clearfix">
            @foreach($experts as $k=>$v)
                <div class="export_ship @if($k%3 == 2)mar_0 @endif">
                    <div class="export_ship_img">
                        <a href="/front/std/{{$v->id}}"><img src="{{$v->photo}}" /></a>
                    </div>
                    <div class="export_ship_txt">
                        <p>专家: {{$v->name}}</p>
                        <p>职位: {{$v->postion}}</p>
                        <p>科室: {{$v->department}}</p>
                        <p>医院: {{$v->hospital}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clear"></div>
        <div class="flip">
            <div class="flip_list">
                {{$experts->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
