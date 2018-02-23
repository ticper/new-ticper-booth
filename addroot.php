<?php
  $userid = "ticper";
  $username = "テスト　太郎";
  $password = "ticp-37648";

  require_once('config/config.php');

  $p_hash = password_hash($password, PASSWORD_DEFAULT);

  $sql = mysqli_query($db_link, "INSERT INTO tp_user_booth VALUES ('$userid', '$username', '$p_hash')");
?>
