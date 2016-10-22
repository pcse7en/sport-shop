<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Remove_to_Controller
{
    private $id;
    public function __construct()
    {
        if(isset($_GET['remove_to']))
        {
            $this->id=preg_replace('/[^0-9]/','',$_GET['remove_to']);
            if(($key = array_search($this->id, $_SESSION['basket'])) !== false)
            {
                unset($_SESSION['basket'][$key]);
                $_SESSION['basket'] = array_values($_SESSION['basket']);
                f_go_last_page();
            }
            else
            {
                f_go_last_page();
            }
        }
        else
        {
            f_go_last_page();
        }
    }


};