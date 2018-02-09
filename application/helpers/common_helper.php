<?php
function edu_get_instance($sClassName, $sType='library')
{
    $CI = & get_instance();

    $nLastPost = strrpos($sClassName, '/');
    if($nLastPost !== false)
        $sVarName = substr($sClassName, $nLastPost + 1 );
    else
        $sVarName = $sClassName;

    if($sType == 'model')
        $sCiValName = $sVarName;
    else
        $sCiValName = strtolower($sVarName);

    if(!isset($CI->{$sCiValName}))
    {
        $CI->load->{$sType}($sClassName);
    }

    return $CI->{$sCiValName};
}
function edu_get_config($sKey, $sFileName, $bUsePart=true)
{
    $CI = & get_instance();
    $CI->config->load($sFileName, $bUsePart);

    if($bUsePart)
        return $CI->config->item($sKey, $sFileName);
    else
        return $CI->config->item($sKey);
}
function response_json($aRtn)
{
    $res = "";

    if(is_array($aRtn))
        $res = json_encode($aRtn);
    elseif(is_array(json_encode($aRtn)))
        $res = $aRtn;

    if($res == '') return;

    header('Content-type: text/json');
    header('Content-type: application/json');
    echo $res;
}
function getCookieInfo()
{
    $CI = & get_instance();
    $CI->load->helper('cookie');
    return  get_cookie('eduniety_membership');
}
function setDateFormat($sDate, $type)
{
    if(!$sDate) return '-';

    switch($type)
    {
        case 'YMD':
            $result = substr($sDate, 0, 4). "년 ". substr($sDate, 5, 2). "월 ". substr($sDate, 8, 2). "일 ";
            break;
        case 'Y-M-D':
            $result = substr($sDate, 0, 4). "-". substr($sDate, 4, 2). "-". substr($sDate, 6, 2);
            break;
    }
    return $result;
}
function sendCURLPost($url,$params)
{
    if(!$url) return false;

    $postData = '';
    
    foreach($params as $k => $v) 
    { 
        if($v)  $postData .= $k . '='.$v.'&'; 
    }
    $postData = rtrim($postData, '&');

    $ch = curl_init();  
                                
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
                                                         
    $output=curl_exec($ch);
                                                              
    curl_close($ch);

    return $output;
}
function sendCURLGet($url,$params)
{
    if(!$url) return false;

    $postData = '';
    
    foreach($params as $k => $v) 
    {
        if($v)  $postData .= $k . '='.$v.'&'; 
    }
    $postData = rtrim($postData, '&');

    $url .= "?".$postData;

    $ch = curl_init();  
    
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                                                         
    $output=curl_exec($ch);

    //$output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $output);
    
    curl_close($ch);
    return $output;
}
function getMenuData($sController, $sMethod)
{
    $aMenu = edu_get_config('menu','menu');

    $aRtn = $aMenu[$sController]['sub'][$sMethod];

    return $aRtn;
}
function chkLoginInfo()
{
    // chk login session
    if($aMemberInfo = LoginClass::isLogin())
    {
        return $aMemberInfo;
    }
    else
    {
        $aRtn = array('usn'=>'');
        return (object)$aRtn;
    }    
    // view login page 
    //header('Location: '.HOSTURL.'/Login');
}
function replaceArticleHTML($sText)
{
    $sText = preg_replace("/<script([^>]*)>/i", '&lt;script$1&gt;', $sText);
    $sText = preg_replace("/<\/script>/i", '&lt;/script&gt;', $sText);

    return $sText;
}

