<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mypage extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // test code 
        $account_id = 'jazzwave14' ;   
        
        edu_get_instance('AccountClass');  
        $oMem = new AccountClass($account_id); 
        
        $data = array(
            'container' => 'mypage/index'
            ,'oMem'     => $oMem 
        );

        $this->load->view('common/container', $data);
    }


}
