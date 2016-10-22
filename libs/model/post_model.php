<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Post_Model
{
    public static function saveTransaction($track)
    {
        global $db;
        $sql="UPDATE orders SET `payment_model`= \"1\" WHERE `track_code` =\"".$track."\"";
        $db->changeData($sql,__FILE__,__LINE__);
    }
};