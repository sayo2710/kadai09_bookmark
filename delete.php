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
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//5．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}