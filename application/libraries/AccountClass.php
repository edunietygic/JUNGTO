<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountClass {

    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i))
        {
        call_user_func_array(array($this,$f),$a);
        }
    }
    public function  __construct1($account_id)
    {
        if(!$account_id) return false;
        
        $this->account_id = $account_id;

        $this->oMemberInfo = $this->_getAccountInfo($this->account_id);
    }
    private function _chkParam($aInput, $aChkParam))
    {
        $bParam = true;
        foreach($aChkParam as $key=>$val)
        {
            if(!$aInput[$val])
            {
                $bParam = false;
                break;
            } 
        } 
        
        return $bParam; 
    }
    public function joinMember($aParam)
    {
        $aChkParam = array('mb_id', 'mb_password', 'mb_name', 'mb_email', 'mb_hp', 'mb_join_date');
            
        if(!$this->_chkParam($aParam, $aChkParam))  return false;    
        
        $oAccModel = edu_get_instance('account_model', 'model');
        $rtn = $oAccModel->account_model->setAccountInfo($aParam); 
        return $rtn; 
    } 
    private function _getAccountInfo($account_id)
    {
        $oAccModel = edu_get_instance('account_model', 'model');
        $aAccInfo = $oAccModel->account_model->getAccountInfo($account_id);

        return $aAccInfo;
    }
    
}
