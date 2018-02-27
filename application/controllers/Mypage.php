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
            //$oMem = "로그인이 필요합니다";
            header('Location: /main');
        }
        else
        {
            edu_get_instance('AccountClass');  
            $oMem = new AccountClass($aMemberInfo['mb_id']); 
            
            foreach($oMem->myCourseInfo as $key=>$val)
            {
                $oMem->myCourseInfo[$key]->tutor_name   = $oMem->keyTogglerFromID($val->tutor)->mb_name; 
                $oMem->myCourseInfo[$key]->addr_string  = getAddrStringFromCode($val->addrcode) . " " . $val->addrstring ;
                $oMem->myCourseInfo[$key]->state_string = $this->_getStateString($val->state);
            }

            // test code 
            // echo "<!--";
            // print_r($oMem);
            // echo "-->";
        } 
        
        $data = array(
            'container' => 'mypage/index'
            ,'oMem'     => $oMem 
        );

        $this->load->view('common/container', $data);
    }
    private function _getStateString($state)
    {
        $aConfig = array(
             'REQ'   => '<span class="label label-info">신청</span>'    
            ,'START' => '<span class="label label-info">개강</span>'    
            ,'WAIT'  => '<span class="label label-danger">대기</span>'    
            ,'END'   => '<span class="label label-danger">종료</span>'    
            ,'PLAY'  => '<span class="label label-success">신청완료</span>'    
            ,'COM'   => '<span class="label label-success">수료</span>'    
            
        );
        return $aConfig[$state];
    }
    private function _getMemberInfo()
    {
        edu_get_instance('CookieClass');  
        if(! $sMemberInfo = CookieClass::getCookieInfo() ) return false;
        
        return (array)json_decode($sMemberInfo);
    }
    public function rpcUpdateMembInfo()
    {
        // chk post value    
        foreach($_POST as $key=>$val)
        {
            if(!trim($val))
            {
                response_json(array('code'=> 99 , 'msg'=>'Fail'));
                die;
            }
        }   
        
        $mb_id = $this->input->post('mb_id');
        $name  = $this->input->post('name');
        $hp    = $this->input->post('hp');
        $email = $this->input->post('email');
        
        $pwd1  = $this->input->post('pwd1');
        $pwd2  = $this->input->post('pwd2');
    
        // pwd chk 
        if($pwd1 != $pwd2)
        {
            response_json(array('code'=> 88 , 'msg'=>'입력한 두 비번이 틀립니다.'));
            die;
        } 
        
        // db pwd chk
        edu_get_instance('AccountClass');  
        $oMem = new AccountClass($mb_id); 
        $mkpwd = $oMem->getPwd($mb_id, $pwd1, 'Mypage');

        if($oMem->oMemberInfo->mb_password != $mkpwd)
        {
            response_json(array('code'=> 77 , 'msg'=>'비밀번호가 틀립니다'));
            die;
        }

        // update member info
        if(! $oMem->updateMemInfo($mb_id, $hp, $email) )
        {
            response_json(array('code'=> 66 , 'msg'=>'시스템 오류 관리자에게 문의하세요'));
            die;
        }
        
        response_json(array('code'=> 1 , 'msg'=>'OK'));
        die;
    }
    /*
     * member delete 
     * delete table : edu_member ,  edu_subj_applicant
     * */    
    public function rpcDeleteMember()
    {
        $mb_id = $this->input->post('mb_id'); 

        if(!$mb_id) 
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }
        // delete db info        
        edu_get_instance('AccountClass');  
        $oMem = new AccountClass($mb_id); 
        if(! $oMem->deleteMember($mb_id))
        {
            response_json(array('code'=> 77 , 'msg'=>'시스템 오류 관리자에게 문의하세요.'));
            die;
        }
        
        // logout process
        $oLoginout = edu_get_instance('loginout_model', 'model');  
        $oLoginout->logout();
        
        response_json(array('code'=> 1 , 'msg'=>'OK'));
        die;
    }
}
