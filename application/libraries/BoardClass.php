<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BoardClass {

    public function  __construct()
    {
    }
    public static function getNoticeListTotalCnt()
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getNoticeListTotalCnt();
    }
    public static function getNoticeList($limit=0, $offset=10)
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getNoticeList($limit, $offset);
    }
    public static function getNoticeDetail($seq=0)
    {
        if(!$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getNoticeDetail($seq);
    }
    public static function getAttachFile($seq=0)
    {
        if(!$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getAttachFile($seq);
    }
    public static function getRecentReply()
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getRecentReply();
    }
    public static function getRecentContents()
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getRecentContents();
    }
    public static function getHotContents()
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getHotContents();
    }
    public static function saveBoard($aInput=array())
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->setBoardInfo($aInput);
    }
    public static function saveBoardReply($aInput=array())
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->setBoardReply($aInput);
    }
    public static function getBoardListTotalCnt($tabseq=0)
    {
        if(!$tabseq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getBoardListTotalCnt($tabseq);
    }
    public static function getBoardList($tabseq=0, $limit=0, $offset=10)
    {
        if(!$tabseq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getBoardList($tabseq, $limit, $offset);
    }
    public static function getBoardDetail($tabseq=0, $seq=0)
    {
        if(!$tabseq || !$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getBoardDetail($tabseq, $seq);
    }
    public static function getReplyDetail($tabseq=0, $seq=0)
    {
        if(!$tabseq || !$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getReplyDetail($tabseq, $seq);
    }
    public static function updateNoticeCnt($seq=0)
    {
        if(!$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->updateNoticeCnt($seq);
    }
    public static function updateBoardCnt($tabseq=0, $seq=0)
    {
        if(!$tabseq || !$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->updateBoardCnt($tabseq, $seq);
    }
}
