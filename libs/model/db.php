<?php
if (! defined ('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
/*کلاس پایگاه داده ما*/
class Db
{

    private $dbHandel = NULL;/*جهت نگه داری دستگیره پایگاه داده*/

    public function __construct()
    {
        /*سعی کن یک شی جدید از پایگاه داده ما بسازی*/
        try
        {
            /*قسمت دی اس ان پایگاه داده را بساز که شامل مدل پایگاه داده،مکان سرور پایگاه داده،نام پایگاه داده و نوع یونی کد پشتیبانی شونده است.*/
            $dsn = "mysql:host=".DATABASE_HOST.";dbname=".DATABASE_NAME.";charset=utf8";
/*ساخت یک شی جدید از پایگاه داده به همراه ورود نام کاربری و رمز عبور مدیر پایگاه داده*/
            $this->dbHandel = new PDO($dsn, DATABASE_USERNAME,DATABASE_PASSWORD);
            $this->dbHandel->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); //ست کردن نحوه نمایش ارور
        }
        catch (PDOException $error)/*اگر شی پایگاه داده ساخته نشد.*/
        {
            f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
        }

    }
/*یک تابع کمکی برای دسترسی به پایگاه داده و واکشی تعداد سطر های یک جدول یا جواب خاص*/
    public function rowCounter($query,$page,$line)
    {
        $sth=$this->dbHandel->prepare($query);

        if(!$sth->execute())
            f_redirect('index.php?error=2&page='.$page.'&line='.$line);
        $result = $sth->fetchColumn(0);

        return $result;
    }
/*متد کمکی برای تغییر یا حذف عناصر از روی پایگاه داده*/
    public function changeData($query,$page,$line)
    {
        $sth=$this->dbHandel->prepare($query);
        if(!$sth->execute())
            f_redirect('index.php?error=2&page='.$page.'&line='.$line);
        else
            return 1;
    }
/*متد کمکی برای بازگردادندن جدول حاصل از یک عمل سلکت یا انتخاب*/
    public function fetchArray($query,$page,$line)
    {
        $sth=$this->dbHandel->prepare($query);
        if(!$sth->execute())
            f_redirect('index.php?error=2&page='.$page.'&line='.$line);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /*متد کمکی برای بازگرداندن یک سطر از جدول و اشاره به سطر های بعدی*/
    public function fetchRow($query,$page,$line)
    {
        $sth=$this->dbHandel->prepare($query);
        if(!$sth->execute())
            f_redirect('index.php?error=2&page='.$page.'&line='.$line);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
/*رابط بازگشت دهنده دسته پایگاه داده*/
    public function getDbHandel()
    {
        if (isset($this->dbHandel))
            return $this->dbHandel;
        else
            return 0;
    }
/*کلاس مخرب پایگاه داده*/
    public function __destruct()
    {
        if (isset($this->dbHandel))
            $this->dbHandel = NULL;
    }
};

