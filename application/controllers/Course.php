<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 과목 리스트 
     * */
    public function index()
    {
        // get course list
        $aCourseList = $this->_getCourseList();

        $data = array(
            'container' => 'course/index'
            ,'aData'    => $aCourseList
        );

        $this->load->view('common/container', $data);
    }
    
    /*
     * 과목 상세 보기
     * */
    public function detailCourse()
    {
    
    }
    /*
     * 수강신청 
     * */
    public function rpcReqCourse()
    {
        $mb_id = trim($this->input->post('mb_id')); 
        $subj  = trim($this->input->post('subj')); 

        if(!$mb_id || !$subj)
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail')); 
            die;
        }

        edu_get_instance('CourseClass');  
        $oCourse = new CourseClass(); 
        if(!$oCourse->setCourseReqUser($mb_id, $subj) )
        {
            response_json(array('code'=> 2 , 'msg'=>'is req')); 
            die;
        }

        response_json(array('code'=> 1 , 'msg'=>'OK')); 
        die;
    }

    private function _getCourseList()
    {
        edu_get_instance('CourseClass');  
        $oCourse = new CourseClass(); 
        
        return $oCourse; 
    }


    public function rpcGetAddrCode($code='')
    {
        if(!$code) $code = $this->input->post('code');
        $aAddrCode = getAddrCode($code);
                    
        response_json(array('code'=> 1 , 'msg'=>'OK', 'result'=>$aAddrCode));
        die;

    } 
}
