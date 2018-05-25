<?php
  session_start();
  if(isset($_SESSION['UserID']) == '') {
    print("<script>location.href = 'index.php';</script>");
  } else {
    require_once('config/config.php');
    $userid = $_SESSION['UserID'];
    $sql = mysqli_query($db_link,"SELECT SuperUser FROM tp_user_booth WHERE UserID = '$userid'");
    $result = mysqli_fetch_assoc($sql);
    $root = $result['SuperUser'];
    if($root != 1){
      print("<script>alert('このページは管理者以外閲覧できません');location.href = 'home.php';</script>");
    } else {
      $acode = $_POST['acode'];
      $sheets = $_POST['sheets'];
      $used = $_POST['used'];

      $r_sheets = $db_link -> real_escape_string($sheets);
      $h_sheets = htmlspecialchars($r_sheets, ENT_QUOTES);

      $r_acode = $db_link -> real_escape_string($acode);
      $h_acode = htmlspecialchars($r_acode, ENT_QUOTES);

      $r_used = $db_link -> real_escape_string($used);
      $h_used = htmlspecialchars($r_used, ENT_QUOTES);

      $sql = mysqli_query($db_link, "UPDATE tp_ticket SET Sheets = '$h_sheets' Used = '$h_used' WHERE TicketACode = '$h_acode'");
      //print("<script>alert('変更しました');location.href = 'check-user-do.php?userid=".$_SESSION['UserID']."';</script>");
    }
  }
?>