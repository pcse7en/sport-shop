<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Post_View
{
    private $track;
    private $message_chk_template;
    private $main_template;
    public function __construct($tc)
    {
        $this->track = $tc;

        $this->main_template=$this->addTemplate('main.tpl');
        $this->message_chk_template=$this->addTemplate('message_chk.tpl');


        $this->replaceNavigationTag();
        $this->replaceMessageBoxTag();
        $this->replaceContentTag();/*جای گذاری محتوا در قالب*/

        include_once 'libs/view/view.php';
        new View($this->main_template);
    }

    public function addTemplate($file)
    {
        /*اگر فایل قالب وجود داشت در مسیر داده شده*/
        if(file_exists(TEMPLATE_ADDRESS.$file))
        {
            /*محتوای فایل قالب را درون متغیر زیر قالب بریز*/
            return file_get_contents(TEMPLATE_ADDRESS . $file);
        }
        else
        {
            f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
        }
    }
    /*تگ محتوا را با زیر قالب جایگذین کن*/
    public function replaceContentTag()
    {

        $this->main_template=str_replace('{CONTENT}','',$this->main_template);
    }

    public function replaceNavigationTag()
    {
        $this->main_template=str_replace('{NAVIGATION}','',$this->main_template);
    }

    public function replaceMessageBoxTag()
    {
        $message='با تشکر از خرید شما دوست عزیز ، سفارش شما با کد رهگیری '.$this->track;
        $message.='ثبت گردید حال برای بازگشت به صفحه اصلی  ';
        $message.='<a href="index.php"> اینجا  </a>';
        $message.=' کلیک کنید . با تشکر مدیریت فروشگاه فیفا!';
        $this->message_chk_template=str_replace('{MESSAGE}',$message,$this->message_chk_template);
        $this->main_template=str_replace('{MESSAGE_BOX}',$this->message_chk_template,$this->main_template);
    }
};