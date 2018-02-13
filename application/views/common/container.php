<?php $this->load->view('common/header');?>

<?php $this->load->view('common/topbar');?>
<?php $this->load->view('common/gnb');?>

<?php 
$aData = array();
$this->load->view($container, $aData); 

?>

<?php $this->load->view('common/footer'); ?>
