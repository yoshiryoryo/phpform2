<?php
session_start();

$session_id = session_id();

if (isset($session_id)) {

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
} else {
    echo 'セッションが有効期限切れです';
}

$_SESSION = [];

session_destroy();


header("Location:https://phpform2.herokuapp.com/member.php?");
exit
?>