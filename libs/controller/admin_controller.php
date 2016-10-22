<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_Controller
{
    public function __construct()
    {
        if (!(isset($_SESSION['login']) && isset($_SESSION['admin'])))
        {
            f_redirect('index.php?error=2&line='.__LINE__.'&file='.__FILE__);
        }
        require_once 'libs/view/admin_view.php';
        new Admin_View();
    }
}