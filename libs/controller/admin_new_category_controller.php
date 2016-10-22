<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_new_category_Controller
{

    private $name;
    private $description;

    private $success=0;
    private $error=0;

    public function __construct()
    {
        if (!(isset($_SESSION['login']) && isset($_SESSION['admin'])))
        {
            f_redirect('index.php?error=2&line='.__LINE__.'&file='.__FILE__);
        }

        require_once 'libs/model/admin_new_category_model.php';

        if(isset($_GET['add_new']))
        {
            $this->validationData();
            $this->validateName();
            $this->saveNewCategory();
            f_redirect('index.php?admin_new_category=1&new_category_success=1');
        }
        if(isset($_GET['new_category_success']))
        {
            $this->success=1;
        }
        elseif(isset($_GET['new_category_error']))
        {
            if(f_validate_numbers($_GET['new_category_error']))
                $this->error=$_GET['new_category_error'];
            else
                f_redirect('index.php?error=3&line='.__LINE__.'&file='.__FILE__);
        }
        require_once 'libs/view/admin_new_category_view.php';
        new Admin_new_category_View($this->error,$this->success);
    }
    /*بررسی صحت داده های ورودی*/
    public function validationData()
    {
        if(isset($_POST['name'])&&isset($_POST['description']))
        {
            /*بررسی صحت متون ورودی*/
            if(strlen($_POST['name'])>0)
                $this->name=$_POST['name'];
            else
                f_redirect('index.php?admin_new_category=1&new_category_error=2');

            if(strlen($_POST['description'])>0)
                $this->description=$_POST['description'];
            else
                f_redirect('index.php?admin_new_category=1&new_category_error=3');
        }
        else
            f_redirect('index.php?admin_new_category=1&new_category_error=4');
    }
    public function validateName()
    {
        if(Admin_new_category_Model::validateName($this->name)>0)
            f_redirect('index.php?admin_new_category=1&new_category_error=5');
    }
    /*ذخیره محصول جدید*/
    public function saveNewCategory()
    {
        Admin_new_category_Model::saveNewCategory($this->name,$this->description);
    }

};