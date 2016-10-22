<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}

class Admin_orders_view_Controller
{
    private $success=0;
    private $get_recent_orders=array();

    public function __construct()
    {
        if (!(isset($_SESSION['login']) && isset($_SESSION['admin'])))
        {
            f_redirect('index.php?error=2&line='.__LINE__.'&file='.__FILE__);
        }
        require_once 'libs/model/admin_orders_view_model.php';

        if(isset($_GET['send']))
        {
            if(f_validate_numbers($_GET['send']))
            {
                $this->setCompleteOrder($_GET['send']);
                $this->success=1;
            }
        }

        $this->getRecentOrders();
        require_once 'libs/view/admin_orders_view_view.php';
        new Admin_orders_view_View($this->get_recent_orders,$this->success);
    }

    /*نمایش سفارشات قبلی*/
    public function setCompleteOrder($track)
    {
        Admin_orders_view_Model::setCompleteOrder($track);
    }

    /*نمایش سفارشات قبلی*/
    public function getRecentOrders()
    {
        $this->get_recent_orders=Admin_orders_view_Model::getRecentOrders();
    }

};
