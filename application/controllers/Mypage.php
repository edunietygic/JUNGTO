<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mypage extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'container' => 'mypage/index'
        );

        $this->load->view('common/container', $data);
    }


}