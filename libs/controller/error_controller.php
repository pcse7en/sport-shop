<?php
class Error_Controller
{
    public function __construct()
    {
        echo $_SERVER['QUERY_STRING'];
    }

}