<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Happyschool extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'container' => 'happyschool/index'
        );

        $this->load->view('common/container', $data);
    }

    public function greeting()
    {
        $data = array(
            'container' => 'happyschool/greeting'
        );

        $this->load->view('common/container', $data);    
    }

}