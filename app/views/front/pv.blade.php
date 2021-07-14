@extends("common.front-layout")
@section("title","往期视频")
@section("content")
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a href="/front/forum">名家讲堂</a></li>
            <li><a href="/front/style">名家风采</a></li>
            <li><a href="/front/pv" class="current">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="past_video">
        <div class="past_video_list">
            @foreach($lives as $v)
                <div class="one_line clearfix">
                    <div class="index_right_img">
                        <a href="/front/pvd/{{$v->id}}">
                            <img  src="{{$v->photo}}" />
                        </a>
                    </div>
                    <div class="review_ship_txt">
                        <div class="review_ship_title break"><p>标题：<a href="/front/pvd/{{$v->id}}">{{$v->title}}</a></p></div>
                        <div class="review_ship_intro clearfix">
                            <div class="review_ship_left">
                                <p>主持：<a href="/front/std/{{$v->exid}}">{{$v->relation}}</a></p>
                                <p>日期：<span class="txt_999">{{$v->start_time}}</span></p>
                            </div>
                            <div class="review_ship_right">
                                <a class="info_btn" href="/front/pvd/{{$v->id}}">查看详情</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$lives->links()}}
    </div>
</div>
@endsection