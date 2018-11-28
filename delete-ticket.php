<?php
  session_start();
  if(isset($_SESSION['UserID']) == '') {
    print("<script>location.href = 'index.php';</script>");
  } else {
    require_once('config/config.php');
    $acode = $_POST['acode'];
    $sheets = $_POST['sheets'];
    $price = $_POST['price'];
    $foodid = $_POST['foodid'];
    $sql0 = mysqli_query($db_link,"SELECT Used FROM tp_food WHERE FoodID = '$foodid'");
    $result0 = mysqli_fetch_assoc($sql0);
    $sql = mysqli_query($db_link,"UPDATE tp_food SET FoodStock = FoodStock + '$sheets', Bought = Bought - '$sheets' WHERE FoodID = '$foodid'");
    $sql2 = mysqli_query($db_link,"DELETE FROM tp_ticket WHERE TicketACode = '$acode'");
    if ($result0['Used'] == 1) {
      $sql3 = mysqli_query($db_link,"UPDATE tp_food SET cooked = cooked - '$sheets'");
    }
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
    <title>払い戻し - Ticper</title>

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
      <li><a href="u-addauser.php">文実ユーザ登録</a></li>
    </ul>
    <ul id="d-recept" class="dropdown-content">
      <li><a href="r-qrcheck.php">QRコード</a></li>
      <li><a href="r-kobetsu.php">個別注文</a></li>
      <li><a href="r-return.php">払い戻し</a></li>
      <li><a href="o-changestatus.php">混雑度変更</a></li>
    </ul>
    <ul id="d-orgfood" class="dropdown-content">
      <li><a href="of-list.php">団体・食品一覧</a></li>
      <li><a href="o-add.php">団体追加</a></li>
      <li><a href="f-add.php">食品追加</a></li>
      <li><a href="s-check.php">ステータスチェック</a></li>
    </ul>
    <ul id="slide-out" class="sidenav">
      <li>
        <div class="user-view">
          <div class="background">
            <img width="100%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Yamabuki_High_School.JPG/1200px-Yamabuki_High_School.JPG">
          </div>
          <a href="#!user"><img class="circle" src="img/icon.jpg"></a>
          <a href="#!name" style="color: white;">
            <?php
              $UserID = $_SESSION['UserID'];
              require_once('config/config.php');
              $sql = mysqli_query($db_link, "SELECT UserName FROM tp_user_booth WHERE UserID = '$UserID'");
              $result = mysqli_fetch_assoc($sql);
              print($result['UserName']);
            ?>
          </a>
        </div>
      </li>
      <li><a href="#!" class="dropdown-trigger" data-target="d-recept">受付<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a href="#!" class="dropdown-trigger" data-target="d-orgfood">データ管理<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a href="#!" class="dropdown-trigger" data-target="d-userc">ユーザ管理<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a href="t-news.php">ニュース</a></li>
      <li class="divider"></li>
      <li><a href="logout.php">ログアウト</a></li>
    </ul>
    <nav class="light-blue darken-4">
      <div class="container">
        <div class="nav-wrapper">
          <a href="home.php" class="brand-logo">Ticper</a>
          <div class="right hide-on-med-and-down">
            <a href="#!" onClick="var elem = document.querySelector('.sidenav');var instance = M.Sidenav.getInstance(elem);instance.open();" class="btn">メニューを開く</a>
          </div>
          <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
      </div>
    </nav>
    <script>
      $(".dropdown-trigger").dropdown();
      $(document).ready(function(){
        $('.sidenav').sidenav();
        M.toast({html: '<?php print($result['UserName']); ?>さんとしてログインしました。'})
      });
    </script>
    <div class="container">
      <div class="row">
        <div class="row s12">
          <h3>処理完了</h3>
          <p><?php print($price); ?>円をお客さんに渡してください</p>
          <a href="r-return.php" class="btn">戻る</a>
        </div>
      </div>
    </div>
  </body>
</html>
