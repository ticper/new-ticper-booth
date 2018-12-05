<?php
    $id = $_GET['id'];
    $id = htmlspecialchars($id, ENT_QUOTES);
    require_once('config/config.php');
    $id = $db_link -> real_escape_string($id);
    $sql = mysqli_query($db_link, "DELETE FROM tp_news WHERE NewsID = '$id'");
    header('Location: t-news.php');
    exit();
?>