<?php


class LiveController extends BaseController
{
    /*
   * csrf过滤器
   */
    public function __construct()
    {
        $this->beforeFilter('auth',array('except'=>array('login','Dologin')));
        $this->beforeFilter('csrf',array('on'=>'post'));
    }

    /**
     * @return mixed后台首页
     */

    public function getIndex()
    {
        $lives = Live::paginate(5);
        return View::make('admin.live.list')->with('lives',$lives);
    }

    /**
     * 添加用户
     */
    public function getAddLive()
    {
        //取得所有专家
        $experts = Expert::All()->lists('name','id');
        return View::make("admin.live.add")->with('experts',$experts);
    }

    public function postAddLive()
    {
        //表单验证
        $rules = array(
            'title'  		=> 'required',
            'url'  		=> 'required',
            'type'  		=> 'required',
            'description'  		=> 'required',
            'start_time'  		=> 'required',
            'end_time'    => 'required',
            'photo'  	=> 'required',
            'expert'     =>  'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            return
            $errors=$validator->messages();
            return Redirect::to('/adm/live/add-live')->withErrors($errors);
        }
        $title=Input::get("title");
        $url=Input::get("url");
        $type=Input::get("type");
        $description=Input::get("description");
        $start_time=Input::get("start_time");
        $end_time=Input::get("end_time");
        $upload_file=Input::get("photo");
        $expert=Input::get("expert");
        $exper=DB::table('experts')->where('name',$expert)->first();
        $live=new Live();
        $live->title=$title;
        $live->url=$url;
        $live->type=$type;
        $live->description=$description;
        $live->start_time=$start_time;
        $live->end_time=$end_time;
        $live->photo=$upload_file;
        $live->relation=$expert;
        $live->exid=$exper->id;
        $live->exdepartment=$exper->department;
        $live->exphoto=$exper->photo;
        $live->save();
        return Redirect::to('/adm/live');
    }

    public function getEditLive($id)
    {
        $live=Live::find($id);
        $experts = Expert::All();
        $expert = DB::table('experts')->where("id",$live->exid)->get();
        return View::make("admin.live.edit")->with("live",$live)->with("experts",$experts)->with("expert",$expert);
    }

    public function postEditLive()
    {
        $rules = array(
            'title'  		=> 'required',
            'url'  		=> 'required',
            'type'  		=> 'required',
            'description'  		=> 'required',
            'start_time'  		=> 'required',
            'end_time'    => 'required',
            'photo'  	=> 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            $errors=$validator->messages();
            return Redirect::to('/adm/live/edit-live')->withErrors($errors);
        }
        $id=Input::get('id');
        $title=Input::get('title');
        $url=Input::get('url');
        $type=Input::get('type');
        $description=Input::get("description");
        $start_time=Input::get("start_time");
        $end_time=Input::get("end_time");
        $upload_file=Input::get("photo");
        $expert=Input::get("expert");
        $exp=DB::table('experts')->where('name',$expert)->first();
        $live=Live::find($id);
        $live->title=$title;
        $live->url=$url;
        $live->type=$type;
        $live->description=$description;
        $live->start_time=$start_time;
        $live->end_time=$end_time;
        $live->photo=$upload_file;
        $live->relation=$expert;
        $live->exid=$exp->id;
        $live->exdepartment=$exp->department;
        $live->exphoto=$exp->photo;
        $live->save();
        return Redirect::to('/adm/live');
    }

    public function getDeleteLive($id){
        $Live = Live::find($id);
        $Live->delete();
        return Redirect::to('/adm/live');
    }

    /**
     *
     * 上传图片
     */
    public function postUploadLiveThumb(){
        if($_FILES['upload_file']['error']>0){
            return json_encode(array('success'=>false,'msg'=>'上传失败'));
        }else{
            $attach_filename = $_FILES['upload_file']['name'];//名称

            $attach_fileext = $this->get_filetype($attach_filename);//类型

            $rand_name = date('YmdHis', time()).rand(1000,9999);

            $sFileName = $rand_name.'.'.$attach_fileext;

            $sPath = "/upload/live_thumb/$attach_fileext/".date('Ymd',time());

            $sRealPath = public_path().$sPath;

            $this->mkdirs($sRealPath);

            move_uploaded_file($_FILES['upload_file']['tmp_name'], $sRealPath.'/'.$sFileName);

            $sFileNameS = $rand_name . '_s.' . $attach_fileext;

            $this->resizeImage ( $sRealPath.'/'.$sFileName, $sRealPath.'/'.$sFileNameS, 1000, 1000 );

            $sFileUrl = $sPath.'/'.$sFileNameS;

            $json = array('success'=>true,'photo'=>$sFileUrl);

            echo json_encode($json);
            die;
        }
    }

    function get_filetype($filename) {
        $extend = explode("." , $filename);
        return strtolower($extend[count($extend) - 1]);
    }

    function mkdirs($path, $mode = 0777)
    {
        if(!file_exists($path))
        {
            $this->mkdirs(dirname($path), $mode);
            mkdir($path,$mode);
        }
    }

    function resizeImage($im, $dest, $maxwidth, $maxheight) {
        $img = getimagesize($im);
        switch ($img[2]) {
            case 1:
                $im = @imagecreatefromgif($im);
                break;
            case 2:
                $im = @imagecreatefromjpeg($im);
                break;
            case 3:
                $im = @imagecreatefrompng($im);
                break;
        }
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);
        $resizewidth_tag = false;
        $resizeheight_tag = false;
        if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
            if ($maxwidth && $pic_width > $maxwidth) {
                $widthratio = $maxwidth / $pic_width;
                $resizewidth_tag = true;
            }
            if ($maxheight && $pic_height > $maxheight) {
                $heightratio = $maxheight / $pic_height;
                $resizeheight_tag = true;
            }
            if ($resizewidth_tag && $resizeheight_tag) {
                if ($widthratio < $heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }
            if ($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if ($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;
            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;
            if (function_exists("imagecopyresampled")) {
                $newim = imagecreatetruecolor($newwidth, $newheight);
                imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            } else {
                $newim = imagecreate($newwidth, $newheight);
                imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            }
            imagejpeg($newim, $dest);
            imagedestroy($newim);
        } else {
            imagejpeg($im, $dest);
        }
    }
}