<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Payment_Controller
{
    private $track;
    private $payment;
    private $redirect;
    private $amount;
    private $trans_id;
    private $id_get;
    public function __construct()
    {
        if(!(isset($_GET['track'])&&isset($_SESSION['login'])&& isset($_GET['payment'])))
            f_redirect('index.php?error=2&line='.__LINE__.'&file='.__FILE__);

            $this->track=$_GET['track'];
            $this->payment=$_GET['payment'];
            require_once 'libs/model/payment_model.php';

        /*چک کردن صحت کد پیگیری*/
        if($this->checkTrackCode())
            f_redirect('index.php');
        /*pay line setting*/
        $this->redirect = urlencode(f_full_url().'?payment=2&track='.$this->track);
        /*دریافت مبلغ تراکنش*/
        $this->getTotalAmount();

        if($this->payment==1)
        {
            $result =$this->sendDataToPayline();
            if($result > 0 && is_numeric($result))
            {
                $go = "http://payline.ir/payment-test/gateway-$result";
                header("Location: $go");
            }
            switch($result)
            {
                case '-1':
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '-2':
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '-3':
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '-4':
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
            }

        }
        elseif($this->payment==2)
        {
            $this->trans_id = $_POST['trans_id'];
            $this->id_get = $_POST['id_get'];

            $this->track=$_GET['track'];

            $result =$this->getDataFromPayline();
            //echo $this->track;exit;
            switch($result)
            {
                case '-1' :
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '-2' :
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '-3' :
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '-4' :
                    f_redirect('index.php?error=1&line='.__LINE__.'&file='.__FILE__);
                    break;
                case '1' :
                    $this->saveTransaction();
                    $this->updateProductTable();
                    break;
            }

            require_once 'libs/view/payment_view.php';
            new Payment_View($this->track);
        }
        else
        {
            f_redirect('index.php?error=2&line='.__LINE__.'&file='.__FILE__);
        }

    }

    public function getTotalAmount()
    {
        $this->amount=Payment_Model::getTotalAmount($this->track);
    }

    public function checkTrackCode()
    {
        if(Payment_Model::checkTrackCode($this->track)==1)
            return 1;
        else
            return 0;
    }

    public function sendDataToPayline()
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,PAYLINE_SEND_URL);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"api=".API."&amount=".$this->amount."&redirect=".$this->redirect);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function getDataFromPayline()
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,PAYLINE_GET_URL);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"api=".API."&id_get=".$this->id_get."&trans_id=".$this->trans_id);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function saveTransaction()
    {
        Payment_Model::saveTransaction($this->trans_id,$this->id_get,$this->track);
    }
    public function updateProductTable()
    {
        Payment_Model::updateProductTable($this->track);
    }

}