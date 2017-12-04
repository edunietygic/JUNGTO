<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'models/Common_dao.php');

class Account_dao extends Common_dao
{
    public function __construct()
    {
        $this->db = $this->load->database('dev', TRUE);
        
        $aQueryInfo = edu_get_config('query', 'query');
        $this->queryInfoEdu = $aQueryInfo['account'];
    }

    public function getAccountInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['getAccountInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }

    public function setAccountInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['setAccountInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }

    public function getEduMemInfo($account_id)
    {
        $aInput = array('mb_id'=>$account_id);
        $aConfig = $this->queryInfoEdu['getMemInfo'];

        //return $this->actModelFucFromDB($aConfig, $aInput, $this->db);
        return $this->actModelFuc($aConfig, $aInput);
    }

}
