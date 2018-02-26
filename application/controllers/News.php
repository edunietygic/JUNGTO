<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        edu_get_instance('BoardClass');
        $aLdata = BoardClass::getNoticeList();

        $data = array(
            'container' => 'news/index'
            ,'aLdata' => $aLdata
        );

        $this->load->view('common/container', $data);
    }
    public function viewNews()
    {
        $data = array(
            'container' => 'news/viewNews'
        );

        $this->load->view('common/container', $data);
    }


}