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

    public function setAccountInfo($aInput)
    {
        return $this->account_dao->setAccountInfo($aInput);
    }

}
