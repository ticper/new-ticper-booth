<?php
  // エラーを出力しない
  error_reporting(0);
  $db_host = 'db.rintech.tokyo';
  $db_user = 'root';
  $db_pass = 'yakiniki2001';
  $db_name = 'ticper';

  $db_link = new mysqli($db_host, $db_user, $db_pass, $db_name);
  mysqli_set_charset($db_link, 'utf8');

  if (mysqli_connect_errno()) {
    printf("Connect Failed:".mysqli_connect_error());
    exit();
  }
?>
