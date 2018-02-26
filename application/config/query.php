<?php
/*
    * data : ? bind data
    * btype : bind data type
    * null : null check data list (null을 허용하는값)
*/
$config['query'] = array(
    'account' => array(
        'getAccountInfo' => array(
            'query' => 'SELECT *
                          FROM edu_member
                         WHERE trim(mb_id) = ?'
            ,'data' => array('mb_id')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'setAccountInfo' => array(
            'query' => 'INSERT INTO edu_member( mb_id, mb_password, mb_name, mb_email, mb_hp, mb_join_date)
                        VALUES (?,?,?,?,?,?)'
            ,'data' => array('mb_id', 'mb_password', 'mb_name', 'mb_email', 'mb_hp', 'mb_join_date')
            ,'btype'=> 'ssssss'
            ,'null' => array()
        )
        ,'mkpwdquery1' => array(
            'query' => 'replace into edu_gtmp (gk,gv,gw) values (md5(?),?,? )'
            ,'data' => array('mid2', 'out', 'out1')
            ,'btype'=> 'sss'
            ,'null' => array()
        )
        ,'mkpwdquery2' => array(
            'query' => 'select gv, gw from edu_gtmp where gk = md5(?)'
            ,'data' => array('mid2')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'findAccountId' => array(
            'query' => 'SELECT mb_id
                          FROM edu_member
                         WHERE trim(mb_name) = ?
                           AND ( trim(mb_email) = ? OR trim(mb_hp) = ? )'
            ,'data' => array('mb_name','mb_email','mb_hp')
            ,'btype'=> 'sss'
            ,'null' => array()
        )
        ,'findAccountPw' => array(
            'query' => 'SELECT mb_id, mb_name, mb_email
                          FROM edu_member
                         WHERE trim(mb_id) = ?
                           AND trim(mb_email) = ?'
            ,'data' => array('mb_id','mb_email')
            ,'btype'=> 'ss'
            ,'null' => array()
        )
        ,'changeAccountPw' => array(
            'query' => 'UPDATE edu_member
                           SET mb_password = ?
                         WHERE trim(mb_id) = ?
                           AND trim(mb_email) = ?'
            ,'data' => array('tmp_password','mb_id', 'mb_email')
            ,'btype'=> 'sss'
            ,'null' => array()
        )
    )
    ,'course' => array(
        'getCourseList' => array(
            'query' => 'SELECT subj, subjnm, subjnm2, subjclass, upperclass, middleclass, lowerclass, muserid, musertel, tutor, edudays, edutimes, place, studentlimit, open_date, close_date, start_date, end_date, eduoutline, edupreparation , `explain`, edumans, memo 
                          FROM lms_subj
                         WHERE isonoff = ?'
            ,'data' => array('isonoff')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'getCourseListAddrcode' => array(
            'query' => 'SELECT subj, subjnm, subjnm2, subjclass, upperclass, middleclass, lowerclass, muserid, musertel, tutor, edudays, edutimes, place, studentlimit, open_date, close_date, start_date, end_date, eduoutline, edupreparation , `explain`, edumans, memo
                          FROM lms_subj
                         WHERE isonoff = ?
                           AND addrcode = ?'
            ,'data' => array('isonoff', 'addrcode')
            ,'btype'=> 's'
            ,'null' => array()
         )
         ,'getMyCourseList' => array(
            'query' => 'SELECT s.subj, s.subjnm, s.subjnm2, s.subjclass, s.upperclass, s.middleclass, s.lowerclass, s.muserid, s.musertel, s.tutor, s.edudays, s.edutimes, s.place, s.studentlimit
                               , a.mb_id, a.state, a.regdate
                          FROM lms_subj s, lms_subj_applicant a
                         WHERE s.subj = a.subj
                           AND a.mb_id = ?'
            ,'data' => array('mb_id')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'getUserListFromCourse' => array(
            'query' => 'SELECT subj, mb_id, state, regdate
                          FROM lms_subj_applicant
                         WHERE subj = ?'
            ,'data' => array('subj')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'setReqCourseUser' => array(
            'query' => 'INSERT INTO lms_subj_applicant(subj, mb_id, state, regdate)
                        VALUES (?,?,?,?)'
            ,'data' => array('subj', 'mb_id', 'state', 'regdate')
            ,'btype'=> 'ssss'
            ,'null' => array()
        )
    )
    ,'board' => array(
        'getNoticeList' => array(
            'query' => 'SELECT a.seq, a.addate, a.adtitle, a.adname, a.cnt, a.luserid, a.ldate, a.isall, a.useyn, a.popup, a.loginyn, a.gubun, a.aduserid, a.type, a.notice_gubun, a.adcontent, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt
                        FROM lms_notice a
                        WHERE isall = "Y" and tabseq = "11"
                        order by seq desc
                        limit 5'
            ,'data' => array('')
            ,'btype'=> ''
            ,'null' => array()
         )
    )
);
