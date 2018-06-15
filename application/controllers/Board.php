<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $aBbsInfo = edu_get_config('bbs', 'jungto');
        $this->board = $aBbsInfo[$this->uri->segment(2)];
    }

    public function camp()
    {
        if( $this->uri->segment(3) ){
            $this->{$this->uri->segment(3)}($this->uri->segment(4));
        }
        else {
            $this->index();
        }
    }
    // public function lecture()
    // {
    //     if( $this->uri->segment(3) ){
    //         $this->{$this->uri->segment(3)}($this->uri->segment(4));
    //     }
    //     else {
    //         $this->index();
    //     }
    // }
    public function review()
    {
        if( $this->uri->segment(3) ){
            $this->{$this->uri->segment(3)}($this->uri->segment(4));
        }
        else {
            $this->index();
        }
    }

    public function index()
    {
        $aMemberInfo = $this->_getMemberInfo();

        $limit = 10; // row cnt
        $offset = 0;

        if($this->input->get('per_page')){
            $offset = ($this->input->get('per_page')-1) * $limit;
        }

        edu_get_instance('BoardClass');
        $sTotalCnt       = BoardClass::getBoardListTotalCnt($this->board['tabseq']);
        $aLdata          = BoardClass::getBoardList($this->board['tabseq'], $limit, $offset);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        // $aAttachFile    = BoardClass::getAttachFile($seq);

        $sidebar_data = array(
            'aRecentReply'     => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $this->load->library('pagination');

        $config['base_url'] = HOSTURL.'/board/'.$this->uri->segment(2);
        $config['total_rows'] = $sTotalCnt;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();

        $data = array(
            'container'     => 'board/index'
            ,'aBoardInfo'   => $this->board
            ,'sidebar'      => $sidebar
            ,'aMemberInfo'  => $aMemberInfo
            ,'pagination'   => $pagination
            ,'aLdata'       => $aLdata
        );

        $this->load->view('common/container', $data);
    }

    public function board_write()
    {
        if(! $aMemberInfo = $this->_getMemberInfo())
        {
            alert('로그인이 필요합니다', HOSTURL.'/main');
        }
        else
        {
            edu_get_instance('BoardClass');
            $aRecentReply    = BoardClass::getRecentReply();
            $aRecentContents = BoardClass::getRecentContents();
            $aHotContents    = BoardClass::getHotContents();

            $sidebar_data = array(
                 'aRecentReply'    => $aRecentReply
                ,'aRecentContents' => $aRecentContents
                ,'aHotContents'    => $aHotContents
            );
            $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

            $data = array(
                 'container'    => 'board/board_write'
                ,'aBoardInfo'    => $this->board
                ,'sidebar'      => $sidebar
                ,'aMemberInfo'  => $aMemberInfo
            );

            $this->load->view('common/container', $data);
        }
    }

    public function board_detail($seq=0)
    {
        $aMemberInfo = $this->_getMemberInfo();

        edu_get_instance('BoardClass');

        BoardClass::updateBoardCnt($this->board['tabseq'], $seq);

        $aBoardDetail    = BoardClass::getBoardDetail($this->board['tabseq'], $seq);
        $aReplyDetail    = BoardClass::getReplyDetail($this->board['tabseq'], $seq);
        $aRecentReply    = BoardClass::getRecentReply();
        $aRecentContents = BoardClass::getRecentContents();
        $aHotContents    = BoardClass::getHotContents();
        $aAttachFile     = BoardClass::getAttachFileBoard($this->board['tabseq'],$seq);
        echo "<!--";
        print_r($aAttachFile);
        echo "-->";

        $aPreData = $aNextData = (object) array();
        if(is_array($aBoardDetail)){
            foreach ($aBoardDetail as $key => $obj) {
                if($seq == $obj->seq){
                    $aDetailData = $obj;
                }
                else if($seq > $obj->seq){
                    $aPreData = (object) array('seq' => $obj->seq, 'title' => $obj->title);
                }
                else if($seq < $obj->seq){
                    $aNextData = (object) array('seq' => $obj->seq, 'title' => $obj->title);
                }
            }
        }

        $sidebar_data = array(
             'aRecentReply'    => $aRecentReply
            ,'aRecentContents' => $aRecentContents
            ,'aHotContents'    => $aHotContents
        );
        $sidebar = $this->load->view('common/sidebar', $sidebar_data, true);

        $data = array(
             'container'      => 'board/board_detail'
            ,'sidebar'        => $sidebar
            ,'tabseq'         => $this->board['tabseq']
            ,'seq'            => $seq
            ,'aMemberInfo'    => $aMemberInfo
            ,'aDetailData'    => $aDetailData
            ,'aReplyDetail'   => $aReplyDetail
            ,'aPreData'       => $aPreData
            ,'aNextData'      => $aNextData
            ,'aAttachFile'    => $aAttachFile 
        );

        $this->load->view('common/container', $data);
    }
    
    public function get_safe_filename($name)
    {
        $pattern = '/["\'<>=#&!%\\\\(\)\*\+\?]/';
        $name = preg_replace($pattern, '', $name);
    
        return $name;
    }
    public function att_file_upload($FILES, $_fname, $_dir, $_ftype="img", $_savename="")
    {
        $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
        $upload_max_filesize = ini_get('upload_max_filesize');    // php.ini에서 설정.  /usr/local/lib/php.ini vi 편집기로 수정해야 함....edulee 
        $return_val = array();
        $return_val['val'] = "";
        $return_val['msg'] = "";
        $return_val['file'] = "";
        
        (string)$filename = "";

        $tmp_file      = $FILES[$_fname]['tmp_name'];
        $filesize      = $FILES[$_fname]['size'];
        $rel_filename  = $FILES[$_fname]['name'];
    
        // 파일이름에 사용불가 문자 제거
        if( !empty($rel_filename) ) $filename = $this->get_safe_filename($rel_filename);
        
        // with@ : Request 된 파일이 존재하면... 업로드 처리
        if( $tmp_file != "" && $filesize > 0 )
        {
            if($filename == "")
            {
                $return_val['val'] = "warning";
                $return_val['msg'] = "파일명이 사용할 수 없는 문자열로만 이루어져 있습니다.";	
            }
            else
            {
                // 업로드시 에러 검증
                if ($FILES[$_fname]['error'] == 1 || $FILES[$_fname]['error'] == 2)
                {
                    $return_val['val'] = "error";
                    $return_val['msg'] = '\"'.$rel_filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
                }
                else if ($FILES[$_fname]['error'] != 0)
                {
                    $return_val['val'] = "error";
                    $return_val['msg'] = '\"'.$rel_filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
                }
                else // 에러가 존재하지 않으면 업로드 처리
                {
                    // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
                    if( $_ftype == "img" )
                    {
                        $timg = @getimagesize($tmp_file);   // 이 함수는 이미지의 크기나 타입에 대한 정보를 출력해 주는 함수로 7개의 엘레먼트를 배열로 제공
                        
                        // image type 검증
                        if ($timg[2] < 1 || $timg[2] > 17) 
                        {
                            $return_val['val'] = "error";
                            $return_val['msg'] = '\"'.$rel_filename.'\" 파일이 보안검증을 통해 정상적으로 업로드 되지 않았습니다\\n';
                        }
                    }
                    else if ( $_ftype == "zip" )
                    {
                        if(preg_match("/.zip$/i", $filename)===FALSE)
                        {
                            $return_val['val'] = "error";
                            $return_val['msg'] = 'zip 압축 파일만 업로드가 가능합니다\\n';
                        }
                    }
                    
                    // 지금까지 에러가 없으면, 업로드 실행
                    if( $return_val['val'] != "error" )
                    {
                        if(!is_dir($_dir)) {
                            @mkdir($_dir, 0755);
                            @chmod($_dir, 0755);
                        }
                        
                        if (is_uploaded_file($tmp_file)) 
                        {
                            $upload = array();
                                            
                            // 프로그램 원래 파일명
                            $upload['source'] = $filename;
                            $upload['filesize'] = $filesize;
                        
                            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
                            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
                        
                            if(!$_savename)
                            {
                                shuffle($chars_array);
                                $shuffle = implode('', $chars_array);

                                $real_remote_addr = $_SERVER['REMOTE_ADDR'];  
                                // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다.
                                $upload['file'] = abs(ip2long($real_remote_addr)).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename)));
                            }
                            else
                            {
                                $upload['file'] = $_savename;
                            }	
                            
                            $dest_file = $_dir.'/'.$upload['file'];
                        
                            $error_code = move_uploaded_file($tmp_file, $dest_file);
                            if( $error_code===TRUE )
                            {
                                // 올라간 파일의 퍼미션을 변경합니다.
                                chmod($dest_file, 0644);
                                
                                $return_val['val'] = "okok";
                                $return_val['msg'] = "업로드를 완료하였습니다.";
                                $return_val['file'] = $upload['file'];
                            }
                            else
                            {
                                $return_val['val'] = "error";
                                $return_val['msg'] = "파일을 업로드하지 못 했습니다.";
                            }
                        }
                    }
                    
                }
            }
        }
        else
        {
            $return_val['val'] = "warning";
            $return_val['msg'] = "첨부된 파일이 없습니다.";
        }
    
        return $return_val;
    }
    public function rpcSaveBoard()
    {
        $aInput = array();
        $aInput['tabseq']   = trim($this->input->post('tabseq'));
        $aInput['title']    = trim($this->input->post('title'));
        $aInput['userid']   = trim($this->input->post('mb_id'));
        $aInput['name']     = trim($this->input->post('mb_name'));
        $aInput['content']  = strip_tags(trim($this->input->post('comment')));
        $aInput['indate']   = date('YmdHis');

        if(! $this->_chkJoinParam($aInput) )
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }

        edu_get_instance('BoardClass');
        if($idx = BoardClass::saveBoard($aInput))
        {
            $seq = BoardClass::getSEQ($idx);
            response_json(array('code'=> 1 , 'msg'=>'등록되었습니다.'));
            
            
            $lms_file_dir = '/home/eduniety/jungto/dp/bulletin/';  // 첨부파일 위치
            if ($_FILES['file']['name']) 
            {
                $rt_up_info = $this->att_file_upload($_FILES, 'file', $lms_file_dir, '');
                if( $rt_up_info['val'] == "okok" ) 
                {
                    $aFileInfo = array(
                         'tabseq' => $aInput['tabseq']
                        ,'seq' => $seq
                        ,'fileseq' => 1 
                        ,'realfile' => $_FILES['file']['name'] 
                        ,'savefile' => $rt_up_info['file']  
                        ,'luserid' => $aInput['userid']  
                        ,'ldate' => date('YmdHis')  
                    );
                    BoardClass::saveBoardFile($aFileInfo);
                }
            } 
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'Fail'));
        die;
    }

    public function rpcSaveBoardReply()
    {
        $aInput = array();
        $aInput['tabseq']   = trim($this->input->post('tabseq'));
        $aInput['refseq']   = trim($this->input->post('refseq'));
        $aInput['title']    = trim($this->input->post('title'));
        $aInput['userid']   = trim($this->input->post('mb_id'));
        $aInput['name']     = trim($this->input->post('mb_name'));
        $aInput['content']  = strip_tags(trim($this->input->post('comment')));
        $aInput['indate']   = date('YmdHis');

        if(! $this->_chkJoinParam($aInput) )
        {
            response_json(array('code'=> 99 , 'msg'=>'Fail'));
            die;
        }

        edu_get_instance('BoardClass');
        if($aResult = BoardClass::saveBoardReply($aInput))
        {
            response_json(array('code'=> 1 , 'msg'=>'등록되었습니다.'));
            die;
        }

        response_json(array('code'=> 99 , 'msg'=>'Fail'));
        die;
    }

    private function _getMemberInfo()
    {
        edu_get_instance('CookieClass');
        if(! $sMemberInfo = CookieClass::getCookieInfo() ) return false;

        return (array)json_decode($sMemberInfo);
    }
    private function _chkJoinParam($aInput)
    {
        foreach($aInput as $key=>$val)
            if(!$val) return false;

        return true;
    }


}
