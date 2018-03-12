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

            if($oMem->myCourseInfo != "no req list")
            {
                foreach($oMem->myCourseInfo as $key=>$val)
                {
                      
                    $aTutorInfo = $oMem->keyTogglerFromID($val->tutor);
                    $oMem->myCourseInfo[$key]->tutor_name   = $aTutorInfo->mb_name; 
                    $oMem->myCourseInfo[$key]->tutor_hp     = $aTutorInfo->mb_hp; 
                    $oMem->myCourseInfo[$key]->addr_string  = getAddrStringFromCode($val->addrcode) . " " . $val->addrstring ;
                    $oMem->myCourseInfo[$key]->state_string = $this->_getStateString($val->state);
                }
            }
            

        } 
        
        $data = array(
            'container' => 'mypage/index'
            ,'oMem'     => $oMem 
        );
        
        // test code 
        // echo "<!--";
        // print_r($data);
        // echo "-->";

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
                if($key !='pwd2')
                {
                    response_json(array('code'=> 99 , 'msg'=>'Fail'));
                    die;
                }    
            }
        }   
        
        $mb_id = trim($this->input->post('mb_id'));
        $name  = trim($this->input->post('name'));
        $hp    = trim($this->input->post('hp'));
        $email = trim($this->input->post('email'));
        
        $pwd1  = trim($this->input->post('pwd1'));
        $pwd2  = trim($this->input->post('pwd2'));
    
        // pwd chk 
        if($pwd2 && $pwd1 != $pwd2)
        {
            response_json(array('code'=> 88 , 'msg'=>'입력한 두 비번이 틀립니다.'));
            die;
        } 
        
        // db pwd chk
        edu_get_instance('AccountClass');  
        $oMem = new AccountClass($mb_id); 
        $mkpwd = $oMem->getPwd($mb_id, $pwd1, 'Mypage');

        // 일반 정보 업데이트시 기존 비번과 일치 여부확인
        if($pwd1 && !$pwd2)
        {
            if($oMem->oMemberInfo->mb_password != $mkpwd)
            {
                response_json(array('code'=> 77 , 'msg'=>'비밀번호가 틀립니다'));
                die;
            }
        }
        // 비번 업데이트
        if(($pwd1 && $pwd2) && ($pwd1 == $pwd2))
        {
            $oMem->changePassword(array('mb_id'=>$mb_id, 'tmp_password'=>$mkpwd, 'mb_email'=>$email));
            
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
