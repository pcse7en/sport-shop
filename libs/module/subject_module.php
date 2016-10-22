<?php

function subject_module($main_template)
{
    global $db;
    $sql = 'SELECT * FROM category';
    $subjects_array=$db->fetchArray($sql, __FILE__, __LINE__);
    $container='';
    $subjects_template=file_get_contents(TEMPLATE_ADDRESS.'subject.tpl');

    for($i=0;$i<count($subjects_array);$i++)
    {
        $help=str_replace('{SUBJECT_LINK}','index.php?page=1&subject='.$subjects_array[$i]['id'], $subjects_template);
        $help=str_replace('{SUBJECT}',$subjects_array[$i]['name'],$help);
        $help=str_replace('{DESCRIPTION}',$subjects_array[$i]['description'],$help);

        $container.=$help;
    }
    return str_replace('{SUBJECT_LIST}',$container,$main_template);
}