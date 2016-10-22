<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Calculate_View
{
    private $user_information=array();
    private $invoice=array();
    private $weight;
    private $tax;
    private $send_cost;
    private $send_model;
    private $payment_model;
    private $price;
    private $track_code;

    private $invoice_template;
    private $main_template;

    public function __construct($ui,$in,$we,$ta,$sc,$sm,$pm,$pr,$tc)
    {
        $this->user_information=$ui;
        $this->invoice=$in;
        $this->weight=$we;
        $this->tax=$ta;
        $this->send_cost=$sc;
        $this->send_model=$sm;
        $this->payment_model=$pm;
        $this->price=$pr;
        $this->track_code=$tc;
        $this->main_template=$this->addTemplate('main.tpl');
        $this->invoice_template=$this->addTemplate('invoice.tpl');

        $this->replaceInvoiceTag();/*جایگذاری تگ های صورت حساب*/
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
/*جایگذاری تگ های صورت حساب مشتری*/
    public function replaceInvoiceTag()
    {
        $this->invoice_template=str_replace('{PAGE}',($this->payment_model==0)?'payment':'post',$this->invoice_template);
        $this->invoice_template=str_replace('{USER_ID}',$this->user_information['id'],$this->invoice_template);
        $this->invoice_template=str_replace('{USERNAME}',$this->user_information['name'],$this->invoice_template);
        $this->invoice_template=str_replace('{MOBILE}',$this->user_information['mobile'],$this->invoice_template);
        $this->invoice_template=str_replace('{POST_ADDRESS}',$this->user_information['address'],$this->invoice_template);
        $this->invoice_template=str_replace('{EMAIL}',$this->user_information['email'],$this->invoice_template);
        $this->invoice_template=str_replace('{USERNAME}',$this->user_information['name'],$this->invoice_template);
        $this->invoice_template=str_replace('{MOBILE}',$this->user_information['mobile'],$this->invoice_template);
        $this->invoice_template=str_replace('{POST_ADDRESS}',$this->user_information['address'],$this->invoice_template);
        $this->invoice_template=str_replace('{EMAIL}',$this->user_information['email'],$this->invoice_template);


        preg_match("#\\[(PRODUCT)\\](.*)\\[/PRODUCT\\]#is", $this->invoice_template, $sub_tpl);
        $helper='';
        $sum='';
        for($i=0;$i<count($this->invoice);$i++)
        {
            $helper=str_replace('{ID}',$this->invoice[$i][0],$sub_tpl[2]);
            $helper=str_replace('{NAME}',$this->invoice[$i][4],$helper);
            $helper=str_replace('{SOME}',$this->invoice[$i][1],$helper);
            $helper=str_replace('{PRICE}',$this->invoice[$i][2],$helper);
            $sum.=$helper;
        }
        $this->invoice_template=preg_replace("#\\[(PRODUCT)\\](.*)\\[/PRODUCT\\]#is", $sum, $this->invoice_template);

        $this->invoice_template=str_replace('{POST_COST}',$this->send_cost,$this->invoice_template);
        $this->invoice_template=str_replace('{TAX}',$this->tax,$this->invoice_template);
        $this->invoice_template=str_replace('{INVOICE_ID}',$this->track_code,$this->invoice_template);
        $this->invoice_template=str_replace('{TOTAL_PRICE}',$this->price,$this->invoice_template);
        $this->invoice_template=str_replace('{SEND_MODEL}',($this->send_model==1)?'پست پیشتاز':'پست سفارشی',$this->invoice_template);
        $this->invoice_template=str_replace('{WEIGHT}',$this->weight,$this->invoice_template);

        if($this->payment_model==0)
        {
            preg_match("#\\[(BANK)\\](.*)\\[/BANK\\]#is", $this->invoice_template, $sub_tpl);
            $this->invoice_template=preg_replace("#\\[(BANK)\\](.*)\\[/BANK\\]#is",$sub_tpl[2],$this->invoice_template);
            $this->invoice_template=preg_replace("#\\[(POST)\\](.*)\\[/POST\\]#is",'',$this->invoice_template);
        }
        else
        {
            preg_match("#\\[(POST)\\](.*)\\[/POST\\]#is", $this->invoice_template, $sub_tpl);
            $this->invoice_template=preg_replace("#\\[(POST)\\](.*)\\[/POST\\]#is",$sub_tpl[2],$this->invoice_template);
            $this->invoice_template=preg_replace("#\\[(BANK)\\](.*)\\[/BANK\\]#is",'',$this->invoice_template);
        }
    }
    /*تگ محتوا را با زیر قالب جایگذین کن*/
    public function replaceContentTag()
    {
        $this->main_template=str_replace('{CONTENT}',$this->invoice_template,$this->main_template);
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