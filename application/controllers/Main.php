<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
     //   $this->account_model = edu_get_instance('account_model', 'model');
        //    $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $data = array(
            'container' => 'main/index'
        );

        $this->load->view('common/container', $data);

        // id check
        //if(! $account_id = $this->_isLogin() )
        //{
        //    alert('로그인 후 이용하세요.','/login');
        //    die;
        //}

        // get account info
        //$acc  = edu_get_instance('AccountClass');
        //$oAcc = new $acc($account_id);

        // get note info
        //$usn = $oAcc->oAccInfo->usn;
        //$note  = edu_get_instance('NoteClass');
        //$oNote = new $note($usn);

        //$data = array();
        //$aUserInfo = array(
        //        'oAccountInfo'   => $oAcc->oAccInfo
        //       ,'oNoteInfo'      => $oNote->oNoteInfo
        //    );
        //$data['aUserInfo'] = $aUserInfo;

        //// test code
        //echo "<!--";
        //print_r($data);
        //echo "-->";

        //$this->load->view('main/dashboard', $data);
    }


    public function test()
    {
        //echo "aaaa";
        $account = "bolee";
        $oAccountModel = edu_get_instance('Account_model', 'model');
        print_r($oAccountModel->getEduMemInfo($account));
    }
    public function testDB()
    {
        // test code db ACL check
        echo "aaaa";
        $account = "jazzwave14";
        $oAccountModel = edu_get_instance('Account_model', 'model');
        print_r($oAccountModel->getEduMemInfo($account));
    }
    public function testUpload()
    {
        // test code file upload view
        $data = array('error'=>'');
        $this->load->view('main/uploadtest', $data);
    }
    public function do_upload()
    {
        // test code file upload
        $usn = 2;
        $oFile = edu_get_instance("FileClass");
        $oFile->saveFile($usn, $_FILES);
    }
    public function deleteImg($usn, $filename)
    {
        $oFile = edu_get_instance("FileClass");
        $oFile->deleteFile($usn, urldecode($filename));
    }
    public function getImglink($usn, $filename)
    {
        $oFile = edu_get_instance("FileClass");
        $oFile->getFileLink($usn, urldecode($filename));
    }




    private function _isLogin()
    {
        return true;
//      edu_get_instance('LoginClass');
//      $oMemberInfo = LoginClass::isLogin();
//
//      if($oMemberInfo->usn)
//          return $oMemberInfo->account;
//
//      return false;
    }

}
