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
    // この記述がないとkey,value
    $stmt->fetch(PDO::FETCH_ASSOC);

// 書き込みようファイルを開く
$csvFile = fopen('member.csv', 'w');
// 正常にファイルが開かれたら書き込み
if($csvFile) {
    foreach ($stmt as $row) {
        // fputcsv関数でファイルに書き込み
        fputcsv($csvFile, $row);
    }
}

fclose($csvFile);

// ダウンロードするサーバのファイルパス
$filepath = 'member.csv';

// HTTPヘッダを設定
// octet-streamはファイル形式を指定する必要がないとき
header('Content-Type: application/octet-stream');
// Content-Lengthは、ファイルサイズを取得するfilesize関数を使用し指定
header('Content-Length: ' . filesize($filepath));
// ダイアログを表示させる
header('Content-Disposition: attachment; filename=member.csv');

// ファイル出力
readfile($filepath);
?>