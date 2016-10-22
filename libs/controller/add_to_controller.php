<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
/*کلاس صفحه بندی سایت*/
class Add_to_Controller
{
    private $id;
    public function __construct()
    {
        if(!isset($_SESSION['login']))
        {
            f_go_last_page();
        }

        if(isset($_GET['add_to']))
        {
            $this->id=preg_replace('/[^0-9]/','',$_GET['add_to']);
            $this->checkProductExist();
            $this->addToBasket();
        }
        else
        {
            f_go_last_page();
        }
    }

    public function checkProductExist()
    {
        require_once 'libs/model/add_to_model.php';
        if((Add_to_Model::checkProductExist($this->id)) != 1)
        {
            f_go_last_page();
        }
    }


    public function addToBasket()
    {
        if(!isset($_SESSION['basket']))
            $_SESSION['basket'] = array();

        if (!in_array($this->id,$_SESSION['basket']))
        {
            array_push($_SESSION['basket'],$this->id);
            sort($_SESSION['basket']);
            if(isset($_SERVER['HTTP_REFERER']))
                f_redirect($_SERVER['HTTP_REFERER']);
            else
                f_redirect('index.php');
        }
        else
        {
            f_go_last_page();
        }
    }
}