<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=UTF-8');
header('Content-Type: application/x-www-form-urlencoded; charset=UTF-8');

$_ENV['RAINLOOP_INCLUDE_AS_API'] = true;
include 'config.inc.php';
include 'utils.php';

global $result;
$id = $_POST['id'];
$t = $_POST['t'];

$param = array(
  'sid'=>$id, 
);

$headers[] = 'Content-Type: application/json';
$headers[] = 'Cache-Control: no-cache';
$headers[] = "Authorization: $t";
$headers[] = 'X-HTTP-Method-Override: DELETE';

if (!empty($id)) {
  $url = $platformHost.'/platform/mailboxAccount/delete/'.$id;
  $res = httpClient($url, $param, 'DELETE', $headers, 10);
  echo $res;
}
exit;


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