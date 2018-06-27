<?php
$_ENV['RAINLOOP_INCLUDE_AS_API'] = true;
include 'config.inc.php';
include 'utils.php';

global $result;
$cryptU = $_GET['u'];
$u = base64_decode($_GET['u']);
$cryptPw = $_GET['p'];
$p = base64_decode($cryptPw);
$n = $_GET['n']*1;

$oActions = \RainLoop\Api::Actions();
$oAction = $oActions->LoginProcess($u, $p, '', '', false, true);
$oAccounts = $oActions->GetAccounts($oAction);
$unreadCount = $oActions->getAccountUnredCountFromHash($oAccounts[$u]);
$result['unreadCount'] = $unreadCount;

$oMail = $oActions->MailClient();
$list = $oMail->MessageList('INBOX', 0, $n);
$aList = $list->GetAsArray();

$result['briefs'] = array_map(function($msg){
  $aFrom = $msg->From()->ToArray();
  $datum['subject'] = $msg->Subject();
  $datum['headerDate'] = \date('Y-m-d h:i:s', \strtotime($msg->HeaderDate()));
  $datum['from'] = array(
    'displayName'=>$aFrom[0][0],
    'emailAddress'=>$aFrom[0][1]
  );
  return $datum;
}, $aList);

// echo $result;
$jsonResult = json_encode($result);
echo $jsonResult;

////////////////////////////////////////
//
// Fetch biref infomations of recently mails
// base Rainloop 1.12, by lgb 20180614 
//
// DONT DELETE THESE, THANK YOU !!
// $ssoHash = \RainLoop\Api::GetUserSsoHash($u, $p);
// $encrypt = \RainLoop\Utils::EncryptString('liugenbin@126.com', 'its my key');
// echo 'encrypt: '.$encrypt;
// echo '<br/>';

// $decrypt = \RainLoop\Utils::DecryptString($encryptUrl, $key);
// $decrypt = \RainLoop\Utils::DecryptString($encrypt, 'its my key');
// echo 'DecryptStringend: '.$decrypt;
// echo '<br/>';
//
// http://localhost/fetch-brief.php?u=完整邮箱名&p=邮箱密码&n=获取几条数据
////////////////////////////////////////