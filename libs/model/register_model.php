<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Register_Model
{

    public static function userEarlyExist($username,$email)
    {
        global $db;
        $sql="SELECT COUNT(*) FROM `users` WHERE `username` = \"".$username."\" OR `email` = \"".$email."\"";
        return $db->rowCounter($sql, __FILE__, __LINE__);
    }

    public static function saveUserInformation($name,$username,$password,$email,$address,$mobile,$date)
    {
        global $db;
        $sql="INSERT INTO `users` (`name`,`username`,`password`,`email`,`address`,`mobile`,`register_date`)VALUES(\"".$name."\",\"".$username."\",\"".$password."\",\"".$email."\",\"".$address."\",\"".$mobile."\",\"".$date."\")";
       //echo $sql;exit;
        $db->changeData($sql, __FILE__, __LINE__);
    }
}