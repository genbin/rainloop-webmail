<?php
$_ENV['RAINLOOP_INCLUDE_AS_API'] = true;
$host = 'http://localhost';
include '/var/www/index.php';

$m_url = $_SERVER["REQUEST_URI"];
// parse_str($m_url, $account);

$cryptU = $_GET['u'];
$u = base64_decode($cryptU);
$cryptPw = $_GET['p'];
$p = base64_decode($cryptPw);

$ssoHash = \RainLoop\Api::GetUserSsoHash($u, $p);
// echo $u;
// echo "\n";
// echo $p;
// echo "\n";
// echo $ssoHash;

\header("Location: $host/?sso&hash=$ssoHash");