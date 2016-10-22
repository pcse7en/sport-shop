<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Login_Model
{

    public static function checkLogin($username,$password)
    {
        global $db;
        if(LOGIN_BY_EMAIL==1)
            $sql="SELECT COUNT(*) FROM `users` WHERE `password` = \"".$password."\" AND `email` = \"".$username."\"";
        else
            $sql="SELECT COUNT(*) FROM `users` WHERE `username` = \"".$username."\" AND `password` = \"".$password."\"";

        return $db->rowCounter($sql, __FILE__, __LINE__);
    }

    public static function checkAdminAccess($username)
    {   global $db;
        $sql='';
        if(LOGIN_BY_EMAIL==1)
            $sql="SELECT `admin_access` FROM `users` WHERE `email` = \"".$username."\"";
        else
            $sql="SELECT `admin_access` FROM `users` WHERE `username` = \"".$username."\"";

        $result=$db->fetchArray($sql, __FILE__, __LINE__);
        return $result[0]['admin_access'];
    }

    public static function getUserGroup($username)
    {
        global $db;
        $sql='';
        if(LOGIN_BY_EMAIL==1)
            $sql="SELECT `position` FROM `users` WHERE `email` = \"".$username."\"";
        else
            $sql="SELECT `position` FROM `users` WHERE `username` = \"".$username."\"";
        $result=$db->fetchRow($sql, __FILE__, __LINE__);
        return $result['position'];
    }
}