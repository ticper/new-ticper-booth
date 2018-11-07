<?php
    session_start();
    if(isset($_SESSION['UserID']) == '') {
        print("<script>location.href = 'index.php';</script>");
    } else {

    }
    $CartID = $_SESSION['cartid'];
    $Azukari = $_POST['get'];

    require_once('config/config.php');

    $sql = mysqli_query($db_link, "SELECT FoodID, Sheets FROM tp_kobetsu_carts WHERE CartID = '$CartID'");
    while($result = mysqli_fetch_assoc($sql)) {
        
    	$FoodID = $result['FoodID'];

        $sql2 = mysqli_query($db_link, "SELECT FoodPrice, FoodStock FROM tp_food WHERE FoodID = '$FoodID'");
        $result2 = mysqli_fetch_assoc($sql2);

        // アクティベーションコードを生成
        $ticketAcode = rand(100000, 999999);
        
        // 枚数を取得
        $Sheets = $result['Sheets'];
            
        $sql2 = mysqli_query($db_link, "INSERT INTO tp_ticket VALUES ('$ticketAcode', '', '$CartID', '$FoodID', '$Sheets', '0', '0', '0')");
        $sql2 = mysqli_query($db_link, "UPDATE tp_food SET FoodStock = FoodStock - '$Sheets', Bought = Bought + '$Sheets' WHERE FoodID = '$FoodID'");
    }
    unset($_SESSION["CartID"]);
    print('<script>location.href = "r-kobetsu-viewticket.php?cartid='.$CartID.'";</script>');
?>