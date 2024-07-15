<?php
//1. POSTデータ取得
$bank = $_POST['bank'];
$name = $_POST['name'];
$brand = $_POST['brand'];
$category = $_POST['category'];
$money = $_POST['money'];
$id = $_POST['id'];

//2. DB接続します
require_once('funcs.php'); //使用する関数が記述されたファイル名を指定
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE
                            gs_bm_table
                        SET name = :name,
                            bank = :bank , brand = :brand , category = :category , money = :money , date = now()
                        WHERE id = :id;
                        ');


//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':bank', $bank, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':money', $money, PDO::PARAM_INT);

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
