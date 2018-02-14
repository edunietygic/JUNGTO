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
        $aInput = array();
        $aInput['mb_id']        = trim($this->input->post('nwId'));
        $aInput['mb_password']  = trim($this->input->post('nwPw'));
        $aInput['mb_password2'] = trim($this->input->post('nwPw2'));
        $aInput['mb_name']      = trim($this->input->post('nName'));
        $aInput['mb_email']     = trim($this->input->post('nEmail'));
        $aInput['mb_hp']        = trim($this->input->post('nPhone'));
        $aInput['mb_join_date'] = date('Y-m-d H:i:s');

        if(! $this->_chkJoinParam($aInput) ) 
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail')); 
            die;
        }        
        if(! $this->_chkPwd($aInput) ) 
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail')); 
            die;
        }
        
        $aInput['mb_password'] = $this->_mkPwd($aInput['mb_id'], $aInput['mb_password']); 

        edu_get_instance('AccountClass');  
        $oMem = new AccountClass(); 
        if( $oMem->joinMember($aInput) )
        {
            response_json(array('code'=> 1 , 'msg'=>'OK')); 
            die;
        }
        
        response_json(array('code'=> 99 , 'msg'=>'Fail')); 
        die;
    }
    private function _chkJoinParam($aInput)
    {
        foreach($aInput as $key=>$val)
            if(!$val) return false;
        
        return true;
    }
    private function _chkPWD($aInput)
    {
        if($aInput['mb_password'] != $aInput['mb_password2'])
            return false; 
        return true;
    }
    private function _mkPwd($user_id, $user_pwd)
    {
        if(!$user_id || !$user_pwd) return false;    

        $aResult = generalizeCMPW($user_pwd, $user_id, false);
        return $aResult[1];
    }
    
}
