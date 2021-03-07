<?php

// 変数を定義
// $_SESSIONを利用する際は必ずsession_startを記述
session_start();

$session_id = session_id();

if (isset($_SESSION['sei']) & isset($_SESSION['mei']) & isset($_SESSION['email']) & isset($session_id)) {

    $sei = $_SESSION['sei'];
    $mei = $_SESSION['mei'];
    $email = $_SESSION['email'];
    $content = $_SESSION['content'];


    // データベースに接続
    // データベースのenvファイルを持ってくる
    $url = parse_url(getenv('DATABASE_URL'));

    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));

    $pdo = new PDO($dsn, $url['user'], $url['pass']);

    //  データの追加
    $sql_create = "INSERT INTO form (sei, mei, email, content) VALUES ('  $sei  ','  $mei  ','  $email  ',' $content ')";
    $stmt = $pdo->prepare($sql_create);
    $stmt->execute();

    // SELECT文を変数に格納
    $sql_read = "SELECT * FROM form";

    // SQLステートメントを実行し、結果を変数に格納
    $stmt = $pdo->query($sql_read);
    $stmt->execute();
} else {
    echo 'セッションが有効期限切れです';
}

$_SESSION = [];

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>

<style>
    body {
        background: #f3f3f3;
    }

    .container {
        margin-top: 60px;
    }

    h1 {
        margin-bottom: 50px;
        text-align: center;
    }

    button {
        margin-top: 30px;
    }
</style>


<body>
    <div class="container">
        <h1>登録一覧</h1>

        <form action="download.php" method="get">
            <button type="submit" class="btn-info">CSV出力</button>
        </form>
        <form action="index.php" 　method="get">
            <button type="submit" class="">戻る</button>
        </form>

        <table class="table table-bordered">
            <tr>
                <th>姓(セイ)：</th>
                <th>名(セイ)：</th>
                <th>Eメール：</th>
                <th>補足事項：</th>
            </tr>
            <?php
            foreach ($stmt as $row) {
            ?>
                <tr>
                    <td>
                        <?= $row['sei']; ?>
                    </td>
                    <td>
                        <?= $row['mei']; ?>
                    </td>
                    <td>
                        <?= $row['email']; ?>
                    </td>
                    <td>
                        <?= $row['content']; ?>
                    </td>

                <?php }
                ?>
        </table>

    </div>

    
</body>

</html>
</body>

</html>