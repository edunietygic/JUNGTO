<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board_model extends CI_model{
    public function __construct()
    {
        $this->board_dao = edu_get_instance('Board_dao', 'model');
    }

    public function getNoticeListTotalCnt()
    {
        $aRtn = $this->board_dao->getNoticeListTotalCnt();

        return $aRtn[0]->cnt;
    }
    public function getNoticeList($limit, $offset)
    {
        $aNoticeInfo = $this->board_dao->getNoticeList($limit, $offset);

        if(isset($aNoticeInfo) && $aNoticeInfo)
        {
            foreach ($aNoticeInfo as $key => $obj) {
                $aNoticeInfo[$key]->summary = iconv_substr(strip_tags($obj->adcontent),0,176,'utf-8');
            }
        }
        else
        {
            $aNoticeInfo = array();
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
    public function getAttachFileBoard($tabseq=0,$seq=0)
    {
        if(!$tabseq|| !$seq) return false;
    	$aInput = array('tabseq' => $tabseq,'seq' => $seq);
        $aAttachFile = $this->board_dao->getAttachFileBoard($aInput);

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

    public function setBoardReply($aInput=array())
    {
        return $this->board_dao->setBoardReply($aInput);
    }
    public function getBoardListTotalCnt($tabseq=0)
    {
        if(!$tabseq) return false;
        $aInput = array('tabseq' => $tabseq);
        $aRtn = $this->board_dao->getBoardListTotalCnt($aInput);

        return $aRtn[0]->cnt;
    }
    public function getBoardList($tabseq=0, $limit, $offset)
    {
        if(!$tabseq) return false;
        $aInput = array('tabseq' => $tabseq);
        $aBoardInfo = $this->board_dao->getBoardList($aInput, $limit, $offset);

        if( is_array($aBoardInfo) ){
            foreach ($aBoardInfo as $key => $obj) {
                $aBoardInfo[$key]->summary = iconv_substr(strip_tags($obj->content),0,176,'utf-8').'...';
            }
        }

        return $aBoardInfo;
    }
    public function getBoardDetail($tabseq=0, $seq=0)
    {
        if(!$tabseq || !$seq) return false;
        $aInput = array('tabseq' => $tabseq, 'seq' => $seq);
        $aBoardDetail = $this->board_dao->getBoardDetail($aInput);

        return $aBoardDetail;
    }
    public function getReplyDetail($tabseq=0, $seq=0)
    {
        if(!$tabseq || !$seq) return false;
        $aInput = array('tabseq' => $tabseq, 'seq' => $seq);
        $aReplyDetail = $this->board_dao->getReplyDetail($aInput);

        return $aReplyDetail;
    }
    public function updateNoticeCnt($seq=0)
    {
        if(!$seq) return false;
        $aInput = array('seq' => $seq);
        return $this->board_dao->updateNoticeCnt($aInput);
    }
    public function updateBoardCnt($tabseq=0, $seq=0)
    {
        if(!$tabseq || !$seq) return false;
        $aInput = array('tabseq' => $tabseq, 'seq' => $seq);
        return $this->board_dao->updateBoardCnt($aInput);
    }
    public function getSEQ($idx=0)
    {
        if(!$idx) return false;
        $aInput = array('idx' => $idx);
        $aResult = $this->board_dao->getSEQ($aInput);
        return $aResult[0]->seq;
    }
    public function saveBoardFile($aInput)
    {
        return $this->board_dao->saveBoardFile($aInput);
    }
}
