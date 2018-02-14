<?php 
$aData = array();
$aLoginInfo = array('name'=>'');
edu_get_instance('CookieClass'); 
if( $sLoginInfo = CookieClass::getCookieInfo() )
{
    $aLoginInfo = (array)json_decode($sLoginInfo);
}
// test code
echo "<!--";
print_r($aLoginInfo);
echo "-->";
?>

<?php $this->load->view('common/header');?>

<?php $this->load->view('common/topbar', $aLoginInfo);?>
<?php $this->load->view('common/gnb');?>

<?php $this->load->view($container, $aData); ?>

<?php $this->load->view('common/footer'); ?>
