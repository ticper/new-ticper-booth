<?php
    session_start();
    if(isset($_SESSION['UserID']) == ''){
        print('<script>alert("不正なリクエスト")</script>');
        print('<script>location.href = "index.php";</script>');
    }

    //飛んできた情報を格納する
    $foodid = $_GET['id'];

    //食品情報を削除
    require_once('config/config.php');
    mysqli_query($db_link,"DELETE FROM tp_food WHERE FoodID = '$foodid'");

    print('<script>alert("削除しました。")</script>');
    print('<script>location.href = "of-list.php";</script>');
?>