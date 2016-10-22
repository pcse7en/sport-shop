<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Incomplete_Controller
{

    private $previous_orders=array();
    private $user_information;
    private $user_login;
    public function __construct()
    {
        if(!isset($_SESSION['username']))
            f_redirect('index.php');
        else
            $this->user_login=$_SESSION['username'];
        require_once 'libs/model/incomplete_model.php';
        $this->getUserInformation();
        $this->getPreviousOrders();
        require_once 'libs/view/incomplete_view.php';
        new Incomplete_View($this->previous_orders);
    }
    /*دریافت اطلاعات کاربر*/
    public function getUserInformation()
    {
        $this->user_information=Incomplete_Model::getUserInformation($this->user_login);
    }
        /*نمایش سفارشات قبلی*/
    public function getPreviousOrders()
    {
        $this->previous_orders=Incomplete_Model::getPreviousOrders($this->user_information['id']);
    }

}


?>
