<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    {HEADER}
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <link href="{ADDRESS}style/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{ADDRESS}js/jquery-2.1.4.js"></script>
    <script src = "{ADDRESS}js/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{ADDRESS}js/jquery-ui/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="{ADDRESS}js/jquery-ui/jquery-ui.structure.min.css"/>
    <link rel="stylesheet" type="text/css" href="{ADDRESS}js/jquery-ui/jquery-ui.theme.min.css"/>
</head>

<body>
<div class="all">
    <div class="top_menu">
        <ul>
            <li><a href="#" class="top_menu_img"><img src="{ADDRESS}img/1.png"></a><a href="#" class="top_menu_text"><div class="triangle"></div>گرمکن</a></li>
            <li><a href="#" class="top_menu_img"><img src="{ADDRESS}img/2.png"></a><a href="#"class="top_menu_text"><div class="triangle"></div>توپ</a></li>
            <li><a href="#" class="top_menu_img"><img src="{ADDRESS}img/3.png"></a><a href="#"class="top_menu_text"><div class="triangle"></div>شورت</a></li>
            <li><a href="#" class="top_menu_img"><img src="{ADDRESS}img/4.png"></a><a href="#"class="top_menu_text"><div class="triangle"></div>کفش</a></li>
            <li><a href="#" class="top_menu_img"><img src="{ADDRESS}img/6.png"></a><a href="#"class="top_menu_text"><div class="triangle"></div>پیراهن</a></li>
            <li><a href="#" class="top_menu_img"><img src="{ADDRESS}img/5.png"></a><a href="#"class="top_menu_text"><div class="triangle"></div>جوراب</a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <img src="{ADDRESS}img/logo.png" class="logo">
        </div>
        <div class="main_menu"><a href="index.php"> خانه </a><a href="index.php?register=1"> ثبت نام </a><a href=""> درباره ما </a><a href=""> تماس با ما </a></div>
        <!---------------->
        <div class="center">
            <ul>
                <li></li>
            </ul>
            <!-------sidebar--------->
            <div class="sidebar">
                <!--------block-------->
                <div class="sidebar_block">
                    <div class="sidebar_block_header">جستجو</div>
                    <div class="sidebar_block_content response_center">
                        <form action="index.php?search=1" method="get">
                            <input type="text" value="جستجو.."><input type="submit" value="SEARCH">
                        </form>
                    </div>
                </div>
                <!------block---------->
                <div class="sidebar_block">
                    <div class="sidebar_block_header">قفسه ها</div>
                    <div class="sidebar_block_content">
                        <!--------menu-------->
                        <ul class="subject_menu response_center">
                            {SUBJECT_LIST}
                        </ul>
                        <!---------------->
                    </div>
                </div>
                <!--------block-------->
                    {USERS}
            </div>
            <!-------content------->
            <div class="content">
                <!--------message_box-------->
                {MESSAGE_BOX}
                <!--------post-------->
                {CONTENT}

                <!-------navigation-------->
                <div class="navigation">
                    <ul>
                        {NAVIGATION}
                    </ul>
                </div>

            </div>
        </div>
        <div class="footer">
            <div class="footer_menu"><a href="index.php"> خانه </a><a href="index.php?register=1"> ثبت نام </a><a href=""> درباره ما </a><a href=""> تماس با ما </a></div>
            <br/><br/>
            طراحی شده توسط فروشگاه لوازم ورزشی فیفا
        <br>
            کپی رایت 2015 - 2016
            <br/><br/>
        </div>

    </div>

</div>
</body>
<script>
</script>
</html>