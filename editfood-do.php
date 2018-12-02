<?php
	session_start();
	if(isset($_SESSION['UserID']) == '') {
		print("<script>location.href = 'index.php';</script>");
		exit();//Session not set
	} else {
		$hostuserid = $_SESSION['UserID'];
	//コンフィグを読み込み
	require_once('config/config.php');

	//POSTを取得
	$FoodID = $_POST['FoodID'];
	$FoodName = $_POST['FoodName'];
	$OrgID = $_POST['OrgID'];
	$FoodDescription = $_POST['FoodDescription'];
	$FoodPrice = $_POST['FoodPrice'];
	$FoodStock = $_POST['FoodStock'];

	//特殊文字を抜き取る
	$e_FoodID = $db_link -> real_escape_string($FoodID);
	$e_FoodName = $db_link -> real_escape_string($FoodName);
	$e_OrgID = $db_link -> real_escape_string($OrgID);
	$e_FoodDescription = $db_link -> real_escape_string($FoodDescription);
	$e_FoodPrice = $db_link -> real_escape_string($FoodPrice);
	$e_FoodStock = $db_link -> real_escape_string($FoodStock);

	// HTMLの特殊文字列をエスケープする
	$h_FoodID = htmlspecialchars($e_FoodID, ENT_QUOTES, 'UTF-8', false);
	$h_FoodName = htmlspecialchars($e_FoodName, ENT_QUOTES, 'UTF-8', false);
	$h_OrgID = htmlspecialchars($e_OrgID, ENT_QUOTES, 'UTF-8', false);

	//食品情報をUPDATEする。
	$sql = mysqli_query($db_link,"UPDATE tp_food SET FoodName = '$h_FoodName',OrgID = '$h_OrgID',FoodDescription = '$e_FoodDescription',FoodPrice = '$e_FoodPrice' WHERE FoodID = '$h_FoodID'");
	
	$message = "食品".$foodid."を編集しました。";
	$sql = mysqli_query($db_link, "INSERT INTO tp_log VALUES (CURRENT_TIMESTAMP, '$message', '$hostuserid', '', '')");

	print("<script>alert('登録情報の編集が完了しました。詳しくは団体食品一覧を御覧ください。');location.href = 'of-list.php';</script>");
	}
?>