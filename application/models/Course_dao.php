<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'models/Common_dao.php');

class Course_dao extends Common_dao
{
    public function __construct()
    {
        $this->db = $this->load->database('dev', TRUE);
        
        $aQueryInfo = edu_get_config('query', 'query');
        $this->queryInfoCourse = $aQueryInfo['course'];
    }
    public function getCourseSUBJInfo($aParam)
    {
        $aConfig = $this->queryInfoCourse['getCourseSUBJInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getCourseListAdd($aParam)
    {
        $btype = '';
        $query = "
            SELECT s.class1, s.class2, s.class3, s.class4, s.class5, s.part, s.place, s.subj, s.subjnm, s.subjnm2, s.subjclass, s.upperclass, s.middleclass, s.lowerclass, s.muserid, s.musertel, s.tutor, s.edudays, s.edutimes, s.place, s.studentlimit, s.open_date, s.close_date, s.start_date, s.end_date, s.eduoutline, s.edupreparation , s.`explain`, s.edumans, s.memo, s.addrcode, s.addrstring, s.introducefilenamenew3 as img, (select count(*) from eduniety.lms_subj_applicant where subj = s.subj) as a_cnt
              FROM lms_subj s
             WHERE 
               s.subj IN (";
        for($i=0 ; $i<count($aParam); $i++)
        {
            $query .= "?,";
            $btype .= 's';
        }
        $query = substr($query, 0,-1).')';
                        
        $oResult = $this->db->query($query, $aParam, true, $btype);
        $oRtn = $oResult->result();

        return $oRtn;
    }
    public function getCourseList($aParam)
    {
        $aConfig = $this->queryInfoCourse['getCourseList'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getCourseListAddrcode($aParam)
    {
        $aConfig = $this->queryInfoCourse['getCourseListAddrcode'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getMyCourseList($aParam)
    {
        $aConfig = $this->queryInfoCourse['getMyCourseList'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getUserListFromCourse($aParam)
    {
        $aConfig = $this->queryInfoCourse['getUserListFromCourse'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getDetailCourse($aParam)
    {
        $aConfig = $this->queryInfoCourse['getDetailCourse'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function setReqCourseUser($aParam)
    {
        $aConfig = $this->queryInfoCourse['setReqCourseUser'];
        return $this->actModelFuc($aConfig, $aParam);
    }
}
