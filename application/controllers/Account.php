<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function signin()
    {
        $data = array();
        $this->load->view('common/signin_ref');
    }

    public function rpcSignin()
    {
    }


}