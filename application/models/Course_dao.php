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

}
