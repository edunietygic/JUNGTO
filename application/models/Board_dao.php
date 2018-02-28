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
    public function getNoticeDetail($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getNoticeDetail'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getAttachFile($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getAttachFile'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getRecentReply($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getRecentReply'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getRecentContents($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getRecentContents'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getHotContents($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getHotContents'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function setBoardInfo($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['setBoardInfo'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getBoardList($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getBoardList'];
        return $this->actModelFuc($aConfig, $aParam);
    }

    public function getBoardDetail($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getBoardDetail'];
        return $this->actModelFuc($aConfig, $aParam);
    }
}
