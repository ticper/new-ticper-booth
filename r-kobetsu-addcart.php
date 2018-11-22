<?php
    session_start();
    $CartID = $_SESSION['CartID'];
    $FoodID = $_POST['fi'];
    $Sheets = $_POST['kz'];
    
    require_once('config/config.php');
    
    $sql = mysqli_query($db_link, "SELECT CartID, FoodID, Sheets FROM tp_kobetsu_carts WHERE CartID = '$CartID' AND FoodID = '$FoodID'");
    $result = mysqli_fetch_assoc($sql);
    
    if($result['FoodID'] == $FoodID) {
        $Sheets = $Sheets + $result['Sheets'];
        $sql = mysqli_query($db_link, "UPDATE tp_kobetsu_carts SET Sheets = '$Sheets' WHERE CartID = '$CartID' AND FoodID = '$FoodID'");
        header('Location: r-kobetsu.php');
        exit();
    } elseif ($result['FoodID'] != $FoodID) {
        $sql = mysqli_query($db_link, "INSERT INTO tp_kobetsu_carts VALUES ('$CartID', '$FoodID', '$Sheets')");
        header('Location: r-kobetsu.php');
        exit();
    }
?>