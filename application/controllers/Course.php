<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 과목 리스트
     * */
    public function index()
    {
        // init
        $aData = array();
        $aData['addr1'] = '';
        $aData['addr1'] = '';
        $aData['select_addr1'] = '';
        $aData['select_addr2'] = '';

        if(isset($_POST['p_addr1']) && isset($_POST['p_addr2']))
        {
            // select addrcode
            $aData['select_addr1'] = $_POST['p_addr1'];
            $aData['select_addr2'] = $_POST['p_addr2'];
        }

        // addr setting
        $aData['addr1'] = getAddrCode();

        if($aData['select_addr2'])
        {
            $aData['addr2'] = getAddrCode($aData['select_addr1']);
        }

        // get course list
        $aData['aCourseList'] = $this->_getCourseList($aData['select_addr2']);

        $data = array(
            'container' => 'course/index'
            ,'aData'    => $aData
        );

        // test code
        // echo "<!--";
        // print_r($data);
        // echo "-->";

        $this->load->view('common/container', $data);
    }
    /*
     * 과목 상세 보기
     * */
    public function course_detail($subj='')
    {
        if(!$subj) header('Location: /course');

        // course info
        edu_get_instance('CourseClass');
        $oCourse = new CourseClass();
        $aData = array();
        $aData['oCourseInfo'] = $oCourse->getDetailCourse($subj);

        // tutol info
        edu_get_instance('AccountClass');
        $oAccount = new AccountClass();
        $aData['oAccountInfo'] = $oAccount->keyTogglerFromID($aData['oCourseInfo']->tutor);

        // login info
        edu_get_instance('CookieClass');
        if($jLoginInfo = CookieClass::getCookieInfo())
        {
            $aData['oLoginInfo'] = json_decode($jLoginInfo);
            $aData['oLoginInfo']->pwd = $aData['oLoginInfo']->mb_id;
        }
        else
        {
            $aMemInfo['mb_id'] = '';
            $aMemInfo['name']  = '';
            $aMemInfo['pwd']   = '';
            $aMemInfo['mb_hp'] = '';
            $aMemInfo['email'] = '';

            $aData['oLoginInfo']= (object)$aMemInfo;
        }

        // test code
        echo "<!--";
        print_r($aData);
        echo "-->";

        $data = array(
            'container' => 'course/course_sangse'
            ,'aData'    => $aData
        );

        // test code
        // echo "<!--";
        // print_r($data);
        // echo "-->";

        $this->load->view('common/container', $data);

    }
    /*
     * 수강신청
     * */
    public function rpcReqCourse()
    {
        $subj   = trim($this->input->post('subj'));
        $mb_id  = trim($this->input->post('mb_id'));
        $passwd = trim($this->input->post('passwd'));
        $name   = trim($this->input->post('name'));
        $email  = trim($this->input->post('email'));
        $hp     = trim($this->input->post('hp'));

        // is Loginin
        if($mb_id != $passwd)
        {
            // join process

            // is account => pass
            edu_get_instance('AccountClass');
            $oAccount = new AccountClass($mb_id) ;

            if(!$oAccount->oMemberInfo)
            {
                $mkpwd = $oAccount->getPwd($mb_id, $passwd, 'reqCourse');
                $aJoinInfo = array(
                     'mb_id'        => $mb_id
                    ,'mb_password'  => $mkpwd
                    ,'mb_name'      => $name
                    ,'mb_email'     => $email
                    ,'mb_hp'        => substr($hp,0,3).'-'.substr($hp,3,4).'-'.substr($hp,7,4)
                    ,'mb_join_date' => date('Y-m-d h:i:s')
                );
                $oAccount->joinMember($aJoinInfo);
            }
        }

        // req process
        if(!$mb_id || !$subj)
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }

        edu_get_instance('CourseClass');
        $oCourse = new CourseClass();
        if(!$oCourse->setCourseReqUser($mb_id, $subj) )
        {
            response_json(array('code'=> 2 , 'msg'=>'is req'));
            die;
        }

        response_json(array('code'=> 1 , 'msg'=>'OK'));
        die;

    }
    private function _getCourseList($addrcode='')
    {
        edu_get_instance('CourseClass');
        $oCourse = new CourseClass();
        if($addrcode)
            $oCourse->searchCourseList($addrcode);

        return $oCourse;
    }
    public function rpcGetAddrCode($code='')
    {
        if(!$code) $code = $this->input->post('code');
        $aAddrCode = getAddrCode($code);

        response_json(array('code'=> 1 , 'msg'=>'OK', 'result'=>$aAddrCode));
        die;

    }
}
