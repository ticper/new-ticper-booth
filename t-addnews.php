<?php
    session_start();
    if(isset($_SESSION['UserID']) == '') {
        print('<script>location.href = "index.php";</script>');
        exit();
    }
    
    if (isset($_POST['news']) == ''){
        print('<script>location.href = "index.php";</script>');
        exit();
    }
    $News = $_POST['news'];
    $News = htmlspecialchars($News, ENT_QUOTES);

    require_once('config/config.php');
    $News = $db_link -> real_escape_string($News);
    $sql = mysqli_query($db_link, "SELECT MAX(NewsID) AS num FROM tp_news");
    $result = mysqli_fetch_assoc($sql);
    $newsid = $result['num'] + 1;
    $sql = mysqli_query($db_link, "INSERT INTO tp_news VALUES ('$newsid', '0', '$News')");
    header('Location: t-news.php');
    exit();

?>