<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lecture extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'container' => 'lecture/index'
        );

        $this->load->view('common/container', $data);
    }


}