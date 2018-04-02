<?php 
$aData = array();
$aLoginInfo = array('name'=>'');
$aLConfig = array('A1'=>'총괄관리자','A2'=>'운영자','B1'=>'선생님');
$auth_name = '';

edu_get_instance('CookieClass'); 
if( $sLoginInfo = CookieClass::getCookieInfo() )
{
    $aLoginInfo = (array)json_decode($sLoginInfo);

    if($aLoginInfo['mb_id'])
    {
        edu_get_instance('AuthClass'); 
        $oAuth = new AuthClass($aLoginInfo['mb_id']);
        $aLoginInfo['auth'] = $oAuth->oAuthInfo->gadmin;
        if(! $auth_name = $aLConfig[$oAuth->oAuthInfo->gadmin]) $auth_name = '학생';
        $aLoginInfo['auth_name'] = $auth_name;
    }
}
?>

<?php $this->load->view('common/header');?>

<?php $this->load->view('common/topbar', $aLoginInfo);?>
<?php $this->load->view('common/gnb');?>

<?php $this->load->view($container, $aData); ?>

<?php $this->load->view('common/footer'); ?>
