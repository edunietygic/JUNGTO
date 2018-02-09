<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Camp extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'container' => 'camp/index'
        );

        $this->load->view('common/container', $data);
    }


}