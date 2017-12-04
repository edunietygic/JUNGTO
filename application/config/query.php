<?php
/*
    * data : ? bind data
    * btype : bind data type
    * null : null check data list (null을 허용하는값)
*/
$config['query'] = array(
    'account' => array(
        'getAccountInfo' => array(
            'query' => 'SELECT usn, account, accessToken, oauth, regdate
                          FROM account
                         WHERE account = ?'
            ,'data' => array('account')
            ,'btype'=> 's'
            ,'null' => array()
        )
        ,'setAccountInfo' => array(
            'query' => 'INSERT INTO account ( account, oauth, regdate , accessToken)
                        VALUES (?,?,?,?)'
            ,'data' => array('account', 'oauth', 'regdate', 'accessToken')
            ,'btype'=> 'ssss'
            ,'null' => array('accessToken')
        )
        ,'getMemInfo' => array(
            'query' => 'SELECT mb_id, mb_name, mb_email 
                          FROM edu_member 
                         WHERE trim(mb_id)= ?'
            ,'data' => array('mb_id')
            ,'btype'=> 's'
            ,'null' => array()
        )

    )
);
