<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board_model extends CI_model{
    public function __construct()
    {
        $this->board_dao = edu_get_instance('Board_dao', 'model');
    }

    public function getNoticeList()
    {
        $aNoticeInfo = $this->board_dao->getNoticeList();

        foreach ($aNoticeInfo as $key => $obj) {
            $aNoticeInfo[$key]->summary = iconv_substr(strip_tags($obj->adcontent),0,176,'utf-8');
        }

        return $aNoticeInfo;
    }
    public function getNoticeDetail($seq=0)
    {
    	if(!$seq) return false;
    	$aInput = array('seq' => $seq);
        $aNoticeDetail = $this->board_dao->getNoticeDetail($aInput);

        return $aNoticeDetail;
    }
    public function getAttachFile($seq=0)
    {
    	if(!$seq) return false;
    	$aInput = array('seq' => $seq);
        $aAttachFile = $this->board_dao->getAttachFile($aInput);

        return $aAttachFile;
    }
    public function getRecentReply()
    {
        $aRecentReply = $this->board_dao->getRecentReply();

        foreach ($aRecentReply as $key => $obj) {
            $aRecentReply[$key]->diffdate = datetimediff($obj->lastdate);
        }

        return $aRecentReply;
    }
    public function getRecentContents()
    {
        $aRecentContents = $this->board_dao->getRecentContents();

        foreach ($aRecentContents as $key => $obj) {
            $aRecentContents[$key]->diffdate = datetimediff($obj->indate);
        }

        return $aRecentContents;
    }
    public function getHotContents()
    {
        $aHotContents = $this->board_dao->getHotContents();

        foreach ($aHotContents as $key => $obj) {
            $aHotContents[$key]->diffdate = datetimediff($obj->indate);
        }

        return $aHotContents;
    }
}
