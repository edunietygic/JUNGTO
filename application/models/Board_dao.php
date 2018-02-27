<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'models/Common_dao.php');

class Board_dao extends Common_dao
{
    public function __construct()
    {
        $this->db = $this->load->database('dev', TRUE);

        $aQueryInfo = edu_get_config('query', 'query');
        $this->queryInfoBoard = $aQueryInfo['board'];
    }

    public function getNoticeList($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getNoticeList'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getRecentReply($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getRecentReply'];
        return $this->actModelFuc($aConfig, $aParam);
    }
}
