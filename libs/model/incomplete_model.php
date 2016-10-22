<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Incomplete_Model
{
    /*نمایش سفارشات قبلی*/

    /*دریافت اطلاعات کاربر*/
    public static function getUserInformation($user_login)
    {
        global $db;
        $sql="SELECT * FROM `users` WHERE `username`=\"".$user_login."\" OR `email`=\"".$user_login."\"";
        return $db->fetchRow($sql,__FILE__,__LINE__);
    }

    public static function getPreviousOrders($id)
    {
        global $db;
        $sql="SELECT * FROM `orders` WHERE `user_id`=\"".$id."\" AND completion=0 And payment_model=0";
        return $db->fetchArray($sql,__FILE__,__LINE__);
    }

}