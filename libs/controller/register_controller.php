<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Register_Controller
{
    private $name_family;
    private $username;
    private $password;
    private $mobile;
    private $email;
    private $address;

    public function __construct()
    {
        if($_GET['register']==1)
        {
            $this->registerPageShow();
            include_once 'libs/view/register_view.php';
            new Register_View(1);

        }
        if($_GET['register']==2)
        {
            $this->registerPageShow();
            include_once 'libs/model/register_model.php';
            if(isset($_POST['name_family'])&&isset($_POST['username'])&&isset($_POST['password'])&&
                isset($_POST['repeat_password'])&&isset($_POST['email'])&&isset($_POST['mobile'])&&isset($_POST['address'])&&isset($_POST['submit']))
            {
                $this->name_family=$_POST['name_family'];
                if($_POST['password']==$_POST['repeat_password'])
                {
                    $this->password=md5($_POST['password']);
                }
                else
                {
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                }
                $this->username=$_POST['username'];
                $this->mobile=$_POST['mobile'];
                $this->email=$_POST['email'];
                $this->address=$_POST['address'];
            }
            else
            {
                f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
            }
            $this->userEarlyExist();
            $this->saveUserInformation();
            include_once 'libs/view/register_view.php';
            new Register_View(2);

        }
        else
        {
            f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
        }

    }
    public function userEarlyExist()
    {
        if((Register_Model::userEarlyExist($this->username,$this->email))==0)
        {
            return 1;
        }
        else
        {
            return f_redirect('index.php?register=1');
        }
    }

    public function registerPageShow()
    {
        if(isset($_SESSION['login']))
        {
            f_redirect('index.php');
        }
    }

    public function saveUserInformation()
    {
        Register_Model::saveUserInformation($this->name_family,$this->username,$this->password,$this->email,$this->address,$this->mobile,time());
    }

    public function validate()
    {

    }

}