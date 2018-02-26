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
        // init
        $aData = array();
        $aData['addr1'] = '';
        $aData['addr1'] = '';
        $aData['select_addr1'] = '';
        $aData['select_addr2'] = ''; 

        if(isset($_POST['p_addr1']) && isset($_POST['p_addr2']))
        {
            // select addrcode     
            $aData['select_addr1'] = $_POST['p_addr1'];
            $aData['select_addr2'] = $_POST['p_addr2'];
        }
       
        // addr setting
        $aData['addr1'] = getAddrCode();
        
        if($aData['select_addr2'])
        {
            $aData['addr2'] = getAddrCode($aData['select_addr1']);
        }
        
        // get course list
        $aData['aCourseList'] = $this->_getCourseList($aData['select_addr2']); 
 
        $data = array(
            'container' => 'course/index'
            ,'aData'    => $aData
        );

        echo "<!--";
        print_r($data);
        echo "-->";

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

    private function _getCourseList($addrcode='')
    {
        edu_get_instance('CourseClass');  
        $oCourse = new CourseClass(); 
        if($addrcode)
            return $oCourse->searchCourseList($addrcode); 
        
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
