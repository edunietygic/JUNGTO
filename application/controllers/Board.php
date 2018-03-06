<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $aBbsInfo = edu_get_config('bbs', 'jungto');
        $this->board = $aBbsInfo[$this->uri->segment(2)];
    }

    public function camp()
    {
        if( $this->uri->segment(3) ){
            $this->{$this->uri->segment(3)}($this->uri->segment(4));
        }
        else {
            $this->index();
        }
    }
    public function lecture()
    {
        if( $this->uri->segment(3) ){
            $this->{$this->uri->segment(3)}($this->uri->segment(4));
        }
        else {
            $this->index();
        }
    }
    public function review()
    {
        if( $this->uri->segment(3) ){
            $this->{$this->uri->segment(3)}($this->uri->segment(4));
        }
        else {
            $this->index();
        }
    }

    public function index()
    {
        $aMemberInfo = $this->_getMemberInfo();

        $limit = 10; // row cnt
        $offset = 0;

        if($this->input->get('per_page')){
            $offset = ($this->input->get('per_page')-1) * $limit;
        }

        edu_get_instance('BoardClass');
        $sTotalCnt       = BoardClass::getBoardListTotalCnt($this->board['tabseq']);
        $aLdata          = BoardClass::getBoardList($this->board['tabseq'], $limit, $offset);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        // $aAttachFile    = BoardClass::getAttachFile($seq);

        $sidebar_data = array(
            'aRecentReply'     => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $this->load->library('pagination');

        $config['base_url'] = HOSTURL.'/board/'.$this->uri->segment(2);
        $config['total_rows'] = $sTotalCnt;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();

        $data = array(
            'container'     => 'board/index'
            ,'aBoardInfo'   => $this->board
            ,'sidebar'      => $sidebar
            ,'aMemberInfo'  => $aMemberInfo
            ,'pagination'   => $pagination
            ,'aLdata'       => $aLdata
        );

        $this->load->view('common/container', $data);
    }

    public function board_write()
    {
        if(! $aMemberInfo = $this->_getMemberInfo())
        {
            alert('로그인이 필요합니다', HOSTURL.'/main');
        }
        else
        {
            edu_get_instance('BoardClass');
            $aRecentReply    = BoardClass::getRecentReply();
            $aRecentContents = BoardClass::getRecentContents();
            $aHotContents    = BoardClass::getHotContents();

            $sidebar_data = array(
                 'aRecentReply'    => $aRecentReply
                ,'aRecentContents' => $aRecentContents
                ,'aHotContents'    => $aHotContents
            );
            $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

            $data = array(
                 'container'    => 'board/board_write'
                ,'aBoardInfo'    => $this->board
                ,'sidebar'      => $sidebar
                ,'aMemberInfo'  => $aMemberInfo
            );

            $this->load->view('common/container', $data);
        }
    }

    public function board_detail($seq=0)
    {
        $aMemberInfo = $this->_getMemberInfo();

        edu_get_instance('BoardClass');

        BoardClass::updateBoardCnt($this->board['tabseq'], $seq);

        $aBoardDetail    = BoardClass::getBoardDetail($this->board['tabseq'], $seq);
        $aReplyDetail    = BoardClass::getReplyDetail($this->board['tabseq'], $seq);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        // $aAttachFile     = BoardClass::getAttachFile($seq);
        $aAttachFile     = array();

        $aPreData = $aNextData = (object) array();
        if(is_array($aBoardDetail)){
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
        }

        $sidebar_data = array(
             'aRecentReply'    => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $data = array(
             'container'      => 'board/board_detail'
            ,'sidebar'        => $sidebar
            ,'tabseq'         => $this->board['tabseq']
            ,'seq'            => $seq
            ,'aMemberInfo'    => $aMemberInfo
            ,'aDetailData'    => $aDetailData
            ,'aReplyDetail'   => $aReplyDetail
            ,'aPreData'       => $aPreData
            ,'aNextData'      => $aNextData
            ,'aAttachFile'    => $aAttachFile
        );

        $this->load->view('common/container', $data);
    }

    public function rpcSaveBoard()
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
            response_json(array('code'=> 1 , 'msg'=>'등록되었습니다.'));
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'Fail'));
        die;
    }

    public function rpcSaveBoardReply()
    {
        $aInput = array();
        $aInput['tabseq']   = trim($this->input->post('tabseq'));
        $aInput['refseq']   = trim($this->input->post('refseq'));
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
        if($aResult = BoardClass::saveBoardReply($aInput))
        {
            response_json(array('code'=> 1 , 'msg'=>'등록되었습니다.'));
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