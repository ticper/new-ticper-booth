<?php
    // セッションを開始
    session_start();

    // カートIDを抜き取り
    $CartID = $_SESSION['CartID'];
    // 食品IDと枚数を取得
    $FoodID = $_POST['FoodID'];
    $maisu = $_POST['maisu'];

    // コンフィグを取得
    require_once('config/config.php');

    // MySQLの特殊文字を排除
    $r_FoodID = $db_link -> real_escape_string($FoodID);
    $r_maisu = $db_link -> real_escape_string($maisu);

    // HTMLの特殊文字を排除
    $h_FoodID = htmlspecialchars($r_FoodID, ENT_QUOTES);
    $h_maisu = htmlspecialchars($r_maisu, ENT_QUOTES);

    $sql = mysqli_query($db_link, "INSERT INTO tp_kobetsu_carts VALUES ('$CartID', '$h_FoodID', '$h_maisu', '')");
    print('<script>location.href = "r-kobetsu.php";</script>');
?>