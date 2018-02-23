<?php
  require_once('config/config.php');
  $userid = $_POST['userid'];
  $password = $_POST['password'];

  $e_userid = $db_link -> real_escape_string($userid);
  $e_password = $db_link -> real_escape_string($password);

  $sql = mysqli_query($db_link, "SELECT UserID, Password FROM tp_user_booth WHERE UserID = '$e_userid'");
  $result = mysqli_fetch_assoc($sql);

  if($e_userid == $result['UserID'] and password_verify($e_password, $result['Password'])) {
    session_start();
    $_SESSION['UserID'] = $e_userid;
    $logMessage = "会計用Ticperにログイン";
    $sql = mysqli_query($db_link, "INSERT INTO tp_log ('Time', 'Action', 'BoothUserID') VALUES (CURRENT_TIMESTAMP, '$logMessage', '$e_userid')");
    print('<script>location.href = "home.php";</script>');
  } else {
    print('<script>alert("ユーザ名またはパスワードが違います。"); location.href = "index.php"; </script>');
  }
?>
