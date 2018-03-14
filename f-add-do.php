<?php
	// コンフィグを読み込み
	require_once('config/config.php');

	// f-add.phpから投げられた文字列をローカル変数にぶち込む
	$FoodName = $_POST['FoodName'];
	$OrgID = $_POST['OrgID'];
	$FoodDescription = $_POST['FoodDescription'];
	$FoodPrice = $_POST['FoodPrice'];
	$FoodStock = $_POST['FoodStock'];

	// さっきのローカル変数から特殊文字列を抜き取る			
	$e_FoodName = $db_link -> real_escape_string($FoodName);
	$e_OrgID = $db_link -> real_escape_string($OrgID);
	$e_FoodDescription = $db_link -> real_escape_string($FoodDescription);
	$e_FoodPrice = $db_link -> real_escape_string($FoodPrice);
	$e_FoodStock = $db_link -> real_escape_string($FoodStock);

	// HTMLの特殊文字列をエスケープする
	$h_FoodName = htmlspecialchars($e_FoodName, ENT_QUOTES, 'UTF-8', false;)
	$h_OrgID = htmlspecialchars($e_OrgID, ENT_QUOTES, 'UTF-8', false);
	

	// 最新の食品数を取得して食品数+1したデータをFoodIDにする。
	$sql = mysqli_query($db_link, "SELECT COUNT(*) AS num FROM tp_food");
	$result = mysqli_fetch_assoc($sql);
	$FoodID = $result['num'] + 1;

	// 食品登録
	$sql = mysqli_query($db_link, "INSERT INTO tp_food VALUES ('$FoodID', '$FoodName', '$OrgID', '$FoodDescription', '$FoodPrice', '$FoodStock', '0', '0')");
	print("<script>alert('登録が完了しました。詳しくは団体食品一覧を御覧ください。');location.href = 'f-add.php';</script>");
?>


