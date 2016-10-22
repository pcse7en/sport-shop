<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Calculate_Controller
{
    private $some=array();
    private $send_model;
    private $payment_model;
    private $item=array();
    private $username;
    private $user_information=array();
    private $product_information=array();
    private $weight=0;
    private $price=0;
    private $tax=0;
    private $track_code;
    private $send_cost=0;
    private $invoice=array();
    public function __construct()
    {
        if(!(isset($_SESSION['login'])&&isset($_SESSION['basket'])&&isset($_POST['some'])&&isset($_POST['send_model'])&&isset($_SESSION['username'])&&isset($_POST['payment_model'])))
        {
            f_redirect('index.php');
        }
        $this->some=$_POST['some'];
/*
 * مدل ارسال مرسوله
 * */
        $this->send_model=$_POST['send_model'];
        if($this->send_model==2)
            $this->send_model=1;
        else
            $this->send_model=0;
/*
 * مدل پرداخت وجه
 * */
        $this->payment_model=$_POST['payment_model'];
        if($this->payment_model==2)
            $this->payment_model=1;
        else
            $this->payment_model=0;
/*
 * آیتم های درون سبد خرید
 * */
        if(isset($_SESSION['basket']))
            $this->item=$_SESSION['basket'];
        else
            f_redirect('index.php');
/*
 * نام کاربری کاربر را گرفته
 * */
        $this->username=$_SESSION['username'];
/*
 * انجام محاسبات
 * */
        require_once 'libs/model/calculate_model.php';
        $this->getUserInformation();/*دریافت اطلاعات کاربر*/
        $this->getProductInformation();/*دریافت اطلاعات کالاها*/
        $this->totalPriceCalculate();/*محاسبه هزینه ها و ایجاد آرایه ای از همه اطلاعات*/
        $this->track_code=f_hash_string($this->user_information['id']+microtime());/*ایجاد کد پیگیری*/
        $this->tax=$this->taxCalculation();/*محاسبه مالیات*/
        $this->send_cost=$this->sendCost();/*محاسبه هزینه ارسال*/
        /*محاسبه مبلغ قابل پرداخت*/
        $this->price+=$this->tax+$this->send_cost;
        $this->temporaryStorage();/*ذخیره موقت اطلاعات خرید*/


        require_once 'libs/view/calculate_view.php';
        new Calculate_View($this->user_information,$this->invoice,
            $this->weight,$this->tax,$this->send_cost,$this->send_model,$this->payment_model,$this->price,$this->track_code);
        /*خالی کردن سبد برای جلوگیری از ثبت مجدد*/
        unset($_SESSION['basket']);
    }
/*دریافت اطلاعات کاربر*/
    public function getUserInformation()
    {
        $this->user_information=Calculate_Model::getUserInformation($this->username);
    }
/*دریافت اطلاعات محصول*/
    public function getProductInformation()
    {
        $ids = implode(' ,',$this->item);
        $this->product_information=Calculate_Model::getProductInformation($ids);
    }

/*محاسبه قیمت*/
    public function totalPriceCalculate()
    {
        for($i=0;$i<count($this->item);$i++)
        {
            /*درج آی دی هر محصول*/
            $this->invoice[$i][0]=$this->item[$i];
/*درج تعداد هر محصول*/
            if($this->some[$i] > 0)
                $this->invoice[$i][1]=$this->some[$i];
            else
                $this->invoice[$i][1]=1;
        /*محاسبه قیمت تک تک محصولات بسته به تعداد*/
            $this->invoice[$i][2]=$this->product_information[$i]['price']*$this->invoice[$i][1];
            /*محاسبه جمع کل بدون احتساب مالیات*/
            $this->price+=$this->invoice[$i][2];
            /*محاسبه وزن کل مرسوله*/
            $this->weight+=$this->product_information[$i]['weight']*$this->invoice[$i][1];
            /*افزودن نام محصول به فاکتور*/
            $this->invoice[$i][4]=$this->product_information[$i]['name'];
        }
    }
  /*محاسبه مالیات*/
    public function taxCalculation()
    {
        return ($this->price/100)*5;
    }
    /*محاسبه هزینه ارسال محصول*/
    public function sendCost()
    {
        $tax=($this->price/100)*2;/*هزینه مالیات*/
        $send=$this->weight+100;/*هزینه ارسال بسته به وزن*/
        $insurance=$this->price/100;/*هزینه بیمه محصول*/
        $COD=0;

        if($this->payment_model==1)
            $COD=($this->weight*5)+6000;        /*هزینه دریافت وجه درب منزل*/


        if($this->send_model==1)
        {
            $post_model=4000;
        }
        else
        {
            $post_model=2000;
        }

        return $tax+$send+$insurance+$COD+$post_model;
    }
/*ثبت موقت سفارش مشتری*/
    public function temporaryStorage()
    {
        Calculate_Model::temporaryStorage($this->user_information['id'],$this->invoice,$this->price,$this->tax,$this->payment_model,
            $this->weight,$this->send_model,$this->send_cost,$this->track_code);

    }

};