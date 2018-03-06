<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loginout extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        edu_get_instance('AccountClass');
        $oMem = new AccountClass($account_id);

        $data = array(
            'container' => 'mypage/index'
            ,'oMem'     => $oMem
        );

        $this->load->view('common/container', $data);
    }

    public function login()
    {
       $data = array(
            'container' => 'common/login'
        );

        $this->load->view('common/container', $data);
    }

    public function rpcLogin()
    {
        $user_id  = trim($this->input->post('user_id'));
        $user_pwd = trim($this->input->post('user_pwd'));

        $oLoginout= edu_get_instance('loginout_model', 'model');

        if($oLoginout->login($user_id, $user_pwd))
        {
            response_json(array('code'=> 1 , 'msg'=>'OK'));
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'Fail'));
        die;
    }
    public function rpcLogout()
    {
        $oLoginout= edu_get_instance('loginout_model', 'model');

        $oLoginout->logout();
        response_json(array('code'=> 1 , 'msg'=>'OK'));
        die;

    }
}
