<?php
$_ENV['RAINLOOP_INCLUDE_AS_API'] = true;
include 'config.inc.php';
include 'utils.php';

$m_url = $_SERVER["REQUEST_URI"];

$aes = new AESMcrypt($AES['bit'], $AES['key'], $AES['iv'], $AES['mode']);
$u = base64_decode($_GET['u']);
$p = $aes->decrypt(base64_decode($_GET['p']));

$ssoHash = \RainLoop\Api::GetUserSsoHash($u, $p);

\header("Location: $mailboxHost/?sso&hash=$ssoHash");