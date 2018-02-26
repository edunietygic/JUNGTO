<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board_model extends CI_model{
    public function __construct()
    {
        $this->board_dao = edu_get_instance('board_dao', 'model');
    }

    public function getNoticeList()
    {
        $aNoticeInfo = $this->board_dao->getNoticeList();

        return $aNoticeInfo;
    }
    public function getRecentReply()
    {
        $aRecentReply = $this->board_dao->getRecentReply();

        return $aRecentReply;
    }
}
