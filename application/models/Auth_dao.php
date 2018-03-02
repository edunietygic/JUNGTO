<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'models/Common_dao.php');

class Auth_dao extends Common_dao
{
    public function __construct()
    {
        $this->db = $this->load->database('dev', TRUE);
        
        $aQueryInfo = edu_get_config('query', 'query');
        $this->queryInfoAuth = $aQueryInfo['auth'];
    }
    
    public function getAuthInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAuth['getAuthInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }
}
