<?php
  // セッションを開始
  session_start();

  // セッション変数「UserID」にログイン中のユーザ名がないとき、ログイン画面に戻す。
  if(isset($_SESSION['UserID']) == '') {
    print("<script>location.href = 'index.php';</script>");
  } else {

  }
  $orgid = $_POST['orgid'];
  $change = $_POST['statuschangeto'];

  require_once('config/config.php');

  $sql = mysqli_query($db_link, "UPDATE tp_org SET Status = '$change' WHERE OrgID = '$orgid'");

  print('<script>alert("混雑度を変更しました。"); location.href = "o-changestatus.php"; </script>');
?>