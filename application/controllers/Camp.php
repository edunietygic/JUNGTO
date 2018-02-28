<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Camp extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $aBbsInfo = edu_get_config('bbs', 'jungto');
        $this->tabseq = $aBbsInfo[$this->uri->segment(1)]['tabseq'];
    }

    public function index()
    {
        $aMemberInfo = $this->_getMemberInfo();

        edu_get_instance('BoardClass');
        $aLdata          = BoardClass::getBoardList($this->tabseq);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        // $aAttachFile    = BoardClass::getAttachFile($seq);

        $sidebar_data = array(
            'aRecentReply'    => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $data = array(
            'container' => 'camp/index'
            ,'sidebar'    => $sidebar
            ,'aMemberInfo'    => $aMemberInfo
            ,'aLdata'   => $aLdata
        );

        $this->load->view('common/container', $data);
    }

    public function camp_write()
    {
        if(! $aMemberInfo = $this->_getMemberInfo())
        {
            alert('로그인이 필요합니다', HOSTURL.'/main');
        }
        else
        {
            edu_get_instance('BoardClass');
            // $aNoticeDetail = BoardClass::getNoticeDetail($seq);
            $aRecentReply    = BoardClass::getRecentReply();
            $aRecentContents = BoardClass::getRecentContents();
            $aHotContents    = BoardClass::getHotContents();
            // $aAttachFile    = BoardClass::getAttachFile($seq);

            $sidebar_data = array(
                 'aRecentReply'    => $aRecentReply
                ,'aRecentContents' => $aRecentContents
                ,'aHotContents'    => $aHotContents
            );
            $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

            $data = array(
                 'container'    => 'camp/camp_write'
                ,'sidebar'      => $sidebar
                ,'tabseq'       => $this->tabseq
                ,'aMemberInfo'  => $aMemberInfo
            );

            $this->load->view('common/container', $data);
        }
    }

    public function camp_detail($seq=0)
    {
        edu_get_instance('BoardClass');
        $aBoardDetail    = BoardClass::getBoardDetail($this->tabseq, $seq);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        // $aAttachFile     = BoardClass::getAttachFile($seq);
        $aAttachFile     = array();

        $aPreData = $aNextData = (object) array();
        foreach ($aBoardDetail as $key => $obj) {
            if($seq == $obj->seq){
                $aDetailData = $obj;
            }
            else if($seq > $obj->seq){
                $aPreData = (object) array('seq' => $obj->seq, 'title' => $obj->title);
            }
            else if($seq < $obj->seq){
                $aNextData = (object) array('seq' => $obj->seq, 'title' => $obj->title);
            }
        }

        $sidebar_data = array(
             'aRecentReply'    => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $data = array(
             'container'      => 'camp/camp_detail'
            ,'sidebar'        => $sidebar
            ,'tabseq'         => $this->tabseq
            ,'aDetailData'    => $aDetailData
            ,'aPreData'       => $aPreData
            ,'aNextData'      => $aNextData
            ,'aAttachFile'    => $aAttachFile
        );

        $this->load->view('common/container', $data);
    }

    public function rpcSaveCamp()
    {
        $aInput = array();
        $aInput['tabseq']   = trim($this->input->post('tabseq'));
        $aInput['title']    = trim($this->input->post('title'));
        $aInput['userid']   = trim($this->input->post('mb_id'));
        $aInput['name']     = trim($this->input->post('mb_name'));
        $aInput['content']  = strip_tags(trim($this->input->post('comment')));
        $aInput['indate']   = date('YmdHis');

        if(! $this->_chkJoinParam($aInput) )
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }

        edu_get_instance('BoardClass');
        if($aResult = BoardClass::saveBoard($aInput))
        {
            response_json(array('code'=> 1 , 'msg'=>'OK'));
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'Fail'));
        die;
    }

    private function _getMemberInfo()
    {
        edu_get_instance('CookieClass');
        if(! $sMemberInfo = CookieClass::getCookieInfo() ) return false;

        return (array)json_decode($sMemberInfo);
    }
    private function _chkJoinParam($aInput)
    {
        foreach($aInput as $key=>$val)
            if(!$val) return false;

        return true;
    }


}