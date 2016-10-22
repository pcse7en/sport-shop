<?php

if (! defined ('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}

/*تابع چک کردن کد کپچای فرم*/
function f_check_captcha($captcha,$go_page)
{
//بررسی وجود سشن کپچا
    if(isset($_SESSION['captcha']))
        $s_cap=$_SESSION['captcha'];
    else
        f_redirect($go_page);
//فیلد کپچا خالی نباشد
    if(empty($captcha))
        f_redirect($go_page);
//بررسی درستی کد کپچای وارد شده
    if($captcha!=$s_cap)
        f_redirect($go_page);
}

//تابع ریدایرکت کردن
function f_redirect($address)
{
    header('location:'.$address);
    exit();
}

function f_go_last_page()
{
    if(isset($_SERVER['HTTP_REFERER']))
        f_redirect($_SERVER['HTTP_REFERER']);
    else
        f_redirect('index.php');
}

function f_check_is_ajax()
{
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    if(!$isAjax)
    {
        return true;
    }
}
/*تابع ساختن url  سایت*/
function f_full_url()
{
    return sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
}
//تابع هش کردن رمز عبور
function f_hash_string($string)
{
    $salt="E%)^@g5%hh&N)&^6";
    return md5($string.$salt);
}
//ایمیل صحیح
function f_validate_email($email)
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        return 1;
    else
        return 0;
}
/*چک کردن صحت شماره موبایل*/
function f_validate_mobile($mobile)
{
    return preg_match('/^(((\+|00)98)|0)?9[0123]\d{8}$/', $mobile);
}

function f_validate_numbers($number)
{
    if(filter_var($number,FILTER_SANITIZE_NUMBER_INT))
        return 1;
    else
        return 0;
}

/*Validate Date and Time Or Split Date From Time*/
function f_validate_date_jalali($date){
    // Snippets.ir
    $ndate  = explode('/', $date);
    if(count($ndate) == 3){
        if(strlen($ndate[0]) == 2 || strlen($ndate[0]) == 4){
            if((strlen($ndate[1]) == 2 || strlen($ndate[1]) == 1) && $ndate[1] >= 1 && $ndate[1] <= 12){
                if((strlen($ndate[2]) == 2 || strlen($ndate[2]) == 1) && $ndate[2] >= 1 && $ndate[2] <= 31){
                    return true;
                }
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;
    }
    else
        return false;
}

function f_user_position_show($position)
{
    if($position=='ADMIN')
        return 'مدیر سایت';
    elseif($position=='SALER')
    return 'فروشنده';
    elseif($position=='WHOLESALER')
        return 'عمده فروش';
    elseif($position=='WRITER')
        return 'نویسنده';
    elseif($position=='CUSTOMER')
        return 'مشتری';
    else
        return 'میهمان';
}
