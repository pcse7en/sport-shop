<?php
if (! defined ('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}

function f_get_pages($table,$category_clause=NULL,$order_by,$page=1,$elementPerPage=8)
{
    global $db;
    $start=($page*$elementPerPage) - $elementPerPage;
    if($category_clause != NULL)
    {
        $sql='SELECT * FROM ' .$table. ' WHERE '.$category_clause.' ORDER BY '.$order_by.' DESC LIMIT '.$start.','.$elementPerPage;
        return $db->fetch_array($sql,__FILE__,__LINE__);
    }
    else
    {
        $sql='SELECT * FROM ' .$table. ' ORDER BY '.$order_by.' DESC LIMIT '.$start.','.$elementPerPage;
        return $db->fetch_array($sql,__FILE__,__LINE__);
    }
}

function f_get_pagination($table,$subject,$radius=3,$page=1,$elementPerPage=8)
{
    global $db;
    $firstPage=0;
    $lastPage=0;
    $sql='SELECT COUNT(*) FROM '.$table;
    $count=$db->row_counter($sql,__FILE__,__LINE__);

    $somePages=ceil($count/$elementPerPage);

    if($somePages>1)
    {
        $firstPage=1;
        $lastPage=$somePages;
        $result='';
        if($page>1)
        {
            $result.='<li><a href="'.$subject.($firstPage).'">&#8249;&#8249;</a></li>';
            $result.='<li><a href="'.$subject.($page-1).'">&#8249;</a></li>';
        }
        else
        {
            $result.='<li id="current">&#8249;&#8249;</li>';
            $result.='<li id="current">&#8249;</li>';

        }
        $left=$page+$radius;
        $right=$page-$radius;
        if($somePages>=(($radius*2)+3))
        {
            for($i=$right;$i<$page;$i++)
            {
                if($i>=1)
                {
                    $result.='<li><a href="'.$subject.$i.'">'.$i.'</a></li>';
                }
            }

            if($page!=1||$page!=$lastPage)$result.='<li id="current">'.$page.'</li>';

            for($i=$page+1;$i<=$left&&$i<=$lastPage;$i++)
            {
                $result.='<li><a href="'.$subject.$i.'">'.$i.'</a></li>';
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
                    $result.='<li><a href="'.$subject.$i.'">'.$i.'</a></li>';
                }
            }
        }
        if($page<$lastPage)
        {
            $result.='<li><a href="'.$subject.($page+1).'">&#8250;</a></li>';
            $result.='<li><a href="'.$subject.($lastPage).'">&#8250;&#8250;</a></li>';
        }
        else
        {
            $result.='<li id="current">&#8250;</li>';
            $result.='<li id="current">&#8250;&#8250;</li>';

        }
        return $result;
    }

}

?>