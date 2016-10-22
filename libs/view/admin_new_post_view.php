<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Admin_new_post_View
{
    private $admin_new_post_template;
    private $main_template;
    private $message_template;

    private $success=0;
    private $error=0;
    private $category_list=array();
    public function __construct($c_l=array(),$er=0,$sc=0)
    {
        $this->success=$sc;
        $this->error=$er;
        $this->category_list=$c_l;

        $this->main_template=$this->addTemplate('main.tpl');

        if($this->success!=0)
        {
            $this->message_template=$this->addTemplate('message_chk.tpl');

        }
        elseif($this->error!=0)
        {
            $this->message_template=$this->addTemplate('message_err.tpl');
        }

        $this->admin_new_post_template=$this->addTemplate('admin_new_post.tpl');

        $this->categoryReplacerTag();
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
    /*جایگذین کردن موضوعات در درج محصولات*/
    public function categoryReplacerTag()
    {
        $category='';
        for($i=0;$i<count($this->category_list);$i++)
        {
            $category.='<option value="'.$this->category_list[$i]['id'].'">'.$this->category_list[$i]['name'].'</option>';
        }
        $this->admin_new_post_template=str_replace('{CATEGORY}',$category,$this->admin_new_post_template);
    }

    public function replaceContentTag()
    {

        $this->main_template=str_replace('{CONTENT}',$this->admin_new_post_template,$this->main_template);
    }
    public function replaceNavigationTag()
    {
        $this->main_template=str_replace('{NAVIGATION}','',$this->main_template);
    }

    public function replaceMessageBoxTag()
    {
        if($this->success!=0)
        {
            $message='عملیات با موفقیت به پایان رسد';
            $this->message_template=str_replace('{MESSAGE}',$message,$this->message_template);
            $this->main_template=str_replace('{MESSAGE_BOX}',$this->message_template,$this->main_template);

        }
        elseif($this->error!=0)
        {
            $message='خطایی با شماره '.$this->error.'رخ داده است.';
            $this->message_template=str_replace('{MESSAGE}',$message,$this->message_template);
            $this->main_template=str_replace('{MESSAGE_BOX}',$this->message_template,$this->main_template);
        }
        else
        {
            $this->main_template=str_replace('{MESSAGE_BOX}','',$this->main_template);
        }
    }
};