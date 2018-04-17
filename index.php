<?php
  session_start();
  if(isset($_SESSION['UserID']) == '') {

  } else {
    print("<script>location.href = 'home.php';</script>");
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
    <title>ログイン - Ticper</title>

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
    <nav class="light-blue darken-4">
      <div class="container">
        <div class="nav-wrapper">
          <a href="home.php" class="brand-logo">Ticper</a>
          <a href="#" data-target="mobilemenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="https://org.yamabuki.ticper.com">団体用Ticoer</a></li>
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

    <div class="container">
      <div class="row">
        <div class="col s12">
          <h2>ログイン</h2>
          <p>アカウント情報を入力してログインしてください。</p>
        </div>
      </div>
      <div class="row">
        <form class="col s12" action="logindo.php" method="POST">
          <div class="row">
            <div class="input-field col s12">
              <input id="userid" name="userid" class="validate" type="text" required>
              <label for="userid">ユーザID</label>
            </div>
            <div class="input-field col s12">
              <input id="password" name="password" class="validate" type="password" required>
              <label for="password">パスワード</label>
            </div>
            <div class="input-field col s12">
              <input type="submit" value="送信" class="btn">
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
