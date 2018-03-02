<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_model{
    public function __construct()
    {
        $this->auth_dao = edu_get_instance('auth_dao', 'model');
    }

    public function getAuthInfo($mb_id)
    {
        if(!$mb_id) return false;
        
        $aInput = array('userid'=>$mb_id); 
        
        return $this->auth_dao->getAuthInfo($aInput);
    }
} 
