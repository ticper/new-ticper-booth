<?php
    // セッションを開始
    session_start();

    // カートIDを抜き取り
    $CartID = $_SESSION['CartID'];
    // 食品IDと枚数を取得
    $FoodID = $_GET['id'];

    // コンフィグを取得
    require_once('config/config.php');

    // MySQLの特殊文字を排除
    $r_FoodID = $db_link -> real_escape_string($FoodID);

    // HTMLの特殊文字を排除
    $h_FoodID = htmlspecialchars($r_FoodID, ENT_QUOTES);

    $sql = mysqli_query($db_link, "SELECT Sheets FROM tp_kobetsu_carts WHERE FoodID = '$h_FoodID' AND CartID = '$CartID'");
    $result = mysqli_fetch_assoc($sql);
    if($result['Sheets'] >= 1) {
      $sql = mysqli_query($db_link, "UPDATE tp_kobetsu_carts SET Sheets = Sheets + '1' WHERE CartID = '$CartID' AND FoodID = '$h_FoodID'");
    } else {
      $sql = mysqli_query($db_link, "INSERT INTO tp_kobetsu_carts VALUES ('$CartID', '$h_FoodID', '1', '')");
    }
    print('<script>location.href = "r-kobetsu.php";</script>');
?>
