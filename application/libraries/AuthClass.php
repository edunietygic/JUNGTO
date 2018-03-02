<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthClass {
    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i))
        {
            call_user_func_array(array($this,$f),$a);
        }

    }
    public function  __construct1($mb_id)
    {
        if(!$mb_id) return false;

        $this->mb_id = $mb_id;

        $this->oAuthInfo = $this->getAuthInfo();
    }

    private function getAuthInfo()
    {
        $oAuthModel = edu_get_instance('auth_model', 'model');
        $result = $oAuthModel->getAuthInfo($this->mb_id);
        return $result[0];
    }
    public function isAuthPage($aPageLevel, $mylevel)
    {
        if(!$aPageLevel || !$mylevel) return false;

        if(in_array($mylevel, $aPageLevel))
            return true;

        return false;
    }
}
