<?php


class FrontController extends BaseController
{
    public function Index()
    {
        $time=0;
        $ConfId=-1;
        $url=" ";
        $qrcode="";
        $lives=Live::select('id','photo','title','start_time','exid','relation')->where('type','=','1')->orderBy('created_at','desc')->take(3)->get();
        $RecentConf=$this->RecentVideo();
        $experts=Expert::select()->orderBy('created_at','DESC')->take(2)->get();
        if($RecentConf == null)
        {
            $state=0;
        }
        else
        {
            $ConfId=$RecentConf->id;
            $backImg=$RecentConf->photo;
            $CurrentUrl=$RecentConf->url;
            $filename=$RecentConf->id;
            $qrcode=$this->getQrcode($CurrentUrl, $filename);
            $now=time();
            if(strtotime($RecentConf->start_time)> $now)
            {
                $state=1;
                $time=strtotime($RecentConf->start_time);
            }
            else
            {
                $state=2;
                $url=$RecentConf->url;
            }
        }
        return View::make('front.index')
            ->with(array(
                'lives' => $lives,
                'state'=>$state,
                'experts'=>$experts,
                'time'=>$time,
                'ConfId'=>$ConfId,
                'url'=>$url,
                'qrcode'=>$qrcode
            ));
    }

    public function RecentVideo()
    {
        $now=date('Y-m-d H:i:s');
        $lives=Live::where('end_time','>',$now)->where('type','=','0')->orderBy('start_time','ASC')->first();
        return $lives;
    }

    public function getQrcode($data,$name)
    {
        ini_set('display_errors', 'on');
        $PNG_TEMP_DIR = public_path().'/upload/2dbarcode/';
        $PNG_WEB_DIR = '/upload/2dbarcode/';
        require app_path()."/extends/phpqrcode/qrlib.php";
        $ecc = 'H';
        $size = "50";
        $filename = $PNG_TEMP_DIR.$name.'.png';
        $code= $PNG_WEB_DIR.basename($filename);
        if(!file_exists($PNG_TEMP_DIR))
            $this->mkdirs($PNG_TEMP_DIR);
        if(!file_exists($filename))
        {
            QRcode::png($data, $filename, $ecc, $size, 2);
            chmod($filename, 0777);
        }
        return $code;
    }

    function mkdirs($path, $mode = 0777)
    {
        if(!file_exists($path))
        {
            $this->mkdirs(dirname($path), $mode);
            mkdir($path,$mode);
        }
    }

    public function getForum()
    {
        $qrcode="";
        $RecentConf = $this->RecentVideo();
        if($RecentConf == null)
        {
            $state = 0;
            return View::make('front.forum')
                ->with('state' , $state)
                ->with('qrcode' ,$qrcode);
        }
        else
        {
            $CurrentUrl=$RecentConf->url;
            $filename=$RecentConf->id;
            $qrcode=$this->getQrcode($CurrentUrl, $filename);
            $backImg = $RecentConf->photo;
            $expert = $this->GetMainStyle();
            $description= $RecentConf->description;
            $now = time();
            if(strtotime($RecentConf->start_time)> $now)
            {
                $state = 1;
                $time = strtotime($RecentConf->start_time);
                return View::make('front.forum')
                    ->with(array('state'=>$state,
                        'expert'=>$expert,
                        'time'=>$time,
                        'description' => $description,
                        'url'=>$CurrentUrl,
                        'qrcode' => $qrcode));
            }
            else
            {
                $state = 2;
                return View::make('front.forum')
                    ->with(array('state' => $state,
                        'url' => $CurrentUrl,
                        'expert' => $expert,
                        'description' => $description,
                        'qrcode' => $qrcode));
            }
        }
    }

    function GetMainStyle()
    {
        $now=date('Y-m-d H:i:s');
        $lives=Live::where('end_time','>',$now)->where('type','=','0')->orderBy('start_time','ASC')->first();
        if($lives)
        {
            $expert=Expert::where('name',$lives->relation)->first();
        }else{
            $expert="";
        }
        return $expert;
    }

    public function getStyle()
    {
        $experts=Expert::orderby('id','desc')->paginate(9);
        return View::make("front.style")->with("experts",$experts);;
    }

    public function getStd($id)
    {
        $expert=Expert::find($id);
        $otherExperts=Expert::where("id","!=",$id)->get();
        if(count($otherExperts))
        {
            return View::make('front.std')
                ->with('expert',$expert)
                ->with('otherExperts',$otherExperts);
        }
        else
        {   return View::make('front.std')
            ->with('expert',$expert);
        }

    }

    public function getPv()
    {
        $lives=Live::where('type','1')->orderBy('end_time','Desc')->paginate(5);
        return View::make("front.pv")->with("lives",$lives);
    }

    public function getPvd($id)
    {
        $live = Live::find($id);
        $sUrl="http://".$_SERVER['SERVER_NAME']."/pvd/".$id;
        $qrcode=$this->getQrcode($sUrl,$live->id);
        $expert=Expert::where('name',$live->relation)->first();
        $videoother = Live::where('type','1')
            ->where('id',"<>",$id)
            ->orderBy('end_time','Desc')
            ->first();

        return View::make('front.pvd')
            ->with('live',$live)
            ->with('videoother',$videoother)
            ->with('expert',$expert)
            ->with('qrcode' ,$qrcode);;
    }
}