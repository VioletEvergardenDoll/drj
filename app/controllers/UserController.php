<?php


class UserController extends BaseController
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
    public function adminIndex()
    {
        return View::make('admin.admin-index');
    }

    public function getIndex()
    {
        $users = User::paginate(5);
        return View::make('admin.user.list')->with('users',$users);
    }

    /**
     * 添加用户
     */
    public function getAddUser()
    {
        return View::make('admin.user.add');
    }

    public function postAddUser()
    {
        //表单验证
        $data =Input::all();
        $rules =array(
            'username'=>'required|unique:users|min:5|regex:/^[a-zA-Z]+([A-Za-z0-9])*/',
            'password'=>'required|min:6|confirmed',
        );
        $validator = Validator::make($data,$rules);
        if($validator->fails())
        {
            $errors = $validator->messages();
            return Redirect::to('/adm/user/add-user')->withErrors($errors);
        }



        $username=Input::get('username');
        $password=Input::get('password');
        $users =new User();
        $users->username=$username;
        $users->password=Hash::make($password);
        $users->save();
        return Redirect::to('/adm/user');
    }

    public function getEditUser($id)
    {
        $user = User::find($id);
        return View::make('admin.user.edit')->with('user',$user);
    }
    public function postEditUser()
    {
        $id=Input::get('id');
        $username=Input::get('username');
        $password=Input::get('password');
        $user = User::find($id);
        $user->username=$username;
        $user->password=Hash::make($password);
        $user->save();
        return Redirect::to('/adm/user');
    }

    public function postDeleteUser()
    {
        $id=Input::get("id");
        $user=User::find($id);
        $user->delete();
        return "删除成功！";
    }

    public function Login(){
        return View::make("admin.login");
    }

    public function DoLogin(){
        $username=Input::get('username');
        $password=Input::get('password');
        $a=DB::table('users')->where('username',$username)->first();
        if(Auth::attempt(array('username'=>$username,'password'=>$password))) {
            return Redirect::to('/adm');
        }else{
            echo'登录失败';
            return Redirect::to('/login');
        }
    }

    public function Logout(){
        Auth::logout();
        return Redirect::to('/login');
    }

}