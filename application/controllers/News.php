<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $limit = 10; // row cnt
        $offset = 0;

        if($this->input->get('per_page')){
            $offset = ($this->input->get('per_page')-1) * $limit;
        }

        edu_get_instance('BoardClass');
        $sTotalCnt       = BoardClass::getNoticeListTotalCnt();
        $aLdata          = BoardClass::getNoticeList($limit, $offset);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();

        $sidebar_data = array(
             'aRecentReply'    => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $this->load->library('pagination');

        $config['base_url'] = HOSTURL.'/news';
        $config['total_rows'] = $sTotalCnt;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();

        $data = array(
             'container'    => 'news/index'
            ,'sidebar'      => $sidebar
            ,'pagination'   => $pagination
            ,'aLdata'       => $aLdata
        );

        $this->load->view('common/container', $data);
    }
    public function news_detail($seq=0)
    {
        edu_get_instance('BoardClass');

        BoardClass::updateNoticeCnt($seq);

        $aNoticeDetail = BoardClass::getNoticeDetail($seq);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        $aAttachFile    = BoardClass::getAttachFile($seq);

        $aPreData = $aNextData = (object) array();
        foreach ($aNoticeDetail as $key => $obj) {
            if($seq == $obj->seq){
                $aDetailData = $obj;
            }
            else if($seq > $obj->seq){
                $aPreData = (object) array('seq' => $obj->seq, 'title' => $obj->adtitle);
            }
            else if($seq < $obj->seq){
                $aNextData = (object) array('seq' => $obj->seq, 'title' => $obj->adtitle);
            }
        }

        $sidebar_data = array(
             'aRecentReply'    => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $data = array(
             'container'    => 'news/news_detail'
            ,'sidebar'      => $sidebar
            ,'aDetailData'  => $aDetailData
            ,'aPreData'     => $aPreData
            ,'aNextData'    => $aNextData
            ,'aAttachFile'  => $aAttachFile
        );

        $this->load->view('common/container', $data);
    }


}