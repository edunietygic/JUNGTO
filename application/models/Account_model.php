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

    public function setAccountInfo($aParam)
    {
        // chk param

        // set db      
        // $aInput = array(
        //      'account' => $account_id
        //     ,'oauth'   => $site
        //     ,'regdate' => $regdate
        //     ,'accessToken' => $accessToken
        // );
        // return $this->account_dao->setAccountInfo($aInput);
    }

    public function getEduMemInfo($account_id)
    {
        if(!$account_id) return false;

        $aEduMemInfo = $this->account_dao->getEduMemInfo($account_id);

        return $aEduMemInfo;
    }

}
