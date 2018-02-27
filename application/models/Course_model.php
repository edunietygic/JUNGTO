<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_model extends CI_model{
    public function __construct()
    {
        $this->course_dao = edu_get_instance('Course_dao', 'model');
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
