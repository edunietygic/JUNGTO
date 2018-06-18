<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function addList($url='0')
    {
        if($url != '0')
        {
            $aTemp = explode('-',$url);
            $sequence = $aTemp[2] - 1;
        }   
        else
        {
            $sequence = 0;
        }

        $aData['aCourseList'] = $this->_getCourseListAdd($sequence);
        $data = array(
            'aData'    => $aData
        );

        // test code
        // echo "<!--";
        // print_r($data);
        // echo "-->";

        $this->load->view('course/courseaddlist', $data);
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

        if((isset($_POST['p_addr1']) && isset($_POST['p_addr2'])) && ($_POST['p_addr1'] && $_POST['p_addr2']))
        {
            // select addrcode
            $aData['select_addr1'] = $_POST['p_addr1'];
            $aData['select_addr2'] = $_POST['p_addr2'];
            $aData['select_addr_string'] = explode(" ",trim(getAddrStringFromCode($aData['select_addr2']))) ;
        } 
        else
        {
            $aData['search_addr1'] = "";
            $aData['search_addr2'] = "";
            $aData['select_addr_string'] = array('','');
        }

        // addr setting
        $aData['addr1'] = getAddrCode();

        if($aData['select_addr2'])
        {
            $aData['addr2'] = getAddrCode($aData['select_addr1']);
        }

        // get course list
        if($aData['select_addr2'])
            $aData['aCourseList'] = $this->_getCourseList($aData['select_addr2']);
        else
            $aData['aCourseList'] = $this->_getCourseListAdd('0') ;

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
        $aData['oCourseInfo']->addr_string = trim(getAddrStringFromCode($aData['oCourseInfo']->addrcode) . " " . $aData['oCourseInfo']->addrstring) ;
        
        // tutol info
        edu_get_instance('AccountClass');
        $oAccount = new AccountClass();
        if( !$aData['oTutorInfo'] = $oAccount->keyTogglerFromID($aData['oCourseInfo']->tutor) )
            $aData['oTutorInfo'] = (object)array('mb_name'=>'미지정', 'mb_hp'=>'미지정');

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

        // set class info
        $aData['aClass'] = array();
        $aTemp = array($aData['oCourseInfo']->class1,$aData['oCourseInfo']->class2,$aData['oCourseInfo']->class3,$aData['oCourseInfo']->class4,$aData['oCourseInfo']->class5) ;
        $aData['aClass'] = $this->_makeClassInfo($aTemp);
        
        // test code
        // echo "<!--";
        // print_r($aData);
        // echo "-->";
 
        $data = array(
            'container' => 'course/course_sangse'
            ,'aData'    => $aData
        );

        $this->load->view('common/container', $data);

    }
    private function _makeClassInfo($aClass=array())
    {
        if(count($aClass)==0) return false; 

        $aRtn = array(); 
        foreach($aClass as $key=>$val)
        {
            if($val) $aRtn[] = $val; 
        } 
        return $aRtn;
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
        $class_idx = trim($this->input->post('class_idx'));

        $bJoin = true;

        // is Loginin
        if($mb_id != $passwd)
        {
            // join process
            // param chk
            if(!$mb_id || !$passwd || !$name || !$email || !$hp)
            {
                response_json(array('code'=> 99 , 'msg'=>'회원가입에 필요한 정보를 입력해 주세요'));
                die;
            }

            // 핸드폰 번호 가비지 체크
            $hp2 = str_replace('-' , '', $hp);
            if( strlen(trim($hp2)) < 10 )
            {
                response_json(array('code'=> 98 , 'msg'=>'핸드폰 번호를 정상적으로 입력 해 주세요'));
                die;
            }

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
                if( ! $oAccount->joinMember($aJoinInfo) )
                {
                    $bJoin = false;
                }
            }
        }

        if($bJoin)
        {
            // req process
            if(!$mb_id || !$subj)
            {
                response_json(array('code'=> 99 , 'msg'=>'Fail'));
                die;
            }
            
            if(!$class_idx) $class_idx = 1;

            edu_get_instance('CourseClass');
            $oCourse = new CourseClass();
            if(!$oCourse->setCourseReqUser($mb_id, $subj, $class_idx) )
            {
                response_json(array('code'=> 2 , 'msg'=>'이미 신청 되어 있습니다.'));
                die;
            }

            response_json(array('code'=> 1 , 'msg'=>'OK'));
            die;
        }
        response_json(array('code'=> 99 , 'msg'=>'Fail'));
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
    private function _getCourseListAdd($sequence='0')
    {
        edu_get_instance('CourseClass');
        $oCourse = new CourseClass();
        $oCourse->searchCourseListAdd($sequence);

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
