<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_View
{
    private $admin_template;
    private $main_template;

    public function __construct()
    {
        $this->main_template=$this->addTemplate('main.tpl');
        $this->admin_template=$this->addTemplate('admin.tpl');

        $this->replaceContentTag();/*جای گذاری محتوا در قالب*/
        $this->replaceNavigationTag();
        $this->replaceMessageBoxTag();

        require_once 'libs/view/view.php';
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

    public function replaceContentTag()
    {

        $this->main_template=str_replace('{CONTENT}',$this->admin_template,$this->main_template);
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