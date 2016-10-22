<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
/*کلاس صفحه بندی سایت*/
class Page_Controller
{
    private $page;/*جهت ذخیره صفحه درخواستی کاربر*/
    private $subject;/*جهت ذخیره موضوع درخواستی کاربر*/
    private $posts=array();/*خروجی این برنامه در قسمت کنترلر*/
    private $navigation;
    /*سازنده کلاس صفحه بندی مطالب*/
    public function __construct()
    {

        /*چک کردن شماره صفحه دلخواه کاربر*/
        if(isset($_GET['page']))
        {
            if(preg_match ("/^([0-9]+)$/", $_GET['page']))/*اعتبار سنجی عدد شماره صفحه*/
            {
                $this->page=$_GET['page'];
            }
            else
            {
                $this->page=1;
            }
        }
        else
        {
            $this->page=1;
        }
        /*چک کردن موضوع مرد علاقه کاربر*/
        if(isset($_GET['subject']))
        {
            if(preg_match ("/^([0-9]+)$/", $_GET['subject']))/*اعتبار سنجی عدد شماره موضوع*/
            {
                $this->subject=$_GET['subject'];
            }
            else
            {
                $this->subject=0;
            }
        }
        else
        {
            $this->subject=0;
        }
        /*///////////////افزودن مدل به برنامه/////////////////////////*/
        /*قسمت مدل یا کار با پایگاه داده به پروژه افزوده می شود.*/
        include_once 'libs/model/page_model.php';
        /*دریافت صفحات*/
        $this->getPage($this->page,ELEMENT_PER_PAGE,$this->subject);
        $this->getPagination($this->subject,$this->page);
        /*///////////////افزودن ویو به برنامه///////////////*/
        include_once 'libs/view/page_view.php';
        new Page_View($this->posts,$this->navigation);
    }




/*دریافت صفحه درخواستی کاربر از مدل*/
    public function getPage($page,$limit,$subject)
    {
/*تشخیص نقطه شروع برای دریافت نتایج از پایگاه داده*/
        $start = ($page-1) * $limit;
        /*تشخیص اینکه کاربر موضوع خاصی را انتخاب نموده یا نه*/
        if($subject<=0)
        {
            $this->posts=Page_Model::getPosts($start,$limit,0);
        }
        else
        {
            $this->posts=Page_Model::getPosts($start,$limit,$subject);
        }
    }

    function getPagination($subject,$page=1)
    {
        $firstPage=0;
        $lastPage=0;
        $count=Page_Model::getPagination($subject);

        $somePages=ceil($count/ELEMENT_PER_PAGE);
///یک مشکل اینجا هست اون هم اینکه موضوعات مختلف پشتیبانی نشدن
        if($subject==0)
        {
            if($somePages>1)
            {
                $firstPage=1;
                $lastPage=$somePages;
                $result='';
                if($page>1)
                {
                    $result.='<li><a href="index.php?page='.($firstPage).'">&#8249;&#8249;</a></li>';
                    $result.='<li><a href="index.php?page='.($page-1).'">&#8249;</a></li>';
                }
                else
                {
                    $result.='<li id="current">&#8249;&#8249;</li>';
                    $result.='<li id="current">&#8249;</li>';

                }
                $left=$page+PAGE_RADIUS;
                $right=$page-PAGE_RADIUS;
                if($somePages>=((PAGE_RADIUS*2)+3))
                {
                    for($i=$right;$i<$page;$i++)
                    {
                        if($i>=1)
                        {
                            $result.='<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                        }
                    }

                    if($page!=1||$page!=$lastPage)$result.='<li id="current">'.$page.'</li>';

                    for($i=$page+1;$i<=$left&&$i<=$lastPage;$i++)
                    {
                        $result.='<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }
                }
                else
                {
                    for($i=1;$i<=$somePages;$i++)
                    {
                        if($page==$i)
                        {
                            $result.='<li id="current">'.$i.'</li>';
                        }
                        else
                        {
                            $result.='<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                        }
                    }
                }
                if($page<$lastPage)
                {
                    $result.='<li><a href="index.php?page='.($page+1).'">&#8250;</a></li>';
                    $result.='<li><a href="index.php?page='.($lastPage).'">&#8250;&#8250;</a></li>';
                }
                else
                {
                    $result.='<li id="current">&#8250;</li>';
                    $result.='<li id="current">&#8250;&#8250;</li>';

                }
                $this->navigation=$result;
            }

        }
        else
        {
            if($somePages>1)
            {
                $firstPage=1;
                $lastPage=$somePages;
                $result='';
                if($page>1)
                {
                    $result.='<li><a href="index.php?page='.($firstPage).'&subject='.$subject.'">&#8249;&#8249;</a></li>';
                    $result.='<li><a href="index.php?page='.($page-1).'&subject='.$subject.'">&#8249;</a></li>';
                }
                else
                {
                    $result.='<li id="current">&#8249;&#8249;</li>';
                    $result.='<li id="current">&#8249;</li>';

                }
                $left=$page+PAGE_RADIUS;
                $right=$page-PAGE_RADIUS;
                if($somePages>=((PAGE_RADIUS*2)+3))
                {
                    for($i=$right;$i<$page;$i++)
                    {
                        if($i>=1)
                        {
                            $result.='<li><a href="index.php?page='.$i.'&subject='.$subject.'">'.$i.'</a></li>';
                        }
                    }

                    if($page!=1||$page!=$lastPage)$result.='<li id="current">'.$page.'</li>';

                    for($i=$page+1;$i<=$left&&$i<=$lastPage;$i++)
                    {
                        $result.='<li><a href="index.php?page='.$i.'&subject='.$subject.'">'.$i.'</a></li>';
                    }
                }
                else
                {
                    for($i=1;$i<=$somePages;$i++)
                    {
                        if($page==$i)
                        {
                            $result.='<li id="current">'.$i.'</li>';
                        }
                        else
                        {
                            $result.='<li><a href="index.php?page='.$i.'&subject='.$subject.'">'.$i.'</a></li>';
                        }
                    }
                }
                if($page<$lastPage)
                {
                    $result.='<li><a href="index.php?page='.($page+1).'&subject='.$subject.'">&#8250;</a></li>';
                    $result.='<li><a href="index.php?page='.($lastPage).'&subject='.$subject.'">&#8250;&#8250;</a></li>';
                }
                else
                {
                    $result.='<li id="current">&#8250;</li>';
                    $result.='<li id="current">&#8250;&#8250;</li>';

                }
                $this->navigation=$result;
            }

        }

    }

};