<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
/*کلاس صفحه بندی سایت*/
class Add_to_Model
{
    public static function checkProductExist($id)
    {
            global $db;
            $sql="SELECT COUNT(*) FROM `product` WHERE `id`=\"".$id."\"";
            return $db->rowCounter($sql, __FILE__, __LINE__);
    }
}