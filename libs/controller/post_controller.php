<?php
if (!defined('FIFASPORTSHOP'))
{
    die ( "به نظر می رسد شما قصد هک کردن وب سایت را دارید." );
}
class Post_Controller
{
    private $track=0;

    public function __construct()
    {
        if(isset($_GET['track']))
        {
            $this->track=$_GET['track'];
            $this->saveTransaction();
        }

        require_once 'libs/view/post_view.php';
        new Post_View($this->track);

    }

    public function saveTransaction()
    {
        require_once 'libs/model/post_model.php';
        Post_Model::saveTransaction($this->track);
    }
}
