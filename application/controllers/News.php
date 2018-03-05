<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        edu_get_instance('BoardClass');
        $aLdata          = BoardClass::getNoticeList();
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
             'container' => 'news/index'
            ,'sidebar'   => $sidebar
            ,'aLdata'    => $aLdata
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