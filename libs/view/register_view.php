<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}

class Register_View
{
    private $main_template;
    private $register_template;
    private $message_template;
    public function __construct($id)
    {
        if($id==1)/*اگر کاربر درخواست ثبت نام کرده بود*/
        {
            $this->viewRegisterForm();
        }
        else if($id==2)
        {
            $this->registerSuccessfully();
        }
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
/*نمایش صفحه ثبت نام*/
    public function viewRegisterForm()
    {
        $this->main_template = $this->addTemplate('main.tpl');
        $this->register_template = $this->addTemplate('register.tpl');
        $this->main_template = str_replace('{CONTENT}',$this->register_template,$this->main_template);
        $this->main_template = str_replace('{NAVIGATION}','',$this->main_template);
        $this->main_template = str_replace('{MESSAGE_BOX}','',$this->main_template);

    }
    /*موفقیت آمیز بودن ثبت نام*/
    public function registerSuccessfully()
    {
        $this->main_template = $this->addTemplate('main.tpl');
        $this->message_template = $this->addTemplate('message_chk.tpl');
        $this->message_template = str_replace('{MESSAGE}','ثبت نام شما با موفقیت تکمیل شد .',$this->message_template);
        $this->main_template =str_replace('{MESSAGE_BOX}',$this->message_template,$this->main_template);
        $this->main_template = str_replace('{NAVIGATION}','',$this->main_template);
        $this->main_template = str_replace('{CONTENT}','',$this->main_template);
    }
}