<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Page_Model
{
    public static function getPosts($start, $number, $subject = 0)
    {
        global $db;
        $sql = '';
        if ($subject == 0)
            $sql = 'SELECT * FROM product ORDER BY ID DESC LIMIT ' . $start . ',' . $number ;
        else
            $sql = 'SELECT * FROM product WHERE category_id = ' . $subject .' ORDER BY id DESC LIMIT ' . $start . ',' . $number;

        return $db->fetchArray($sql, __FILE__, __LINE__);
    }

    public static function getPagination($subject=0)
    {
        global $db;
        $sql = '';
        if ($subject == 0)
            $sql = 'SELECT COUNT(*) FROM product';
        else
            $sql = 'SELECT COUNT(*) FROM product WHERE category_id = ' . $subject ;

        return $db->rowCounter($sql, __FILE__, __LINE__);
    }
};