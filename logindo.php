<?php 
  // コンフィグを導入
  require_once('config/config.php');

  // index.php から投げた内容をローカル変数に入れる
  $userid = $_POST['userid'];
  $password = $_POST['password'];

  // SQ+の特殊な文字を抜き取る
  $e_userid = $db_link -> real_escape_string($userid);
  $e_password = $db_link -> real_escape_string($password);

  // SQL文をデータベース鯖に投げる
  $sql = mysqli_query($db_link, "SELECT UserID, Password FROM tp_user_booth WHERE UserID = '$e_userid'");

  // SQLで帰ってきた答えを配列にする
  $result = mysqli_fetch_assoc($sql);

  // ユーザIDとパスワードあ一致した場合
  if($e_userid == $result['UserID'] and password_verify($e_password, $result['Password'])) {
    // セッション
    session_start();
    $_SESSION['UserID'] = $e_userid;
    $message = $_SESSION['UserID']."さんがログインしました。";
		$hostuserid = $_SESSION['UserID'];
		$sql = mysqli_query($db_link, "INSERT INTO tp_log VALUES (CURRENT_TIMESTAMP, '$message', '$hostuserid', '', '')");
    print('<script>location.href = "home.php";</script>');
  } else {
    print('<script>alert("ユーザ名またはパスワードが違います。"); location.href = "index.php"; </script>');
  }
?>