function generalizeCMPW($in, $mid, $encode=TRUE, $bound=24, $in_str_auto=false, $in_str_auto_length=12)
{
    (string)$secuStr = "@!edu-society!@";
    (string)$mid2 = $secuStr.$mid;
    (array)$randStr = array($bound);
    (array)$randKey = array();
    (array)$randRef = array();
    ## with@ at 2017-06-09 : 비밀번호 재발급시 발송되는 임시비밀번호에 특수문자가 들어가지 않도록 특수문자 seed 제외
    (array)$randRef = explode(",", "0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z");
    (int)$seedLen = count($randRef);
    (string)$subfix = "";
    (array)$wasteStr = array();
    (array)$out = array(3);
    (string)$auth_pw = "";

    if($in_str_auto)
    {   
        $in="";
        for($au=0; $au<$in_str_auto_length; $au++)
        {
            $in .= $randRef[mt_rand(0,$seedLen-1)];
        }
    }
    
    if( empty($mid) || empty($in) ) return NULL;

    (int)$in_len = mb_strlen($in);
    
    ## 변조 string 보다 긴 경우 subfix 저장
    if($in_len>$bound)
    {
        $subfix = mb_substr($in, $bound);
        $in_len = $bound;
    }

    if($encode===TRUE) // encode
    {
	    ## string 변조 참조 키 생성
        for($i=0; $i<$in_len; $i++)
        {
            // 참조값은 중복 없이 생성
            for($j=0; $j<$bound; $j++)
            {
                $tmpKey = mt_rand(0,$bound-1);
                
                if ( !in_array($tmpKey, $randKey) )
                {
                    $randKey[$i] = $tmpKey;
                    break;
                }
            }
        }

	    ## string 변조
        for($i=0; $i<$bound; $i++)
        {
            $skey = array_search($i, $randKey);
            if ( $skey !== FALSE )
            {
                $randStr[$i] = mb_substr($in, $skey, 1);
                $wasteStr[] = $randRef[mt_rand(0,$seedLen-1)];
            }
            else
            {
                $randStr[$i] = $randRef[mt_rand(0,$seedLen-1)];
                $wasteStr[] = $randStr[$i];
            } 
        }

        // fot debug
        $out[0] = implode("|",$randKey);
        $out[1] = implode("",$wasteStr);
        $out[2] = implode("", $randStr).$subfix;
        /*
        +-------+--------------+------+-----+-------------------+-----------------------------+
        | Field | Type         | Null | Key | Default           | Extra                       |
        +-------+--------------+------+-----+-------------------+-----------------------------+
        | gk    | char(32)     | NO   | PRI | NULL              |                             |
        | gv    | varchar(100) | NO   |     | NULL              |                             |
        | gd    | timestamp    | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
        | gw    | varchar(45)  | NO   |     | NULL              |                             |
        +-------+--------------+------+-----+-------------------+-----------------------------+
        */
        
        if( sql_query("replace into edu_gtmp (gk,gv,gw) values (md5('{$mid2}'),'{$out[0]}','{$out[1]}')") )
        {
            $auth_pw = md5($out[2]);
            
            unset($out);
            $out = array(2, $auth_pw);
            if($in_str_auto) $out[2] = $in;
        }
        else
        {
            unset($out);
            $out = array(2, FALSE);
        }
    }
    else // decode
    {
        $row = sql_fetch("select gv, gw from edu_gtmp where gk = md5('{$mid2}')");
        if( isset($row['gv']) && !empty($row['gv']) )
        {
            $gv = explode("|", $row['gv']);
            $gw = $row['gw'];
            
            for($i=0; $i<mb_strlen($gw); $i++)
            {
                $skey = array_search($i, $gv);
                if ( $skey !== FALSE )
                {
                    $randStr[$i] = mb_substr($in, $skey, 1);
                }
                else
                {
                    $randStr[$i] = mb_substr($gw, $i, 1);
                }
            }

            // for debug
            $out[0] = $row['gv'];
            $out[1] = $row['gw'];
            $out[2] = implode("", $randStr).$subfix;

            // auth check : version 2
            $auth_pw = md5($out[2]);
            unset($out);
            $out = array(2, $auth_pw);
        }
        else
        {
            // auth check : version 1
            $auth_pw = md5($in);

            unset($out);
            $out = array(1, $auth_pw);
        }
    }
    return $out;
}
