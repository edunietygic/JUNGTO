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
    public function getNoticeListTotalCnt($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getNoticeListTotalCnt'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getNoticeList($limit=0, $offset=10)
    {
        $this->db->select('a.seq, a.addate, a.adtitle, a.adname, a.cnt, a.luserid, a.ldate, a.isall, a.useyn, a.popup, a.loginyn, a.gubun, a.aduserid, a.type, a.notice_gubun, a.adcontent, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt');
        $this->db->from('lms_notice a');

        $this->db->where('a.tabseq', "11");

        $this->db->order_by('a.seq', 'DESC');

        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        // echo $this->db->last_query();

        return $query->result();
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
    public function setBoardReply($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['setBoardReply'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getBoardListTotalCnt($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getBoardListTotalCnt'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    // public function getBoardList($aParam=array())
    // {
    //     $aConfig = $this->queryInfoBoard['getBoardList'];
    //     return $this->actModelFuc($aConfig, $aParam);
    // }
    public function getBoardList($aParam=array(), $limit=0, $offset=10)
    {
        $this->db->select('a.seq, a.title, a.userid, a.name, a.content, a.indate, a.cnt, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt');
        $this->db->from('lms_board a');

        if($aParam['tabseq']){
            $this->db->where('a.tabseq', $aParam['tabseq']);
        }

        $where = 'a.seq = a.refseq';
        $this->db->where($where);

        $this->db->order_by('a.seq', 'DESC');

        $this->db->limit($limit, $offset);
        // echo $this->db->last_query();
        $query = $this->db->get();

        return $query->result();
    }
    public function getBoardDetail($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getBoardDetail'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function getReplyDetail($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['getReplyDetail'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function updateNoticeCnt($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['updateNoticeCnt'];
        return $this->actModelFuc($aConfig, $aParam);
    }
    public function updateBoardCnt($aParam=array())
    {
        $aConfig = $this->queryInfoBoard['updateBoardCnt'];
        return $this->actModelFuc($aConfig, $aParam);
    }
}
