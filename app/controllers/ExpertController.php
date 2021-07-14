<?php


class ExpertController extends BaseController
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
        $experts = Expert::paginate(6);
        return View::make('admin.expert.list')->with('experts',$experts);
    }

    /**
     * 添加用户
     */
    public function getAddExpert()
    {
        return View::make('admin.expert.add');
    }

    public function postAddExpert()
    {
        //表单验证
        $data =Input::all();
        $rules =array(
            'name'  		=> 'required',
            'photo'  		=> 'required',
            'title'  		=> 'required',
            'postion'  		=> 'required',
            'department'    => 'required',
            'hospital'  	=> 'required',
            'description'   => 'required',
            'education'     => 'required'
        );
        $validator = Validator::make($data,$rules);
        if($validator->fails())
        {
            $errors = $validator->messages();
            return Redirect::to('/adm/expert/add-expert')->withErrors($errors);
        }



        $name=Input::get('name');
        $photo=Input::get('photo');
        $title=Input::get('title');
        $postion=Input::get('postion');
        $department=Input::get('department');
        $hospital=Input::get('hospital');
        $description=Input::get('description');
        $education=Input::get('education');
        $expert =new Expert();
        $expert->name=$name;
        $expert->photo=$photo;
        $expert->title=$title;
        $expert->postion=$postion;
        $expert->department=$department;
        $expert->hospital=$hospital;
        $expert->description=$description;
        $expert->education=$education;
        $expert->save();
        return Redirect::to('/adm/expert');
    }

    public function getEditExpert($id)
    {
        $expert = Expert::find($id);
        return View::make('admin.expert.edit')->with('expert',$expert);
    }
    public function postEditExpert()
    {
        //表单验证
        $data =Input::all();
        $rules =array(
            'name'  		=> 'required',
            'photo'  		=> 'required',
            'title'  		=> 'required',
            'postion'  		=> 'required',
            'department'    => 'required',
            'hospital'  	=> 'required',
            'description'   => 'required',
            'education'     => 'required'
        );
        $validator = Validator::make($data,$rules);
        if($validator->fails())
        {
            $errors = $validator->messages();
            return Redirect::to('/adm/expert/add-expert')->withErrors($errors);
        }


        $id=Input::get('id');
        $name=Input::get('name');
        $photo=Input::get('photo');
        $title=Input::get('title');
        $postion=Input::get('postion');
        $department=Input::get('department');
        $hospital=Input::get('hospital');
        $description=Input::get('description');
        $education=Input::get('education');
        $expert=Expert::find($id);
        $expert->name=$name;
        $expert->photo=$photo;
        $expert->title=$title;
        $expert->postion=$postion;
        $expert->department=$department;
        $expert->hospital=$hospital;
        $expert->description=$description;
        $expert->education=$education;
        $expert->save();
        return Redirect::to('/adm/expert');
    }

    public function postDeleteExpert()
    {
        $id=Input::get("id");
        $expert=Expert::find($id);
        $expert->delete();
        return "删除成功！";
    }

    /**
     *
     * 上传图片
     */
    public function postUploadDocThumb(){
        if($_FILES['upload_file']['error']>0){
            return json_encode(array('success'=>false,'msg'=>'上传失败'));
        }else{
            $attach_filename = $_FILES['upload_file']['name'];

            $attach_fileext = $this->get_filetype($attach_filename);

            $rand_name = date('YmdHis', time()).rand(1000,9999);

            $sFileName = $rand_name.'.'.$attach_fileext;

            $sPath = "/upload/expert_thumb/$attach_fileext/".date('Ymd',time());

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