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
    public function setReqCourseUser($aParam)
    {
        $aConfig = $this->queryInfoCourse['setReqCourseUser'];
        return $this->actModelFuc($aConfig, $aParam);
    }
}
