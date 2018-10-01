<?php
    session_start();
    if(isset($_SESSION['UserID']) == '') {
        print("<script>location.href = 'index.php';</script>");
    } else {
    }
    if(isset($_SESSION['CartID']) == '') {
        $_SESSION['CartID'] = rand(100000, 999999);
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
    <title>個別注文 - Ticper</title>

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
      });
    </script>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h3>個別注文</h3>
          <table border="2">
            <?php
              require_once('config/config.php');
              $sql = mysqli_query($db_link, "SELECT OrgID, OrgName FROM tp_org");
              while($result1 = mysqli_fetch_assoc($sql)) {
                print('<h5><b>'.$result1['OrgName'].'</b></h5>');
                $orgid = $result1['OrgID'];
                print('<div class="row">');
                $sql2 = mysqli_query($db_link, "SELECT FoodID, FoodName, FoodPrice, FoodStock FROM tp_food WHERE OrgID = '$orgid'");
                while($result2 = mysqli_fetch_assoc($sql2)) {
                  if($result2['FoodStock'] == 0) {
                    print('<div class="col s12 m6">');
                    print('<div class="card red">');
                    print('<div class="card-content white-text">');
                    print('<span class="card-title"><b>'.$result2['FoodName'].'</b></span>');
                    print('<span class="new badge red" data-badge-caption="売り切れ"></span>');
                    print('</div>');
                    print('<div class="card-action">');
                    print('<b>売り切れ</b>');
                    print('</div>');
                    print("</div>");
                    print('</div>');
                  } else {
                    print('<div class="col s12 m6">');
                    print('<div class="card">');
                    print('<div class="card-content">');
                    print('<span class="card-title"><b>'.$result2['FoodName'].'</b></span>');
                    print('<span class="new badge blue" data-badge-caption="枚">'.$result2['FoodStock'].'</span>');
                    print('</div>');
                    print('<div class="card-action">');
                    print('<form action="r-kobetsu-addcart.php" method="POST"><input type="hidden" name="fi" value="'.$result2['FoodID'].'"><input type="number" name="kz" placeholder="欲しい枚数を入力" required><button type="submit" class="btn">カートに追加</button></form>');
                    print('</div>');
                    print('</div>');
                    print('</div>');
                  }
                }
                print('</div>');
              }
            ?>
          </table>
          <a href="r-kobetsu-checkout1.php" class="btn">チェックアウト</a>&nbsp;<a href="r-kobetsu-viewcart.php" class="btn">注文内容を見る</a>
        </div>
      </div>
    </div>
  </body>
</html>
