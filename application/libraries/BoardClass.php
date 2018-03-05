<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BoardClass {

    public function  __construct()
    {
    }
    public static function getNoticeList()
    {
        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getNoticeList();
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
    public static function getBoardList($tabseq=0)
    {
        if(!$tabseq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getBoardList($tabseq);
    }
    public static function getBoardDetail($tabseq=0, $seq=0)
    {
        if(!$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getBoardDetail($tabseq, $seq);
    }

    public static function getReplyDetail($tabseq=0, $seq=0)
    {
        if(!$seq) return false;

        $board_model = edu_get_instance('Board_model', 'model');

        return $board_model->getReplyDetail($tabseq, $seq);
    }

}
