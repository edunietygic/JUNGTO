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

        // test code
        echo "<pre>";
        print_r($aCourseList);


        $data = array(
            'container' => 'course/index'
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
    public function rpcRegCourse()
    {
    
    }
    private function _getCourseList()
    {
        edu_get_instance('CourseClass');  
        $oCourse = new CourseClass(); 
        
        return $oCourse; 
    }
    
}
