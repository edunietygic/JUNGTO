<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CourseClass {

    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i))
        {
            call_user_func_array(array($this,$f),$a);
        }
    
        $this->oActiveCourse = $this->getActiveCourseList();    
    }
    public function  __construct1($course_idx)
    {
        if(!$course_idx) return false;
        
        $this->oCourseInfo = $this->getDetailCourse($course_idx);
    }

    public function getCourseList($addrcode='')
    {
        $course_model = edu_get_instance('Course_model', 'model');
        
        if($addrcode)
            return $course_model->getCourseListAddrcode($addrcode); 
        else
            return $course_model->getCourseList(); 
    }
    private function _makeCourseList($aCourseList)
    {
        $aActiveCourseList = array();
        
        $today = date('Y-m-d H:i:s');
        if(is_array($aCourseList) && count($aCourseList) >=1)
        {
            foreach($aCourseList as $key=>$val)
            {
                if($val->open_date <= $today && $today <= $val->close_date)
                     $aActiveCourseList[] = $val; 
            }
        }
        return $aActiveCourseList;  
    }
    public function searchCourseList($addrcode)
    {
        if(!$addrcode) return false;

        $aCourseList = $this->getCourseList($addrcode); 
        $aActiveCourseList = $this->_makeCourseList($aCourseList);;
        $this->oActiveCourse = $aActiveCourseList;
        return $aActiveCourseList;
    }
    public function getActiveCourseList()
    {
        $aCourseList = $this->getCourseList(); 
        $aActiveCourseList = $this->_makeCourseList($aCourseList);;
        return $aActiveCourseList;
    }
    public function getUserListFromCourse($subj)
    {
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->getUserListFromCourse($subj); 
    }
    public function getDetailCourse($subj)
    {
        if(!$subj) return false;
       
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->getDetailCourse($subj); 
            
    }
    public function setCourseReqUser($mb_id, $subj)
    {
        if(!$mb_id || !$subj) return false; 
    
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->setCourseReqUser($mb_id, $subj); 
    }
    public function getMyCourseInfo($mb_id)
    {
        if(!$mb_id) return false; 
    
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->getMyCourseInfo($mb_id); 
    } 
}
