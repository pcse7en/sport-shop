<?php
class Login_Controller
{
    private $username;
    private $password;
    public function __construct()
    {
        if(isset($_POST['username']))
        {
            $this->username=$_POST['username'];
        }
        else
        {
            f_go_last_page();
        }
        if(isset($_POST['password']))
        {
            $this->password=$_POST['password'];
        }
        else
        {
            f_go_last_page();
        }
        include_once 'libs/model/login_model.php';

        $this->checkLogin();
        f_go_last_page();
    }

    public function checkLogin()
    {
        if(Login_Model::checkLogin($this->username,$this->password)==1)
        {
            $_SESSION['login']=1;
            $_SESSION['username']=$this->username;
            if(Login_Model::checkAdminAccess($this->username)==1)
            {
                $_SESSION['admin']=1;
            }
            /*دریافت گروه کاربری*/
            $_SESSION['position']=Login_Model::getUserGroup($this->username);

        }
        else
        {
            f_go_last_page();
        }
    }

}