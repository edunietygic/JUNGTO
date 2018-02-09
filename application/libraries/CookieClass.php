<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class CookieClass { 
                    
    public function  __construct()
    {       
        $this->setExpire = time()+86400;
        $this->unsetExpire = time()-3600;
    }
    public function unsetCookie()
    {   
        if( isset($_SERVER['HTTP_COOKIE']) )
        {
            foreach ($_COOKIE as $sName => $sValue)
            {
                setcookie($sName, '', $this->unsetExpire, '/');
            }
        }
    }
    public static function getCookieInfo()
    {   
        $CI = & get_instance();
        $CI->load->helper('cookie');
    
        if($jMemberInfo = get_cookie('edu_coupon_MemberInfo'))
            return $jMemberInfo;
        else
            return false;
    }       
    public static function setCookieInfo($admin_id, $site, $name)
    {
        $CI = & get_instance();
        $CI->load->helper('cookie');
   
        $cookie = array(
            'name'   => 'MemberInfo',
            'value'  => json_encode(array('admin_id'=>$admin_id, 'site'=>$site, 'name'=>$name)),
            'expire' => '86500',
            'prefix' => 'edu_coupon_',
            'domain' => 'eduniety.net',
        );

        set_cookie($cookie);

        return;
    }
    public static function delCookieInfo($name='MemberInfo')
    {   
        $CI = & get_instance();
        $CI->load->helper('cookie');
         
        delete_cookie($name, 'eduniety.net', '/', 'edu_coupon_');

        return;
    }
}