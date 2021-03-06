<?php
// データベースに接続
// データベースのenvファイルを持ってくる
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

    // SELECT文を変数に格納
    $sql_read = "SELECT * FROM form";
    // SQLステートメントを実行し、結果を変数に格納
    $stmt = $pdo->query($sql_read);
    $stmt->execute();
    //SplFileObjectのインスタンスを生成
    $csvFile = new SplFileObject('member.csv', 'w');
    foreach ($stmt as $row) {
        //
        $csvFile->fputcsv($row);
    }
    //SplFileObjectのインスタンスは処理が終わったら、nullで編集ロックを解除する。
    $csvFile = null;
    echo 'member.csvを出力しました。';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php">
        <input type="submit" value="戻る">
    </form>
</body>
</html>