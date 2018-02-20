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
    )
    ,'course' => array(
        'getCourseList' => array(
            'query' => 'SELECT subj, subjnm, subjnm2, subjclass, upperclass, middleclass, lowerclass, muserid, musertel, tutor, edudays, edutimes, place, studentlimit 
                          FROM lms_subj 
                         WHERE isonoff = ?'
            ,'data' => array('isonoff')
            ,'btype'=> 's'
            ,'null' => array()
        )
    )        
);
