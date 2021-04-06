<?php

require_once('funcs.php');   //「funcs.php」の中を読み込んで
$pdo = db_conn();  //そのなかの「db_conn（関数）」を呼び出す

//１．PHP
//select.phpのPHP部分コードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正、GETの内容をSELECTする！

$id = $_GET['id'];

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id =' . $id . ';');
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}

?>



<!-- ２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み" -->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>登録データ修正</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>登録データ修正</legend>
                <label>名前：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>ID：<input type="text" name="lid" value="<?= $result['lid'] ?>"></label><br>
                <label>パスワード：<input type="text" name="lpw" value="<?= $result['lpw'] ?>"></label><br>
                <label>管理フラグ：<input type="number" name="kanri_flg" value="<?= $result['kanri_flg'] ?>" min="0" max="1"></label><br>
                <label>退職フラグ：<input type="number" name="life_flg" value="<?= $result['life_flg'] ?>" min="0" max="1"></label><br>
                <!-- 「hidden」は隠せるけどデータを送れる -->
                <input type="hidden" name="id" value="<?= $result['id'] ?>"><br> 
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
