<?php
$isProduct = true;
$httpHost = $_SERVER['HTTP_HOST'];
$mailboxHost = '';
$platformHost = '';

if ($httpHost == 'hiov2.xyre.com') {
  // include '/var/www/html/rainloop/index.php';
  // $mailboxHost = 'http://10.17.4.10';
  // $platformHost = 'http://192.168.3.157:9999/platform-app';
  
  include '/var/www/index.php';
  $mailboxHost = 'http://10.17.4.6';
  $platformHost = 'http://192.168.3.157:9999/platform-app';

} else {
  include '/var/www/index.php';
  $mailboxHost = 'http://10.17.4.6';
  $platformHost = 'http://192.168.3.52:9999/platform-app';
}

// $mailboxHost = 'http://10.17.4.6';
// $platformHost = 'http://192.168.3.52:9999/platform-app';

// if ($isProduct) {
  // include '/var/www/html/rainloop/index.php';
  // $mailboxHost = 'http://10.17.4.10';
  // $platformHost = 'http://192.168.3.157:9999/platform-app';

  // include '/var/www/index.php';
  // $mailboxHost = 'http://10.17.4.6';
  // $platformHost = 'http://192.168.3.157:9999/platform-app';

// } else {
//   include '/var/www/index.php';
// }

$AES = array(
  'bit' => 128,
  'key' => 'JuZhouYun.HIO@18',
  'iv' => 'chaoyangdawanglu',
  'mode' => 'cbc',
);