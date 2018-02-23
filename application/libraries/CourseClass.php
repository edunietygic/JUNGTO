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

    public function getCourseList()
    {
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->getCourseList(); 
    }
    public function getActiveCourseList()
    {
        $aCourseList = $this->getCourseList(); 

        $aActiveCourseList = array();

        $today = date('Y-m-d H:i:s');
        foreach($aCourseList as $key=>$val)
        {
            if($val->open_date <= $today && $today <= $val->close_date)
                $aActiveCourseList[] = $val; 
        } 
        return $aActiveCourseList;
    }
    public function getUserListFromCourse($subj)
    {
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->getUserListFromCourse($subj); 
    }
    public function getDetailCourse($course_idx)
    {
        if(!$course_idx) return false;
     
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
