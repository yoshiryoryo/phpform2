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
    $stmt->execute()；
//SplFileObjectのインスタンスを生成
$csvFile = new SplFileObject('member.csv', 'w');
foreach ($stmt as $row) {
    //csvファイルに変換して表示
    $csvFile->fputcsv($row);
}

// ダウンロードするサーバのファイルパス
$filepath = 'member.csv';

// HTTPヘッダを設定
// octet-streamはファイル形式を指定する必要がないとき
header('Content-Type: application/octet-stream');
// Content-Lengthは、ファイルサイズを取得するfilesize関数を使用し指定
header('Content-Length: ' . filesize($filepath));
// ダイアログを表示させる
header('Content-Disposition: attachment; filename=member.csv');

?>
