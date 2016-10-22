<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Basket_View
{
    private $basket_template;
    private $main_template;
    private $item=array();

    public function __construct($itm)
    {
        $this->item=$itm;
        $this->basket_template=$this->addTemplate('basket.tpl');
        $this->replaceBasketTag();
        $this->main_template =$this->addTemplate('main.tpl');
        $this->replaceContentTag();
        include_once 'libs/view/view.php';
        $this->main_template=View::tagExtraSingleTagRemover($this->main_template,array('{NAVIGATION}','{MESSAGE_BOX}'));
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

    public function replaceBasketTag()
    {
        preg_match("#\\[(ELEMENT)\\](.*)\\[/ELEMENT\\]#is", $this->basket_template, $sub_tpl);
        $container='';
        for($i=0;$i<count($this->item);$i++)
        {
            $helper=str_replace('{ID}',$this->item[$i]['id'],$sub_tpl[2]);
            $helper=str_replace('{PRICE}',$this->item[$i]['price'],$helper);
            $helper=str_replace('{NAME}',$this->item[$i]['name'],$helper);
            $helper=str_replace('{NUMBER_EXIST}',$this->item[$i]['number_exist'],$helper);
            $container.=$helper;
        }
        $this->basket_template=preg_replace("#\\[(ELEMENT)\\](.*)\\[/ELEMENT\\]#is", $container, $this->basket_template);
    }

    /*تگ محتوا را با زیر قالب جایگذین کن*/
    public function replaceContentTag()
    {
        $this->main_template=str_replace('{CONTENT}',$this->basket_template,$this->main_template);
    }

};