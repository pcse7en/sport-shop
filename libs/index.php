<?php
/*سشن ها را برای یک ساعت تنظیم کن*/
//session_set_cookie_params(3600);
/*سشن را شروع کن*/
ini_set('session.save_path', 'libs/session/');
ini_set('session.cookie_lifetime', 3600);
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600,'libs/session/');
session_start();
/*فایل پیکربرندی را به برنامه اصافه کن*/
require_once 'libs/model/config.php';
/*مسیر قالب وبسایت را تشخیص بده*/
define('TEMPLATE_ADDRESS','template/'.TEMPLATE_NAME.'/');
/*پایگاه داده سایت را فراخوانی و اجرا کن*/
require_once 'libs/model/db.php';
$db=new Db();
/*یکسری از توابع پراکنده و مورد نیاز برنامه ها در این فایل هستند که قابل دسترسی برای تمام قسمت های وب سایت ما هستند.*/
require_once 'libs/module/functions_module.php';
require_once 'libs/module/jdf_module.php';
/*مسیر یاب وبسایت را صدا زده و یک آبجکت از روی آن بساز*/
require_once 'libs/router.php';
/*کوئری وارد دشه در مرورگر را در هنگام ساخت روتر برای روتر بفرست*/
$router=new Router($_SERVER['QUERY_STRING']);



?>