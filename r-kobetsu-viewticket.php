<?php
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <title>食券</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <button class="btn-large" onClick="window.print();">食券を印刷する</button>
                    <a class="btn-large" href="r-kobetsu.php">会計受付に戻る</a>
                </div>
            </div>
            <div class="row">
                <?php
                    session_start();
                    $cid = $_SESSION['CartID'];
    
                    require_once('config/config.php');
    
                    $sql = mysqli_query($db_link, "SELECT FoodID, Sheets FROM tp_kobetsu_carts WHERE CartID = '$cid'");
                    while($result = mysqli_fetch_assoc($sql)) {
                        $acode = rand(111111,999999);
                        $fid = $result['FoodID'];
                        $sh = $result['Sheets'];
                        $sql2 = mysqli_query($db_link, "INSERT INTO tp_ticket(TicketACode, UserID, CartID, FoodID, Sheets, Used, Changed, ChangeNo) VALUES ('$acode', '', '$cid', '$fid', '$sh', '0', '0', '0')");
                        $sql3 = mysqli_query($db_link, "UPDATE tp_food SET FoodStock = FoodStock - '$sh', Bought = Bought + '$sh' WHERE FoodID = '$fid'");

                    }
                    $sql = mysqli_query($db_link, "SELECT TicketACode, FoodID, Sheets FROM tp_ticket WHERE CartID = '$cid'");
                    $goukei = 0;
                    while($result = mysqli_fetch_assoc($sql)) {
                        $fid = $result['FoodID'];
                        $acode = $result['TicketACode'];
                        $sh = $result['Sheets'];
                        print('<div class="col s3">');
                        print('<img src="https://chart.apis.google.com/chart?chs=150x150&cht=qr&chl='.$acode.'" alt="QRコード" /><br>');
                        $sql2 = mysqli_query($db_link, "SELECT FoodName, OrgID, FoodPrice FROM tp_food WHERE FoodID = '$fid'");
                        $result2 = mysqli_fetch_assoc($sql2);
                        $oid = $result2['OrgID'];
                        $sql3 = mysqli_query($db_link, "SELECT OrgName, OrgPlace FROM tp_org WHERE OrgID = '$oid'");
                        $result3 = mysqli_fetch_assoc($sql3);
                        print($result3['OrgName'].' - '.$result2['FoodName'].'('.$result['Sheets'].'枚)<br>');
                        print($result3['OrgPlace'].'で交換してください。');
                        print('<input type="checkbox"><span>交換済み</span>');
                        print('</div>');
                        $goukei = $goukei + $result2['FoodPrice'];
                    }
                    unset($_SESSION['CartID']);
                ?>
            </div>
        </div>
    </body>
</html>