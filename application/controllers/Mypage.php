<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mypage extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(! $aMemberInfo = $this->_getMemberInfo())
        {
            $oMem = "로그인이 필요합니다";
        }
        else
        {
            edu_get_instance('AccountClass');  
            $oMem = new AccountClass($aMemberInfo['mb_id']); 
        } 
       
        $data = array(
            'container' => 'mypage/index'
            ,'oMem'     => $oMem 
        );

        $this->load->view('common/container', $data);
    }
    private function _getMemberInfo()
    {
        edu_get_instance('CookieClass');  
        if(! $sMemberInfo = CookieClass::getCookieInfo() ) return false;
        
        return (array)json_decode($sMemberInfo);
    }

}
