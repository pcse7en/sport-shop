<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Incomplete_View
{

    private $previous_orders=array();

    private $incomplete_template;
    private $main_template;

    public function __construct($po)
    {
        $this->previous_orders=$po;
        //print_r($this->previous_orders);exit;
        $this->main_template=$this->addTemplate('main.tpl');
        $this->incomplete_template=$this->addTemplate('incomplete.tpl');

        $this->replacePreviousOrdersTag();/*افزودن سفارشات قبلی به قالب*/
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
    public function replacePreviousOrdersTag()
    {
        if(count($this->previous_orders)>0)
        {
            preg_match("#\\[(INCOMPLETE)\\](.*)\\[/INCOMPLETE\\]#is", $this->incomplete_template, $sub_tpl);
            $helper1=$sub_tpl[2];

            preg_match("#\\[(INCOMPLETE_ORDERS)\\](.*)\\[/INCOMPLETE_ORDERS\\]#is",$helper1, $sub_tpl1);
            $sum='';
            for($i=0;$i<count($this->previous_orders);$i++)
            {
                $helper2=str_replace('{INCOMPLETE_TRACK_ID}',$this->previous_orders[$i]['track_code'],$sub_tpl1[2]);
                $helper2=str_replace('{INCOMPLETE_PRICE}',$this->previous_orders[$i]['total_price'],$helper2);
                $helper2=str_replace('{INCOMPLETE_DATE}',jdate("F j, Y, g:i a",$this->previous_orders[$i]['date']),$helper2);
                $helper2=str_replace('{INCOMPLETE_PAYMENT}',(($this->previous_orders[$i]['payment_model']==0)?'payment':'post'),$helper2);
                //$helper2=str_replace('{INCOMPLETE_TRACK_ID}',$this->previous_orders[$i][''],$helper2);
                $sum.=$helper2;
            }
            $helper1=preg_replace("#\\[(INCOMPLETE_ORDERS)\\](.*)\\[/INCOMPLETE_ORDERS\\]#is",$sum,$helper1);
            $this->incomplete_template=preg_replace("#\\[(INCOMPLETE)\\](.*)\\[/INCOMPLETE\\]#is",$helper1,$this->incomplete_template);
        }
        else
        {
            $this->incomplete_template=preg_replace("#\\[(INCOMPLETE)\\](.*)\\[/INCOMPLETE\\]#is",'',$this->incomplete_template);
        }

    }
    /*تگ محتوا را با زیر قالب جایگذین کن*/
    public function replaceContentTag()
    {
        $this->main_template=str_replace('{CONTENT}',$this->incomplete_template,$this->main_template);
    }

    public function replaceNavigationTag()
    {
        $this->main_template=str_replace('{NAVIGATION}','',$this->main_template);
    }

    public function replaceMessageBoxTag()
    {
        $this->main_template=str_replace('{MESSAGE_BOX}','',$this->main_template);
    }
};