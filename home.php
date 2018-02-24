<?php
  session_start();
  if(isset($_SESSION['UserID']) == '') {
    print("<script>location.href = 'index.php';</script>");
  } else {

  }
?>
<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <!-- エンコード設定 -->
    <meta charset="UTF-8" />

    <!-- 検索エンジンに掲載させない -->
    <meta name="robots" content="noindex,nofollow" />

    <!-- レスポンシブデザイン -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ページタイトル -->
    <title>メニュー - Ticper</title>

    <!-- jQuery(フレームワーク)導入 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Materialize(フレームワーク)導入 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Googleアナリティクス -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113412923-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-113412923-2');
    </script>
  </head>
  <body>
    <ul id="d-userc" class="dropdown-content">
      <li><a href="u-list.php">ユーザ一覧</a></li>
      <li><a href="u-addbuser.php">会計ユーザ登録</a></li>
      <li><a href="u-addouser.php">団体ユーザ登録</a></li>
    </ul>
    <ul id="d-recept" class="dropdown-content">
      <li><a href="r-qrcheck.php">QRコード</a></li>
      <li><a href="r-kobetsu.php">個別注文</a></li>
    </ul>
    <ul id="d-"
    <nav class="light-blue darken-4">
      <div class="container">
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo">Ticper</a>
          <a href="#" data-target="mobilemenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="r-modeselect.php">団体用Ticoer</a></li>
            <li><a href="https://yamabuki.ticper.com">顧客用Ticper</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <ul class="sidenav" id="mobilemenu">
      <li><a href="https://org.yamabuki.ticper.com">団体用Ticper</a></li>
      <li><a href="https://yamabuki.ticper.com">顧客用Ticper</a></li>
    </ul>

    <script>
      $(document).ready(function(){
        $('.sidenav').sidenav();
      });
    </script>
