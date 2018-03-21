<?php
    // u-addbuserから投げられてきた内容を変数にぶち込む
    $userid = $_POST['UserID'];
    $username = $_POST['UserName'];
    $password = $_POST['Password'];

    // コンフィグファイルを読み込み
    require_once('config/config.php');

    // MySQLの特殊文字を排除
    $r_userid = $db_link -> real_escape_string($userid);
    $r_username = $db_link -> real_escape_string($username);
    $r_password = $db_link -> real_escape_string($password);

    // HTMLの特殊文字を排除
    $h_userid = htmlspecialchars($r_userid, ENT_QUOTES);
    $h_username = htmlspecialchars($r_username, ENT_QUOTES);
    $h_password = htmlspecialchars($r_password, ENT_QUOTES);

    //パスワードをハッシュ化する
    $hashed_password = password_hash($h_password, PASSWORD_DEFAULT);

    // いずれかが入力されていない場合
    if ($h_userid == '' or $h_username == '' or $h_password == '') {
        print('<script>alert("入力されていない項目があります。"); location.href = "u-addbuser.php";</script>');
    } else { //全て入力されている場合
        // データベースにユーザを登録
        $sql = mysqli_query($db_link, "INSERT INTO tp_user_booth VALUES ('$h_userid', '$h_username', '$hashed_password')");
        // データベースへの登録に失敗した場合
        if (!$sql) {
            print('<script>alert("データベースへの登録に失敗しました。"); location.href = "u-addbuser.php";</script>');
        } else { // 成功した場合
            print('<script>alert("登録しました。"); location.href = "u-addbuser.php";</script>');
        }
    }
?>