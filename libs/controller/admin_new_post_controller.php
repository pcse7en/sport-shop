<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_new_post_Controller
{
    private $username;
    private $category;
    private $name;
    private $description;

    private $price;
    private $file_name;

    private $exp;
    private $dop;
    private $weight;
    private $number;
    private $whole_saler_price;
    private $success=0;
    private $error=0;

    private $category_list=array();
    private $user_information=array();

    public function __construct()
    {
        if (!(isset($_SESSION['login']) && isset($_SESSION['admin'])))
        {
            f_redirect('index.php?error=2&line='.__LINE__.'&file='.__FILE__);
        }

        require_once 'libs/model/admin_new_post_model.php';

        if(isset($_GET['add_new']))
        {
            $this->validationData();
            $this->getUserInformation();
            $this->saveNewPost();
            f_redirect('index.php?admin_new_post=1&new_post_success=1');
        }

        $this->getCategoryList();
        if(isset($_GET['new_post_success']))
        {
            $this->success=1;
        }
        elseif(isset($_GET['new_post_error']))
        {
            if(f_validate_numbers($_GET['new_post_error']))
                $this->error=$_GET['new_post_error'];
            else
                f_redirect('index.php?error=3&line='.__LINE__.'&file='.__FILE__);
        }
        require_once 'libs/view/admin_new_post_view.php';
        new Admin_new_post_View($this->category_list,$this->error,$this->success);
    }
/*بررسی صحت داده های ورودی*/
    public function validationData()
    {
        if(isset($_POST['title'])&&isset($_POST['category'])&&isset($_POST['description'])&&isset($_POST['price'])
            &&isset($_POST['dop'])&&isset($_POST['exp'])&&isset($_POST['number'])&&isset($_POST['weight'])&&isset($_POST['whole_sale_price']))
        {
            /*بررسی فایل آپلود شده*/
            $this->uploadFile();
            /*بررسی صحت متون ورودی*/
            if(strlen($_POST['title'])>0)
                $this->name=$_POST['title'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=1');

            if(strlen($_POST['description'])>0)
                $this->description=$_POST['description'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=2');

            /*بررسی صحت تاریخ های ورودی*/
            if(f_validate_date_jalali($_POST['dop']))
            {
                $date=explode('/',$_POST['dop']);
                $this->dop=jmktime(0,0,0,$date[1],$date[2],$date[0]);
            }
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=8');

            if(f_validate_date_jalali($_POST['exp']))
            {
                $date=explode('/',$_POST['exp']);
                $this->exp=jmktime(0,0,0,$date[1],$date[2],$date[0]);
            }
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=9');

            /*بررسی صحت اعداد ورودی*/
            if(f_validate_numbers($_POST['category']))
                $this->category=$_POST['category'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=3');
            if(f_validate_numbers($_POST['price']))
                $this->price=$_POST['price'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=4');
            if(f_validate_numbers($_POST['number']))
                $this->number=$_POST['number'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=5');

            if(f_validate_numbers($_POST['weight']))
                $this->weight=$_POST['weight'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=5');
            if(f_validate_numbers($_POST['whole_sale_price']))
                $this->whole_saler_price=$_POST['whole_sale_price'];
            else
                f_redirect('index.php?admin_new_post=1&new_post_error=6');

            $this->username=$_SESSION['username'];
        }
        else
            f_redirect('index.php?admin_new_post=1&new_post_error=7');
    }

    public function getCategoryList()
    {
        $this->category_list=Admin_new_post_Model::getCategoryList();
    }
/*تنظیمات و آپلود فایل تصویر محصول*/
    public function uploadFile()
    {
        if(isset($_FILES['picture']))
        {
            $name=$_FILES['picture']['name'];
            $type=$_FILES['picture']['type'];
            $tmp=$_FILES['picture']['tmp_name'];
            $hash=md5($name.microtime()).srand().substr($name,-5,5);
            if(is_uploaded_file($tmp))
            {
                $postfix=array("image/jpg","image/png","image/gif","image/jpeg");
                if(in_array($type,$postfix))
                {
                    if(move_uploaded_file($tmp,"upload/product_img/".$hash))
                    {
                        $this->file_name=$hash;
                    }
                    else
                    {
                        f_redirect('index.php?admin_new_post=1&new_post_error=10');
                    }
                }
                else
                {
                    f_redirect('index.php?admin_new_post=1&new_post_error=11');
                }
            }
            else
            {
                $this->file_name='default.jpg';
            }
        }
        else
            $this->file_name='default.jpg';

    }
    /*دریافت اطلاعات کاربر*/
    public function getUserInformation()
    {
        $this->user_information=Admin_new_post_Model::getUserInformation($this->username);
    }
/*ذخیره محصول جدید*/
    public function saveNewPost()
    {
        Admin_new_post_Model::saveNewPost($this->name,$this->category,$this->description,$this->file_name,$this->price,
            $this->dop,$this->exp,$this->number,$this->weight,$this->whole_saler_price,$this->user_information['id']);
    }

};