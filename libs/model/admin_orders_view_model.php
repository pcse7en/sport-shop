<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_orders_view_Model
{
    /*نمایش سفارشات قبلی*/

    /*دریافت اطلاعات کاربر*/
    public static function setCompleteOrder($track)
    {
        global $db;
        $sql="UPDATE `orders` SET `posted` = \"1\" WHERE `track_code` = \"".$track."\"";
        $db->changeData($sql,__FILE__,__LINE__);
    }

    public static function getRecentOrders()
    {
        global $db;
        $sql='SELECT * FROM `orders` WHERE `posted`=0 AND (completion=1 OR payment_model=1)';
        return $db->fetchArray($sql,__FILE__,__LINE__);
    }

};