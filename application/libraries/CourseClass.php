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
        
        $rtn = ''; 
        
        if($addrcode)
            $rtn = $course_model->getCourseListAddrcode($addrcode); 
        else
            $rtn = $course_model->getCourseList(); 
        if(isset($rtn) && $rtn)
        {
            foreach($rtn as $key=>$val)
            {
                if(isset($val->img) && $val->img) 
                    $val->img = "http://jungtoadmin.eduniety.cc:8090/dp/subject/".$val->img;
                else
                    $val->img = "/skin/images/school/thum-school-03.png";

            }
        }
        return $rtn;
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
                {
                    $val->start_date = substr($val->start_date,0,10)."(".getDayOfTheWeek(substr($val->start_date,0,4), substr($val->start_date,5,2),substr($val->start_date,8,2)).")"; 
                    $aActiveCourseList[] = $val; 
                }
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
        $rtn = $course_model->getDetailCourse($subj); 

        if(isset($rtn->img) && $rtn->img) 
            $rtn->img = "http://jungtoadmin.eduniety.cc:8090/dp/subject/".$rtn->img;
        else
            $rtn->img = "/skin/images/school/thum-school-03.png";
        
        return $rtn; 
    }
    public function setCourseReqUser($mb_id, $subj, $class_idx=1)
    {
        if(!$mb_id || !$subj) return false; 
    
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->setCourseReqUser($mb_id, $subj, $class_idx); 
    }
    public function getMyCourseInfo($mb_id)
    {
        if(!$mb_id) return false; 
    
        $course_model = edu_get_instance('Course_model', 'model');
        return $course_model->getMyCourseInfo($mb_id); 
    } 
}
