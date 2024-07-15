<?php
session_start();

//１．関数群の読み込み
require_once('funcs.php');
loginCheck();

//2. DB接続します
$pdo = db_conn();

//3. POSTデータ取得
$id = $_GET['id'];

//4．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//5．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ編集</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./img/heart.png">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <header class="header">
                <h1 class="header_text">資産管理アプリ</h1>
            </header>

            <main class="main">
                <form class="form" method="POST" action="update.php">
                    <div class="jumbotron">
                        <fieldset>
                            <legend>データ編集</legend>
                            <label>銀行：<input type="text" name="name" value="<?= $result['bank'] ?>"></label><br>
                            <label>名義：<input type="text" name="email" value="<?= $result['name'] ?>"></label><br>
                            <label>銘柄：<input type="text" name="age" value="<?= $result['brand'] ?>"></label><br>
                            <label>カテゴリ：<input type="text" name="age" value="<?= $result['category'] ?>"></label><br>
                            <label>金額：<input type="text" name="age" value="<?= $result['money'] ?>"></label><br>
                            <input type="hidden" name="id" value="<?= $result['id'] ?>">
                            <input type="submit" value="送信">
                        </fieldset>
                    </div>
                </form>
                <!-- select.phpへのハイパーリンクを追加 -->
                <div class="button_area">
                    <button onclick="location.href='select.php'">一覧</button>
                </div>
            </main>
        </div>
    </div>

    <footer class="footer">
        <h1 class="footer_text">資産管理アプリ</h1>
    </footer>

    </div>

    <!-- script -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</body>

</html>