<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Calculate_Model
{

    /*دریافت اطلاعات کاربر*/
    public static function getUserInformation($username)
    {
        global $db;
        $sql="SELECT * FROM `users` WHERE `username`=\"".$username."\"";
        return $db->fetchRow($sql,__FILE__,__LINE__);
    }

    /*دریافت اطلاعات محصول*/
    public static function getProductInformation($ids)
    {
        global $db;
        $sql="SELECT * FROM `product` WHERE `id` IN(".$ids.")";
        return $db->fetchArray($sql, __FILE__, __LINE__);
    }
    /*ثبت موقت سفارش مشتری و دریافت شماره پیگیری*/
    public static function temporaryStorage($user_id,$invoice=array(),$price,$tax,$payment_model,$weight,$post_model,$post_cost,$track_code)
    {
        global $db;
        $sql="INSERT INTO `sale`(`product_id`,`number`,`track_code`)VALUES";
/*ذخیره سفارشات در جدول فروش*/
        $count=count($invoice);
        for($i=0;$i<$count;$i++)
        {
           $sql.="(\"".$invoice[$i][0]."\",\"".$invoice[$i][1]."\",\"".$track_code."\")";
               if($i+1==$count)
                   $sql.="";
               else
                   $sql.=",";
        }
        $db->changeData($sql,__FILE__,__LINE__);
/*ذخیره اطلاعات یک سفارش*/
        $sql="INSERT INTO `orders`(`track_code`,`user_id`,`date`,`tax`,`post_model`,`total_price`,`total_weight`,`payment_model`,`post_cost`)
VALUES(\"".$track_code."\",\"".$user_id."\",\"".time()."\",\"".$tax."\",\"".$post_model."\",\"".$price."\",\"".$weight."\",\"".$payment_model."\",\"".$post_cost."\")";
        $db->changeData($sql,__FILE__,__LINE__);
    }

};