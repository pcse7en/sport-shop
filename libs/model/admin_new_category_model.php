<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_new_Category_Model
{

    public static function validateName($name)
    {
        global $db;
        $sql='SELECT COUNT(*) FROM `category` WHERE `name`=\''.$name.'\'';
        return $db->rowCounter($sql,__FILE__,__LINE__);
    }

    public static function saveNewCategory($name,$description)
    {
        global $db;
        $sql='INSERT INTO `category`(`name`,`description`) VALUES (\''.$name.'\',\''.$description.'\')';
        $db->changeData($sql,__FILE__,__LINE__);
    }
};