<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BoardClass {

    public function  __construct()
    {
    }
    public static function getNoticeList()
    {
        $aResult = array();
        $aResult = self::_getNoticeList();

        return $aResult;
    }
    public static function getRecentReply()
    {
        $aResult = array();
        $aResult = self::_getRecentReply();

        return $aResult;
    }

    private static function _getNoticeList()
    {
        $board_model = edu_get_instance('board_model', 'model');

        return $board_model->getNoticeList();
    }
    private static function _getRecentReply()
    {
        $board_model = edu_get_instance('board_model', 'model');

        return $board_model->getRecentReply();
    }
}
