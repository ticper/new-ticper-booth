<?php
	session_start();
	if(isset($_SESSION['UserID']) == '') {
		print('<script>location.href = "index.php";</script>');
	} else {

	}

	$CartID = $_GET['cartid'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
    
		<meta name="author" content="Ticper Team" />
		<meta name="description" content="個別会計で発行した食券を表示します。" />
		<meta property="og:site_name" content="Ticper" />
		<meta property="og:title" content="個別会計食券:<?php print($CartID); ?>" />
		<meta property="og:description" content="個別会計で発行した食券を表示します。" />

		<meta name="robots" content="noindex,nofollow" />

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
          				<a href="#" onclick="window.print(); return false;">印刷する</a>
            			<a href="#!" onClick="var elem = document.querySelector('.sidenav');var instance = M.Sidenav.getInstance(elem);instance.open();" class="btn">メニューを開く</a>
          			</div>
          			<a href="#" data-target="slide-out" class="sidenav-trigger"></a>
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
    		<h2>食券</h2>
    		<p>カート(顧客)ID: <b><?php print($CartID); ?></b></p>
    			<div class="row">
    				<?php
    					$now = 0;
    					$goukei = 0;
    					$sql = mysqli_query($db_link, "SELECT * FROM tp_ticket WHERE CartID = '$CartID'");
    					while ($result = mysqli_fetch_assoc($sql)) {
    						print('<div class="col s6 m4">');
    						print('<img src="https://api.qrserver.com/v1/create-qr-code/?data='.$result['TicketACode'].'&size=200x200" alt="QRコード" /><br>');
    						$foodid = $result['FoodID'];
    						$sql2 = mysqli_query($db_link, "SELECT FoodName, OrgID, FoodPrice FROM tp_food WHERE FoodID = '$foodid'");
    						$result2 = mysqli_fetch_assoc($sql2);
    						$OrgID = $result2['OrgID'];
    						$sql3 = mysqli_query($db_link, "SELECT OrgName, OrgPlace FROM tp_org WHERE OrgID = '$OrgID'");
    						$result3 = mysqli_fetch_assoc($sql3);
    						print('<b>'.$result2['FoodName'].'</b>('.$result['Sheets'].'枚)<br>');
    						print($result3['OrgName'].'<br>('.$result3['OrgPlace'].'で交換)<br>');
    						print('<b>'.$result2['FoodPrice'].'円</b>&nbsp;');
    						print('<label><input type="checkbox" class="filled-in" /><span>使用済み</span></label><br><br>');
    						$goukei = $goukei + ($result2['FoodPrice'] * $result['Sheets']);
    						print('</div>');
    						$now = $now + 1;
    						if ($now == 4) {
    							print('</div><div class="row">');
    							$now = 0;    						
    						}
    					}
    				?>
    				
   	 			</div>
   	 			<p>合計: <b><?php print($goukei); ?>円</b></p>
    		</div>
    	</div>
    </body>
</html>