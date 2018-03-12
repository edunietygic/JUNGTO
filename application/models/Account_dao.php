<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'models/Common_dao.php');

class Account_dao extends Common_dao
{
    public function __construct()
    {
        $this->db = $this->load->database('dev', TRUE);

        $aQueryInfo = edu_get_config('query', 'query');
        $this->queryInfoAccount = $aQueryInfo['account'];
    }

    public function mkpwdquery1($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['mkpwdquery1'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function mkpwdquery2($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['mkpwdquery2'];
        return $this->actModelFuc($aConfig, $aParam);
    }

    public function getAccountInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['getAccountInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getAccountInfoKeyToggler($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['getAccountInfoKeyToggler'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function setAccountInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['setAccountInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }

    public function findAccountId($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['findAccountId'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function findAccountPw($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['findAccountPw'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function changeAccountPw($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['changeAccountPw'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function updateMemberInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['updateMemberInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function deleteMemberInfo($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['deleteMemberInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function deleteSubjApplicant($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['deleteSubjApplicant'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function chkAccountId($aParam=array())
    {
        $aConfig = $this->queryInfoAccount['chkAccountId'];
        return $this->actModelFuc($aConfig, $aParam);
    }
/*
    public function getEduMemInfo($account_id)
    {
        $aInput = array('mb_id'=>$account_id);
        $aConfig = $this->queryInfoEdu['getMemInfo'];

        //return $this->actModelFucFromDB($aConfig, $aInput, $this->db);
        return $this->actModelFuc($aConfig, $aInput);
    }
 */
}
