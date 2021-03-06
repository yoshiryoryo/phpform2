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

// SplFileObjectのインスタンスを生成
$csvFile = new SplFileObject('member.csv', 'w');

// while文データの数がわからないときの処理に便利
// PDOのfetchモードで 
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $csvFile->fputcsv($row);
}
//SplFileObjectのインスタンスは処理が終わったら、nullで編集ロックを解除する。
$csvFile = null;

header()
?>