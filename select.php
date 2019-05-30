<?php
//1.  DB接続します
try {
$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ表示SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

$kadai1 = $pdo->prepare("SELECT * FROM gs_an_table WHERE id = 1 OR id = 3 OR id =5");
$status1 = $kadai1->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){  //ftecの説明はPDF参照
    //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
    $view .= "<p>";
    $view .= $result["id"].":".$result["name"].":".$result["email"].":".$result["naiyou"];
    $view .= "</p>";
  }
}

$view1="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $kadai1->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $kadai1->fetch(PDO::FETCH_ASSOC)){  //ftecの説明はPDF参照
    //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
    $view1 .= "<p>";
    $view1 .= $result["id"].":".$result["name"].":".$result["email"].":".$result["naiyou"];
    $view1 .= "</p>";
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?>課題１を表示<br><?=$view1?></div>
</div>
<!-- Main[End] -->

</body>
</html>
