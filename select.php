<?php
session_start();

//１．関数群の読み込み
require_once('funcs.php');
loginCheck();

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  sql_error($stmt); //execute（SQL実行時にエラーがある場合）

} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $view .= '<p>';
    $view .= '<a href="detail.php?id=' . $result['id'] . '">';
    $view .= $result['id'] . ' : ' . $result['bank'] . ' : ' . $result['name'] . ' : ' .
      $result['brand'] . ' : ' . h($result['money']) . ' : ' . h($result['category']) . ' : ' . h($result['date']);
    $view .= '</a>';
    $view .= "　";

    if ($_SESSION['kanri'] === 1) {
      $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r['id'] . '">';
      $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
      $view .= '</a>';
    }

    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>一覧表示</title>
  <link rel="icon" href="./img/heart.png">
  <link rel="stylesheet" href="./css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body id="main">
  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">データ登録画面へ</a>
        </div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <div>
    <div class="container jumbotron"><?= $view ?></div>
  </div>
  <!-- Main[End] -->
</body>

</html>