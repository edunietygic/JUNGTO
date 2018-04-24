<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loginout_model extends CI_model{
    public function __construct()
    {
    }
    public function logout()
    {
        // del cookie 
        edu_get_instance('CookieClass'); 
        CookieClass::delCookieInfo();  
    
        return true;
    }
    public function login($user_id, $user_pwd)
    {
        if(!$user_id || !$user_pwd) return false;    

        // chk cookie 
        edu_get_instance('CookieClass'); 
        if( $oMemberInfo = CookieClass::getCookieInfo() )
        {
            // del Cookie
            CookieClass::delCookieInfo();
        } 
        
        // login process
        if(! $oMemInfo = $this->_getMemberInfo($user_id))
        {
            return false; 
        }
        
        // mkpwd
        $sMkpwd = $this->_mkPwd($user_id, $user_pwd);

        if(trim($sMkpwd) == trim($oMemInfo->oMemberInfo->mb_password))
        {
            // set cookie
            $aMemberInfo = array(
                 'mb_id' => $oMemInfo->oMemberInfo->mb_id    
                ,'name'  => $oMemInfo->oMemberInfo->mb_name
                ,'email' => $oMemInfo->oMemberInfo->mb_email
                ,'mb_hp' => $oMemInfo->oMemberInfo->mb_hp
            ); 
            CookieClass::setCookieInfo($aMemberInfo);

            return true; 
        }

        return false;
    } 
    private function _getMemberInfo($account_id)
    {
        if(!$account_id) return false;    
        
        edu_get_instance('AccountClass'); 
        $oMem = new AccountClass($account_id); 
        return $oMem;
    } 
    private function _mkPwd($user_id, $user_pwd)
    {
        if(!$user_id || !$user_pwd) return false;    

        //$aResult = generalizeCMPW($user_pwd, $user_id, false);
        $aResult = makePWD($user_pwd, $user_id);
        return $aResult[1];
    }
}
