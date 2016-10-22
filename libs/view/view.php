<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class View
{
    private $template;
    public function __construct($temp,$module_name='',$title='')
    {
        $this->template=$temp;

        $this->replaceAddressTags();
        $this->replaceSubjectTags();
        $this->replaceUserTags();
        $this->numberInBasketTag();/*تعداد محصول درون سبد خرید*/
        $this->replaceHeaderTags();
        echo $this->template;
    }

    public function replaceAddressTags()
    {
        $this->template=str_replace('{ADDRESS}',TEMPLATE_ADDRESS,$this->template);
    }
    public function replaceHeaderTags()
    {

        $header='<title>'.TITLE.'</title>';
        $this->template=str_replace('{HEADER}',$header,$this->template);
    }
    public function replaceSubjectTags()
    {
        require_once 'libs/module/subject_module.php';
        $this->template=subject_module($this->template);
    }

    public function replaceUserTags()
    {
        if(isset($_SESSION['login']))
        {
            $prfile=file_get_contents(TEMPLATE_ADDRESS . 'profile.tpl');
            if(isset($_SESSION['admin']))
            {
                preg_match("#\\[(ADMIN)\\](.*)\\[/ADMIN\\]#is", $prfile, $sub_tpl);
                $prfile=preg_replace("#\\[(ADMIN)\\](.*)\\[/ADMIN\\]#is", $sub_tpl[2], $prfile);
                $this->template=str_replace('{USERS}',$prfile,$this->template);
            }
            else
            {
                $prfile=preg_replace("#\\[(ADMIN)\\](.*)\\[/ADMIN\\]#is", '', $prfile);
                $this->template=str_replace('{USERS}',$prfile,$this->template);
            }
            $this->template=str_replace('{POSITION}',f_user_position_show($_SESSION['position']),$this->template);
            $this->template=str_replace('{USERNAME}',$_SESSION['username'],$this->template);
        }
        else
        {
            $login=file_get_contents(TEMPLATE_ADDRESS . 'login.tpl');
            $this->template=str_replace('{USERS}',$login,$this->template);
        }
    }

    public static function tagExtraSingleTagRemover($tpl,$tag=array())
    {
        for($i=0;$i<count($tag);$i++)
        {
            $tpl=str_replace($tag[$i],'',$tpl);
        }
       return $tpl;
    }
    /*تعداد محصولات درون سبد خرید*/
    public function numberInBasketTag()
    {
        $count=0;
        if(isset($_SESSION['basket']))
            $count=count($_SESSION['basket']);
        else
            $count=0;
        $this->template=str_replace('{NUMBER_IN_BASKET}',$count,$this->template);
    }
}
?>