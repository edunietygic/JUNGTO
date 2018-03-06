<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    // public function signin()
    // {
    //     $this->load->view('common/signin_ref');
    // }
    public function signin()
    {
       $data = array(
            'container' => 'common/signin'
        );

        $this->load->view('common/container', $data);
    }

    public function find()
    {
        $data = array(
            'container' => 'common/find'
        );

        $this->load->view('common/container', $data);
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
            response_json(array('code'=> 1 , 'msg'=>'가입되었습니다.'));
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

    public function rpcFindId()
    {
        $aInput = array();
        $aInput['mb_name']      = trim($this->input->post('senderName'));
        $aInput['mb_email']     = trim($this->input->post('senderInfo'));
        $aInput['mb_hp']        = trim($this->input->post('senderInfo'));

        if(! $this->_chkJoinParam($aInput) )
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }

        edu_get_instance('AccountClass');
        $oMem = new AccountClass();
        if( $oAccInfo = $oMem->findId($aInput) )
        {
            response_json(array('code'=> 1 , 'msg'=>'OK', 'id'=>$oAccInfo->mb_id));
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'존재하지 않는 정보입니다.'));
        die;
    }

    public function rpcFindPassword()
    {
        $aInput = array();
        $aInput['mb_id']       = trim($this->input->post('senderId'));
        $aInput['mb_email']    = trim($this->input->post('senderInfo'));

        if(! $this->_chkJoinParam($aInput) )
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }

        // step1. 아디디, 이메일 유효성 체크
        edu_get_instance('AccountClass');
        $oMem = new AccountClass();
        if( $oAccInfo = $oMem->findPassword($aInput) )
        {
            // step2. 임시비번생성 - 랜덤 8자리;
            $sPassword = generateRandomCode('',8);
            $aInput['tmp_password'] = $this->_mkPwd($oAccInfo->mb_id, $sPassword);

            // step3. db update
            if( $oMem->changePassword($aInput) )
            {
                // step4. 메일발송
                edu_get_instance('MailClass');
                $oMail = new MailClass();
                if( $oMail->sendMail($oAccInfo, $sPassword, $aInput['tmp_password']) )
                {
                    response_json(array('code'=> 1 , 'msg'=>'등록된 이메일로 임시비밀번호가 발급되었습니다.<br>로그인 후 비밀번호를 변경 후 이용하세요.'));
                    die;
                }
            }

            response_json(array('code'=> 999 , 'msg'=>'비밀번호 찾기 오류가 발생하였습니다.<br>다시 시도하세요.'));
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'존재하지 않는 정보입니다.'));
        die;
    }

}
