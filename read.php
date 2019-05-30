<!DOCTYPE html>
<html lang=jp>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="js/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>


<table id="list">
            <!-- ここに追加データが挿入される -->
            <tr><th>No.</th><td>郵便番号</td><td>都道府県</td><td>市区町村</td><td>番地</td><td>氏名</td><td>年齢</td><td>電話番号</td><td>mail</td><td>駅距離</td><td>予算</td><td>広さ</td><td>間取り</td><td>その他</td></tr>

<?php

//1.  DB接続します
  try {
  $pdo = new PDO('mysql:dbname=gs_re;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
  }
  
  //２．データ表示SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_an_table");
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";
  if($status==false) {
      //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while( $array = $stmt->fetch(PDO::FETCH_ASSOC)){  //ftecの説明はPDF参照
      //$arrayにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
    
      $h = '<tr><th>'.$array["id"].'</th><td>'.$array["postcode"].'</td><td>'.$array["pref"].'</td><td>'.$array["city"].'</td><td>'.$array["block"].'</td><td>'.$array["name"].'</td><td>'.$array["age"].'</td><td>'.$array["phone"].'</td><td>'.$array["mail"].'</td><td>'.$array["distance"].'</td><td>'.$array["budjet"].'</td><td>'.$array["width"].'</td><td>'.$array["madori"].'</td><td>'.$array["comment"].'</td></tr>';
      echo $h;
      
    }
  }
  ?>

</table>

</body>
</html>