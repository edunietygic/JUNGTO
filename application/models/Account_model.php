<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account_model extends CI_model{
    public function __construct()
    {
        $this->account_dao = edu_get_instance('account_dao', 'model');
    }

    public function isAccount($account_id)
    {
        if(!$account_id) return false;

        $aInput = array('account_id'=>$account_id);
        $aAccountInfo = $this->account_dao->getAccountInfo($aInput);

        if( is_array($aAccountInfo) && count($aAccountInfo) > 0 )
            return $aAccountInfo;

        return false;
    }
    
    public function getAccountInfo($account_id)
    {
        if(!$account_id) return false;
        
        $aInput = array('mb_id' => $account_id);
        $aAccountInfo = $this->account_dao->getAccountInfo($aInput);

        if( is_array($aAccountInfo) && count($aAccountInfo) > 0 )
            return $aAccountInfo[0];

        return false;
    }
    public function getAccountInfoKeyToggler($account_id)
    {
        if(!$account_id) return false;
        
        $aInput = array('mb_id' => $account_id);
        $aAccountInfo = $this->account_dao->getAccountInfoKeyToggler($aInput);

        if( is_array($aAccountInfo) && count($aAccountInfo) > 0 )
            return $aAccountInfo[0];

        return false;
    }
    public function setAccountInfo($aInput)
    {
        return $this->account_dao->setAccountInfo($aInput);
    }

    public function getEduMemInfo($account_id)
    {
        if(!$account_id) return false;

        $aEduMemInfo = $this->account_dao->getEduMemInfo($account_id);

        return $aEduMemInfo;
    }
    public function mkpwdquery1($mid2, $out, $out1)
    {
        $aInput = array('mid2'=>$mis2, 'out'=>$out, 'out1'=>$out1); 
        return $this->account_dao->mkpwdquery1($aInput);
    }
    public function mkpwdquery2($mid2)
    {
        $aInput = array('mid2'=>$mid2); 
        $aResult = $this->account_dao->mkpwdquery2($aInput);
        return (array)$aResult[0];
    }

    public function findAccountId($aInput)
    {
        $oEduMemInfo = $this->account_dao->findAccountId($aInput);
        return $oEduMemInfo[0];
    }

    public function findAccountPw($aInput)
    {
        $oEduMemInfo = $this->account_dao->findAccountPw($aInput);
        return $oEduMemInfo[0];
    }

    public function changeAccountPw($aInput)
    {
        return $this->account_dao->changeAccountPw($aInput);
    }
}
