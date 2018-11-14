<?php
	// セッションの引き継ぎ
	session_start();
	
	// 団体情報入力ぺページで入力した内容をローカル変数に投げる
	$orgname = $_POST['OrgName'];
	$orgplace = $_POST['OrgPlace'];

	// Configを読み込み
	require_once('config/config.php');

	// 空いている団体IDを取得したいのでCOUNTで団体の総数を取得
	$sql = mysqli_query($db_link, "SELECT count(*) AS num FROM tp_org");

	// さっきのSQL文を投げた結果をローカル変数に投げる
	$result = mysqli_fetch_assoc($sql);

	// $result のデーラに＋１して新規の団体IDとする
	$orgid = $result['num'] + 1;

	// SQLの特殊文字をエスケープする
	$e_orgname = $db_link -> real_escape_string($orgname);
	$e_orgplace = $db_link -> real_escape_string($orgplace);

	$sql = mysqli_query($db_link, "INSERT INTO tp_org VALUES ('$orgid', '1', '$orgname', '$orgplace', '0')");

?>
<script>
	alert("団体登録が完了しました。詳細は団体食品一覧を参照してください。");
	location.href = "o-add.php";
</script>