@extends("common.front-layout")
@section("title","往期视频-详情")
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
    <div class="past_top clearfix">
        <div class="past_left">
            <div class="past_left_title">{{$live->title}}</div>
            <div class="past_left_video" id="plat">
            </div>
            <div class="online_class_share">
                <span>分享到：</span>
                <a href="javascript:void(0);" onclick="Pop_on_wx()"><img src="/front/res/images/icon_weixin.jpg" /></a>
            </div>
        </div>
        <div class="past_right">
            <div class="past_intro">
                <div class="title_box">本期简介</div>
                <div class="past_intro_body">
                    <p>{{$live->description}}</p>
                </div>
            </div>
            <div class="past_other">
                <div class="past_other_title">其他讲堂</div>
                <div class="past_other_list">
                    <div class="past_other_ship">
                        @if($videoother)
                            <a href="/front/pvd/{{$videoother->id}}">
                                @if($videoother->photo)
                                    <img src="{{$videoother->photo}}" />
                                @else
                                    <img src="/front/res/images/title_bg.png"/>
                                @endif
                                @endif
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="past_export">
        <div class="title_box">本期嘉宾</div>
        <div class="export_this_list">
            @if($expert)
                <div class="export_this_ship clearfix">
                    <div class="left_export"><img src="{{$expert->photo}}" /></div>
                    <div class="right_export">
                        <div class="export_base">
                            <p class="name">{{$expert->name}} 教授  </p>
                            <p><b>科室：</b>{{$expert->department}}</p>
                            <p><b>职称：</b> {{$expert->title}}</p>
                        </div>
                        <div class="export_this_intro">
                            <p>{{$expert->description}}</p>
                            <div class="export_edu clearfix">
                                <div class="edu_title">接受教育：</div>
                                <div class="edu_info">
                                    <p>{{$expert->education}}<a href="/front/style/{{$expert->id}}">【详情】</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
    var flashvars={
        f:  '{{$live->url}}',
        c:0,
        p:2,
        b:1,
    };
    var video = ['{{$live->url}}'];
    CKobject.embed('/front/res/js/ckplayer/ckplayer.swf','plat','ckplayer_a1','548','329',false,flashvars,video);
</script>
<div id="char_pop" class="chat_pop" style="display:none">
    <div id="char_close" class="chat_pop_top"><a href="javascript:Pop_close()" class="chat_pop_close"></a></div>
    <div class="chat_pop_body">
        <img src="{{$qrcode}}"></img>
        <p>使用微信扫一扫，并将网页分享给好友</p>
    </div>
</div>
<div id="cover" class="phone_page" style="display:none">
    <div class="phone_top"><img src="/front/res/images/top.png"/></div>
    <div class="know"><a href="javascript:quit_pop()"> <img src="/front/res/images/btn_bg.png"/></a></div>
</div>
@endsection
