<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_orders_view_View
{

    private $recent_orders=array();
    private $success;

    private $admin_orders_view_template;
    private $main_template;

    public function __construct($ro,$sc)
    {
        $this->recent_orders=$ro;
        $this->success=$sc;

        $this->main_template=$this->addTemplate('main.tpl');
        $this->admin_orders_view_template=$this->addTemplate('admin_orders_view.tpl');

        $this->replaceRecentOrdersTag();/*افزودن سفارشات قبلی به قالب*/
        $this->replaceContentTag();/*جای گذاری محتوا در قالب*/
        $this->replaceNavigationTag();
        $this->replaceMessageBoxTag();

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

    /*لیست کردن سفارشات قبلی*/
    public function replaceRecentOrdersTag()
    {
        if(count($this->recent_orders)>0)
        {
            preg_match("#\\[(INCOMPLETE_ORDERS)\\](.*)\\[/INCOMPLETE_ORDERS\\]#is",$this->admin_orders_view_template, $sub_tpl1);
            $sum='';
            for($i=0;$i<count($this->recent_orders);$i++)
            {
                $helper=str_replace('{INCOMPLETE_TRACK_ID}',$this->recent_orders[$i]['track_code'],$sub_tpl1[2]);
                $helper=str_replace('{INCOMPLETE_PRICE}',$this->recent_orders[$i]['total_price'],$helper);
                $helper=str_replace('{INCOMPLETE_DATE}',jdate("F j, Y, g:i a",$this->recent_orders[$i]['date']),$helper);
                $helper=str_replace('{INCOMPLETE_PAYMENT}',(($this->recent_orders[$i]['payment_model']==0)?'پرداخت بانکی':'پرداخت به پست'),$helper);
                $sum.=$helper;
            }
            $this->admin_orders_view_template=preg_replace("#\\[(INCOMPLETE_ORDERS)\\](.*)\\[/INCOMPLETE_ORDERS\\]#is",$sum,$this->admin_orders_view_template);
        }
        else
        {
            $this->admin_orders_view_template='';
        }

    }
    /*تگ محتوا را با زیر قالب جایگذین کن*/
    public function replaceContentTag()
    {
        $this->main_template=str_replace('{CONTENT}',$this->admin_orders_view_template,$this->main_template);
    }

    public function replaceNavigationTag()
    {
        $this->main_template=str_replace('{NAVIGATION}','',$this->main_template);
    }

    public function replaceMessageBoxTag()
    {
        if($this->success==1)
        {
            $message_template=$this->addTemplate('message_chk.tpl');
            $message_template=str_replace('{MESSAGE}','این سفارش با موفقیت تکمیل و ارسال شده.',$message_template);
            $this->main_template=str_replace('{MESSAGE_BOX}',$message_template,$this->main_template);

        }
        else
            $this->main_template=str_replace('{MESSAGE_BOX}','',$this->main_template);

    }
};