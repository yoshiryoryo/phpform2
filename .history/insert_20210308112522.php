<?php
session_start();

$session_id = session_id();

if (isset($session_id)&isset($_SESSION['sei'])&isset($_SESSION['mei'])&isset($_SESSION['email'])) {

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

    // 上記の処理を行ってから、member.phpに移動
header("Location:http://phpform2.herokuapp.com/member.php");
exit;
} else {
  echo ’
exit;
}

$_SESSION = [];

session_destroy();

?>

