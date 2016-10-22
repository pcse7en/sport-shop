<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_new_post_Model
{

    public static function getCategoryList()
    {
        global $db;
        $sql='SELECT * FROM `category`';
        return $db->fetchArray($sql,__FILE__,__LINE__);
    }
    /*دریافت اطلاعات کاربر*/
    public static function getUserInformation($user_login)
    {
        global $db;
        $sql="SELECT * FROM `users` WHERE `username`=\"".$user_login."\" OR `email`=\"".$user_login."\"";
        return $db->fetchRow($sql,__FILE__,__LINE__);
    }

    public static function saveNewPost($name,$category,$description,$file_name,$price,$dop,$exp,$number_exist,$weight,$whole_saler_price,$user_id)
    {
        global $db;

        $sql='INSERT INTO `product`(`weight`,`name`,`price`,`number_exist`,`category_id`,`picture`,`text`,`expiration_date`,`date_of_production`,`user_id`,`whole_saler_price`)
              VALUES (\''.$weight.'\',\''.$name.'\',\''.$price.'\',\''.$number_exist.'\',\''.$category.'\',\''.$file_name.'\',\''.$description.'\',\''.$exp.'\',\''.$dop.'\',\''.$user_id.'\',\''.$whole_saler_price.'\');';
        $db->changeData($sql,__FILE__,__LINE__);
    }
};