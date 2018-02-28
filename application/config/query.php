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
        ,'getAccountInfoKeyToggler' => array(
            'query' => 'SELECT mb_name, mb_hp
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
        ,'updateMemberInfo' => array(
            'query' => 'UPDATE edu_member
                           SET mb_email = ?
                              ,mb_hp = ?
                         WHERE trim(mb_id) = ?'
            ,'data' => array('mb_email','mb_hp','mb_id')
            ,'btype'=> 'sss'
            ,'null' => array()
        )
        ,'deleteMemberInfo' => array(
            'query' => 'DELETE from edu_member
                         WHERE mb_id = ?'
            ,'data' => array('mb_id')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'deleteSubjApplicant' => array(
            'query' => 'DELETE from lms_subj_applicant
                         WHERE mb_id = ?'
            ,'data' => array('mb_id')
            ,'btype'=> 's'
            ,'null' => array()
        )
    )
    ,'course' => array(
        'getCourseList' => array(
            'query' => 'SELECT subj, subjnm, subjnm2, subjclass, upperclass, middleclass, lowerclass, muserid, musertel, tutor, edudays, edutimes, place, studentlimit, open_date, close_date, start_date, end_date, eduoutline, edupreparation , `explain`, edumans, memo, addrcode, addrstring, introducefilenamenew3 as img
                          FROM lms_subj
                         WHERE isonoff = ?'
            ,'data' => array('isonoff')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'getDetailCourse' => array(
            'query' => 'SELECT subj, subjnm, subjnm2, subjclass, upperclass, middleclass, lowerclass, muserid, musertel, tutor, edudays, edutimes, place, studentlimit, open_date, close_date, start_date, end_date, eduoutline, edupreparation , `explain`, edumans, memo, addrcode, addrstring, introducefilenamenew3 as img, class_num
                          FROM lms_subj
                         WHERE subj = ?'
            ,'data' => array('subj')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'getCourseListAddrcode' => array(
            'query' => 'SELECT subj, subjnm, subjnm2, subjclass, upperclass, middleclass, lowerclass, muserid, musertel, tutor, edudays, edutimes, place, studentlimit, open_date, close_date, start_date, end_date, eduoutline, edupreparation , `explain`, edumans, memo, introducefilenamenew3 as img
                          FROM lms_subj
                         WHERE isonoff = ?
                           AND addrcode = ?'
            ,'data' => array('isonoff', 'addrcode')
            ,'btype'=> 's'
            ,'null' => array()
         )
         ,'getMyCourseList' => array(
            'query' => 'SELECT s.subj, s.subjnm, s.subjnm2, s.subjclass, s.upperclass, s.middleclass, s.lowerclass, s.muserid, s.musertel, s.tutor, s.edudays, s.edutimes, s.place, s.studentlimit, s.open_date, s.close_date, s.start_date, s.end_date, s.tutor, s.addrcode, s.addrstring, introducefilenamenew3 as img
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
            'query' => 'INSERT INTO lms_subj_applicant(subj, mb_id, state, class_idx, regdate)
                        VALUES (?,?,?,?,?)'
            ,'data' => array('subj', 'mb_id', 'state', 'class_idx', 'regdate')
            ,'btype'=> 'sssss'
            ,'null' => array()
        )
    )
    ,'board' => array(
        'getNoticeList' => array(
            'query' => 'SELECT a.seq, a.addate, a.adtitle, a.adname, a.cnt, a.luserid, a.ldate, a.isall, a.useyn, a.popup, a.loginyn, a.gubun, a.aduserid, a.type, a.notice_gubun, a.adcontent, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt
                        FROM lms_notice a
                        WHERE tabseq = "11"
                        ORDER BY seq DESC
                        LIMIT 10'
            ,'data' => array('')
            ,'btype'=> ''
            ,'null' => array()
         )
        // 'getNoticeList' => array(
        //     'query' => 'SELECT n.seq, n.addate, n.adtitle, n.adname, n.cnt, n.luserid, n.ldate, n.isall, n.useyn, n.popup, n.loginyn, n.gubun, n.aduserid, n.type, n.notice_gubun, n.adcontent, COUNT(bf.realfile) filecnt, bf.savefile
        //                 FROM lms_notice n
        //                 LEFT JOIN lms_boardfile bf
        //                        ON (bf.tabseq = n.tabseq AND bf.seq = n.seq)
        //                 WHERE n.tabseq = "11"
        //                 ORDER BY n.seq DESC
        //                 LIMIT 10'
        //     ,'data' => array('')
        //     ,'btype'=> ''
        //     ,'null' => array()
        //  )
        ,'getNoticeDetail' => array(
            'query' => 'SELECT a.seq, a.addate, a.adtitle, a.adname, a.cnt, a.luserid, a.ldate, a.isall, a.useyn, a.popup, a.loginyn, a.gubun, a.aduserid, a.type, a.notice_gubun, a.adcontent, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt
                        FROM lms_notice a
                        WHERE tabseq = "11"
                          AND seq in ( ? , (SELECT seq  FROM lms_notice WHERE seq < ?  ORDER BY seq DESC LIMIT 1), (SELECT seq  FROM lms_notice WHERE seq > ?  ORDER BY seq LIMIT 1) )'
            ,'data' => array('seq','seq','seq')
            ,'btype'=> 'iii'
            ,'null' => array()
         )
        ,'getAttachFile' => array(
            'query' => 'SELECT fileseq, realfile, savefile
                        FROM lms_boardfile
                        WHERE tabseq = "11"
                          AND seq = ?'
            ,'data' => array('seq')
            ,'btype'=> 'i'
            ,'null' => array()
         )
        ,'getRecentReply' => array(
            'query' => 'SELECT bc.idx, bc.tabseq, bc.seq, bc.comment, bc.luser, bc.lastdate, m.mb_name
                          FROM lms_board_comment bc
                     LEFT JOIN edu_member m
                            ON m.mb_id=bc.luser
                         WHERE tabseq IN ("100","200","300")
                         ORDER BY idx DESC
                         LIMIT 3'
            ,'data' => array('')
            ,'btype'=> ''
            ,'null' => array()
         )
        ,'getRecentContents' => array(
            'query' => 'SELECT idx, tabseq, seq, title, userid, name, content, indate, refseq, refidx, levels, position, upfile, cnt, luserid, ldate, cpseq, gadmin, isopen, sangdam_gubun, isimport, recomcnt, email, origin_userid, edustart, eduend, prov, goodcnt, headnotice, except
                          FROM lms_board
                         WHERE tabseq IN ("100","200","300")
                         ORDER BY idx DESC
                         LIMIT 3'
            ,'data' => array('')
            ,'btype'=> ''
            ,'null' => array()
         )
        ,'getHotContents' => array(
            'query' => 'SELECT idx, tabseq, seq, title, userid, name, content, indate, refseq, refidx, levels, position, upfile, cnt, luserid, ldate, cpseq, gadmin, isopen, sangdam_gubun, isimport, recomcnt, email, origin_userid, edustart, eduend, prov, goodcnt, headnotice, except
                          FROM lms_board
                         WHERE tabseq IN ("100","200","300")
                         ORDER BY cnt DESC
                         LIMIT 3'
            ,'data' => array('')
            ,'btype'=> ''
            ,'null' => array()
         )
        ,'setBoardInfo' => array(
            'query' => 'INSERT INTO lms_board(tabseq, title, userid, name, content, indate, seq)
                        SELECT ?,?,?,?,?,?, IFNULL(max(seq)+1,1) next_seq FROM lms_board WHERE tabseq=? ORDER BY seq DESC LIMIT 1'
            ,'data' => array('tabseq', 'title', 'userid', 'name', 'content', 'indate', 'tabseq')
            ,'btype'=> 'isssssi'
            ,'null' => array()
         )
        ,'getBoardList' => array(
            'query' => 'SELECT a.seq, a.title, a.userid, a.name, a.content, a.indate, a.cnt, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt
                        FROM lms_board a
                        WHERE tabseq = ?
                        ORDER BY seq DESC
                        LIMIT 10'
            ,'data' => array('tabseq')
            ,'btype'=> 'i'
            ,'null' => array()
         )
        ,'getBoardDetail' => array(
            'query' => 'SELECT a.seq, a.title, a.userid, a.name, a.content, a.indate, a.cnt, (SELECT count(realfile) FROM lms_boardfile WHERE tabseq = a.TABSEQ AND seq = a.seq) filecnt
                        FROM lms_board a
                        WHERE tabseq = ?
                          AND seq in ( ? , (SELECT seq  FROM lms_board WHERE seq < ?  ORDER BY seq DESC LIMIT 1), (SELECT seq  FROM lms_board WHERE seq > ?  ORDER BY seq LIMIT 1) )'
            ,'data' => array('tabseq','seq','seq','seq')
            ,'btype'=> 'iiii'
            ,'null' => array()
         )
    )
);
