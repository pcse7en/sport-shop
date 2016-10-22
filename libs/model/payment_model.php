<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Payment_Model
{

    public static function checkTrackCode($track)
    {
        global $db;
        $sql="SELECT `completion` FROM `orders` WHERE `track_code`=\"".$track."\"";
        return $db->rowCounter($sql,__FILE__,__LINE__);
    }

    public static function getTotalAmount($track)
    {
        global $db;
        $sql="SELECT `total_price` FROM `orders` WHERE `track_code`=\"".$track."\"";
        return $db->rowCounter($sql,__FILE__,__LINE__);
    }

    public static function saveTransaction($trans_id,$id_get,$track)
    {
        global $db;
        $sql="UPDATE orders SET `completion`=1,`trans_id`=\"".$trans_id."\",`id_get`=\"".$id_get."\"WHERE `track_code` =\"".$track."\"";
        $db->changeData($sql,__FILE__,__LINE__);
    }

    public static function updateProductTable($track)
    {
        global $db;
        $sql="SELECT * FROM `sale` WHERE `track_code`=\"".$track."\"";
        $array=$db->fetchArray($sql,__FILE__,__LINE__);
        $count=count($array);
        $sql="";
        for($i=0;$i<$count;$i++)
        {
            $sql.="UPDATE `product` SET `number_exist`=(`number_exist`-".$array[$i]['number'].") WHERE `id`=".$array[$i]['product_id'].";";
        }
        $db->changeData($sql,__FILE__,__LINE__);
    }
}