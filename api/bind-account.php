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
$u = $_POST['u'];
$p = $_POST['p'];
$aes = new AESMcrypt($AES['bit'], $AES['key'], $AES['iv'], $AES['mode']);
$encryptP = $aes->encrypt($p);
$id = $_POST['id'];
$t = $_POST['t'];
$MAIL_TYPE = array(
  'PRIVATE' => 1,
  'ENTERPRISE' => 2
);

$param = array(
  'account'=>$u, 
  'password'=>$encryptP, 
  'mailboxType'=>$MAIL_TYPE['ENTERPRISE']
);

$headers[] = 'Content-Type: application/json';
$headers[] = 'Cache-Control: no-cache';
$headers[] = "Authorization: $t";

if (empty($id)) {
  $url = $platformHost.'/platform/mailboxAccount/save';
  $res = httpClient($url, $param, 'POST', $headers, 10);
  echo $res;

} else {
  $param['sid'] = $id;
  $url = $platformHost.'/platform/mailboxAccount/update';
  $res = httpClient($url, $param, 'POST', $headers, 10);
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
////////////////////////////////////////