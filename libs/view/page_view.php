<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Page_View
{
    private $posts=array();
    private $pages_template;

    private $navigation;

    private $main_template;
    private $template='';

    public function __construct($post,$nav)
    {
        /*دریافت ورودی های ارسال شده از طرف کنترلگر برنامه*/
        $this->posts=$post;
        $this->navigation=$nav;
        /*گرفتن قالب از پوشه قالب ها*/
        $this->pages_template =$this->addTemplate('pages.tpl');
        /*صدا زدن جایگذین گر تگ های زیر قالب*/
        $this->replacer();
/*بار کردن و فرا خوان و ایجاد آبجکت از سیستم نمایش سایت*/
        $this->main_template =$this->addTemplate('main.tpl');

        $this->replaceContentTag();
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
            f_redirect('index.php?error=1');
        }
    }
/*تگ محتوا را با زیر قالب جایگذین کن*/
    public function replaceContentTag()
    {
        $this->main_template=str_replace('{CONTENT}',$this->template,$this->main_template);
    }
    /*بارگذاری نوار ناوبری سایت*/
    public function replaceNavigationTag()
    {
        $this->main_template=str_replace('{NAVIGATION}',$this->navigation,$this->main_template);
    }
    /*بارگذاری مسیج باکس بالای سایت*/
    public function replaceMessageBoxTag()
    {
        $this->main_template=str_replace('{MESSAGE_BOX}','',$this->main_template);
    }

    /*در اینجا ورودی ها گرفته شده و جایگذین می شوند*/
    public function replacer()
    {
        for($i=0;$i<count($this->posts);$i++)
        {
            $helper=$this->pages_template;
            $helper=str_replace('{POST_LINK}','index.php?post='.$this->posts[$i]['id'],$helper);
            $helper=str_replace('{POST_TITLE}',$this->posts[$i]['name'],$helper);
            if(isset($_SESSION['position']))
            {
                if($_SESSION['position']=='WHOLESALER')
                    $helper=str_replace('{PRICE}',$this->posts[$i]['whole_saler_price'],$helper);
                else
                    $helper=str_replace('{PRICE}',$this->posts[$i]['price'],$helper);
            }
            else
                $helper=str_replace('{PRICE}',$this->posts[$i]['price'],$helper);

            $helper=str_replace('{POST_TEXT}',$this->posts[$i]['text'],$helper);
            $helper=str_replace('{POST_IMG}','upload/product_img/'.$this->posts[$i]['picture'],$helper);
            if($this->posts[$i]['number_exist']==0)
            {
                preg_match("#\\[(SHOP_EMPTY)\\](.*)\\[/SHOP_EMPTY\\]#is", $helper, $sub_tpl);
                $helper=preg_replace("#\\[(SHOP_EMPTY)\\](.*)\\[/SHOP_EMPTY\\]#is", $sub_tpl[2], $helper);
                $helper=preg_replace("#\\[(ADD_TO_BASKET)\\](.*)\\[/ADD_TO_BASKET\\]#is",'', $helper);
                $helper = preg_replace("#\\[(REMOVE_FROM_BASKET)\\](.*)\\[/REMOVE_FROM_BASKET\\]#is",'', $helper);

            }
            else
            {
                if(isset($_SESSION['basket']))
                {
                    if(in_array($this->posts[$i]['id'],$_SESSION['basket']))
                    {
                        preg_match("#\\[(REMOVE_FROM_BASKET)\\](.*)\\[/REMOVE_FROM_BASKET\\]#is", $helper, $sub_tpl);
                        $sub_tpl[2] = str_replace('{REMOVE_FROM_BASKET}', 'index.php?remove_to='.$this->posts[$i]['id'], $sub_tpl[2]);
                        $helper = preg_replace("#\\[(REMOVE_FROM_BASKET)\\](.*)\\[/REMOVE_FROM_BASKET\\]#is", $sub_tpl[2], $helper);
                        $helper = preg_replace("#\\[(ADD_TO_BASKET)\\](.*)\\[/ADD_TO_BASKET\\]#is",'', $helper);
                    }
                    else
                    {
                        preg_match("#\\[(ADD_TO_BASKET)\\](.*)\\[/ADD_TO_BASKET\\]#is", $helper, $sub_tpl);
                        $sub_tpl[2] = str_replace('{ADD_TO_BASKET}', 'index.php?add_to=' . $this->posts[$i]['id'], $sub_tpl[2]);
                        $helper = preg_replace("#\\[(ADD_TO_BASKET)\\](.*)\\[/ADD_TO_BASKET\\]#is", $sub_tpl[2], $helper);
                        $helper = preg_replace("#\\[(REMOVE_FROM_BASKET)\\](.*)\\[/REMOVE_FROM_BASKET\\]#is", '', $helper);
                    }
                }
                else
                {
                    preg_match("#\\[(ADD_TO_BASKET)\\](.*)\\[/ADD_TO_BASKET\\]#is", $helper, $sub_tpl);
                    $sub_tpl[2] = str_replace('{ADD_TO_BASKET}', 'index.php?add_to=' . $this->posts[$i]['id'], $sub_tpl[2]);
                    $helper = preg_replace("#\\[(ADD_TO_BASKET)\\](.*)\\[/ADD_TO_BASKET\\]#is", $sub_tpl[2], $helper);
                    $helper = preg_replace("#\\[(REMOVE_FROM_BASKET)\\](.*)\\[/REMOVE_FROM_BASKET\\]#is", '', $helper);
                }
                $helper = preg_replace("#\\[(SHOP_EMPTY)\\](.*)\\[/SHOP_EMPTY\\]#is", '', $helper);

            }
            $helper=str_replace('{COUNT}',$this->posts[$i]['number_exist'],$helper);
            $helper=str_replace('{DOP}',$this->posts[$i]['date_of_production'],$helper);
            $helper=str_replace('{EXP}',$this->posts[$i]['expiration_date'],$helper);

            $this->template.=$helper;
        }
    }


};