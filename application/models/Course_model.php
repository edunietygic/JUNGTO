<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_model extends CI_model{
    public function __construct()
    {
        $this->course_dao = edu_get_instance('Course_dao', 'model');
    }



    public function getCouseSUBJInfo()
    {  
        $today =  date('Y-m-d')." 00:00:00";
        $aInput = array(
             'open_date'  => $today
            ,'close_date' => $today
        );
        $aResult = $this->course_dao->getCourseSUBJInfo($aInput) ;
        $aSUBJInfo = array();
        $cnt=0;
        $default = 6;
        
        // echo "<pre>";
        // print_r($aResult);
        
        foreach($aResult as $key=>$val)
        {
            $aTemp[$cnt] = $val->subj;
            
            if($cnt > $default)
            {
                $cnt=0;
                $aSUBJInfo[] = $aTemp;
                $aTemp = array();
            }
            else
                $cnt++;
        }
        $aSUBJInfo[] = $aTemp;
        // print_r($aSUBJInfo); 
        
        return $aSUBJInfo;
    }


    public function getCourseListAdd($aInput)
    {
        $aCourseList = $this->course_dao->getCourseListAdd($aInput);

        return $aCourseList; 
    }
    public function getCourseList()
    {
        $aInput = array('isonoff' => 'OFF');
        $aCourseList = $this->course_dao->getCourseList($aInput);

        return $aCourseList; 
    }
    public function getCourseListAddrcode($sAddrCode)
    {
        $aInput = array('isonoff' => 'OFF', 'addrcode'=>$sAddrCode);
        $aCourseList = $this->course_dao->getCourseListAddrcode($aInput);

        return $aCourseList; 
    }
    
    public function getMyCourseInfo($mb_id)
    {
        if(!$mb_id) return false;
        $aInput = array('mb_id' => $mb_id);

        $aCourseList = $this->course_dao->getMyCourseList($aInput);
        return $aCourseList;
    }
    public function getUserListFromCourse($subj)
    {
        if(!$subj) return false;

        $aInput = array('subj' => $subj);
        $aCourseList = $this->course_dao->getUserListFromCourse($aInput);

        return $aCourseList; 
    }
    public function getDetailCourse($subj)
    {
        if(!$subj) return false;

        $aInput = array('subj' => $subj);
        $aCourseList = $this->course_dao->getDetailCourse($aInput);

        return $aCourseList[0]; 
    }
    
    public function setCourseReqUser($mb_id, $subj, $class_idx=1)
    {
        if(!$mb_id || !$subj) return false; 
    
        // 중복신청 
        if( !$this->_chkReqInfo($mb_id, $subj)) return false;

        // 신청
        return $this->_reqCourse($mb_id, $subj, $class_idx); 
    }
    private function _reqCourse($mb_id, $subj, $class_idx=1)
    {
        if(!$mb_id || !$subj) return false; 

        $aInput = array(
             'mb_id' => $mb_id
            ,'subj'  => $subj
            ,'state' => 'REQ' 
            ,'class_idx' => $class_idx 
            ,'regdate' => date('Y-m-d H:i:s') 
        ); 
        $this->course_dao->setReqCourseUser($aInput);     
        return true;
    }    
    private function _chkReqInfo($mb_id, $subj)
    {
        if(!$mb_id || !$subj) return false; 

        if( $aUserList = $this->getUserListFromCourse($subj) )
        {
            foreach($aUserList as $key=>$val)
            {
                if($val->mb_id == $mb_id)
                    return false; 
            }
        }
        
        return true; 
    }
}
