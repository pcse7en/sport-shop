<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Basket_Model
{
    public static function getBasketArray($ids)
    {
        global $db;
        $sql="SELECT * FROM `product` WHERE `id` IN(".$ids.")";
        return $db->fetchArray($sql, __FILE__, __LINE__);
    }

};