<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Basket_Controller
{
    private $basket=array();
    private $item=array();
    public function __construct()
    {
        if(!($_SESSION['username'] && isset($_SESSION['basket'])))
            f_redirect('index.php');
        $this->basket=$_SESSION['basket'];
        if(count($this->basket)==0)
            f_redirect('index.php');

        $this->getBasketArray();

        require_once 'libs/view/basket_view.php';
        new Basket_View($this->item);
    }

    public function getBasketArray()
    {
        $ids = implode(' ,',$this->basket);
        require_once 'libs/model/basket_model.php';
        $this->item=Basket_Model::getBasketArray($ids);
        if(count($this->item)==0)
            f_redirect('index.php');
    }

}