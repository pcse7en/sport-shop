<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
/*کلاس صفحه بندی سایت*/
class Logout_Controller
{
    public function __construct()
    {
        session_destroy();
        f_go_last_page();
    }
}