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

        if(is_array($aRecentReply)){
            foreach ($aRecentReply as $key => $obj) {
                $aRecentReply[$key]->diffdate = datetimediff($obj->indate);
            }
        }

        return $aRecentReply;
    }
    public function getRecentContents()
    {
        $aRecentContents = $this->board_dao->getRecentContents();

        if(is_array($aRecentContents)){
            foreach ($aRecentContents as $key => $obj) {
                $aRecentContents[$key]->diffdate = datetimediff($obj->indate);
            }
        }

        return $aRecentContents;
    }
    public function getHotContents()
    {
        $aHotContents = $this->board_dao->getHotContents();

        if(is_array($aHotContents)){
            foreach ($aHotContents as $key => $obj) {
                $aHotContents[$key]->diffdate = datetimediff($obj->indate);
            }
        }

        return $aHotContents;
    }
    public function setBoardInfo($aInput=array())
    {
        return $this->board_dao->setBoardInfo($aInput);
    }
    public function getBoardList($tabseq=0)
    {
        if(!$tabseq) return false;
        $aInput = array('tabseq' => $tabseq);
        $aBoardInfo = $this->board_dao->getBoardList($aInput);

        if( is_array($aBoardInfo) ){
            foreach ($aBoardInfo as $key => $obj) {
                $aBoardInfo[$key]->summary = iconv_substr(strip_tags($obj->content),0,176,'utf-8').'...';
            }
        }

        return $aBoardInfo;
    }
    public function getBoardDetail($tabseq=0, $seq=0)
    {
        if(!$tabseq) return false;
        $aInput = array('tabseq' => $tabseq, 'seq' => $seq);
        $aBoardDetail = $this->board_dao->getBoardDetail($aInput);

        return $aBoardDetail;
    }
}
