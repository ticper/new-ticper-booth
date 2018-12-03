<?php
	session_start();
	if(isset($_SESSION['UserID']) == '') {
		print("<script>location.href = 'index.php';</script>");
		exit();
	} else {
		require_once('config/config.php');
		$userid = $_SESSION['UserID'];
		$hostuserid = $_SESSION['UserID'];
		$sql = mysqli_query($db_link,"SELECT SuperUser FROM tp_user_booth WHERE UserID = '$userid'");
		$result = mysqli_fetch_assoc($sql);
		$root = $result['SuperUser'];
		if($root != 1){
			print("<script>alert('このページは管理者以外閲覧できません');location.href = 'home.php';</script>");
		} else {
			$userid = $_GET['userid'];
			$password = $_POST['password'];
			$confirm = $_POST['confirm'];

			$sql = mysqli_query($db_link,"SELECT * FROM tp_user_cust WHERE UserID = '$userid'");
			$result = mysqli_fetch_assoc($sql);
			$username = $result['UserName'];
			
			if($username == ''){
				print('<script>alert("ユーザーIDが不正です。"); location.href = "check-user.php";</script>');
			} else {		
				if($password == $confirm){
					$s_userid = $db_link -> real_escape_string($userid);
					$h_userid = htmlspecialchars($s_userid, ENT_QUOTES);

					$s_password = $db_link -> real_escape_string($password);
					$h_password = htmlspecialchars($s_password, ENT_QUOTES);

					$hashed_password = password_hash($h_password, PASSWORD_DEFAULT);
					
					if ($h_userid == '' or $hashed_password == '') {
						print('<script>alert("不正なリクエスト"); location.href = "change-password.php";</script>');
					
					} else {
						$sql = mysqli_query($db_link, "UPDATE tp_user_cust SET Password = '$hashed_password' WHERE UserID = '$userid'");

						if(!$sql){
							print('<script>alert("不正なリクエスト");location.href = "change-password.php?userid='.$userid.'";</script>');
						} else {
							$message = $userid."さんのパスワードを変更しました。";
							$sql = mysqli_query($db_link, "INSERT INTO tp_log VALUES (CURRENT_TIMESTAMP, '$message', '$hostuserid', '', '')");
							print('<script>alert("パスワードを変更しました");location.href = "check-user.php";</script>');
						}
					} 
				} else {
					print('<script>alert("confirmが一致していません");location.href = "change-password.php?userid='.$userid.'";</script>');
				}
			}
		}
	}
?>