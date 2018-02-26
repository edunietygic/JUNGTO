<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MailClass {

    public function  __construct()
    {
    }
    public function sendMail($oAccInfo, $sPassword, $tmp_password)
    {
        $CI = & get_instance();

        $nameFrom  = "행복학교";
        $mailFrom = "admin@hihappyschool.com";
        $nameTo  = $oAccInfo->mb_name;
        $mailTo = $oAccInfo->mb_email;
        $cc = "";
        $bcc = "";

        $subject = "[행복학교] 임시비밀번호 발급";

        $data = array('name'=>$oAccInfo->mb_name, 'tmp_password'=>$sPassword);
        $content = $CI->load->view('common/mailTemplate', $data, true);

        $charset = "UTF-8";

        $nameFrom   = "=?$charset?B?".base64_encode($nameFrom)."?=";
        $nameTo   = "=?$charset?B?".base64_encode($nameTo)."?=";
        $subject = "=?$charset?B?".base64_encode($subject)."?=";

        $header  = "Content-Type: text/html; charset=utf-8\r\n";
        $header .= "MIME-Version: 1.0\r\n";

        $header .= "Return-Path: <". $mailFrom .">\r\n";
        $header .= "From: ". $nameFrom ." <". $mailFrom .">\r\n";
        $header .= "Reply-To: <". $mailFrom .">\r\n";
        if ($cc)  $header .= "Cc: ". $cc ."\r\n";
        if ($bcc) $header .= "Bcc: ". $bcc ."\r\n";

        $result = mail($mailTo, $subject, $content, $header, $mailFrom);
        return $result;
    }

}
