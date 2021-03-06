<?php

$file_name = $_FILES["csvfile"]["name"];
// エラー処理
switch ($_FILES['csvfile']['error']) {
  case UPLOAD_ERR_OK: // 正常（アップロード成功）
    // 正常
    break;
  case UPLOAD_ERR_INI_SIZE:  // サイズオーバー（PHP側の設定値）
  case UPLOAD_ERR_FORM_SIZE: // サイズオーバー（HTMLフォーム側の設定値）
    echo "サイズオーバーです。";
    exit();
    break;
  case UPLOAD_ERR_PARTIAL: // 一部のみアップロード
  case UPLOAD_ERR_NO_FILE: // アップロードされなかった
    echo "アップロード失敗です。";
    exit();
    break;
  case UPLOAD_ERR_NO_TMP_DIR: // アップロード先である一時フォルダが存在しない
  case UPLOAD_ERR_CANT_WRITE: // ディスクへの書き込みに失敗した
  case UPLOAD_ERR_EXTENSION:  // PHPの拡張モジュールがファイルのアップロードを中止した
  default:
    echo "不具合レベルのエラーです。";
    exit();
    break;
}
// ファイルオープン
$fp = fopen($_FILES["csvfile"]["tmp_name"], "r");
//配列に変換する
while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
  $csvData[] = $data;
}
fclose($fp);
/////////////////////
try {
  $pdo = new PDO(
    'mysql:dbname=form; host=phpform_db_1; port=3306; charset=utf8',
    'root',
    'root'
  );
} catch (PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
}
var_dump($csvData);
echo $_FILES['csvfile']['name'] . "の処理が完了しました。<br>";
      //  データの追加
      // $sql_create = "INSERT INTO form (sei, mei, email, content) VALUES (:sei , :mei , :email , :content)";
      // $stmt = $pdo->prepare($sql_create);
      // $stmt->bindParam(':sei', $sei, PDO::PARAM_STR);
      // $stmt->bindParam(':mei', $mei, PDO::PARAM_STR);
      // $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      // $stmt->bindParam(':content', $content, PDO::PARAM_STR);
      // $dbh->beginTransaction();
      // foreach ($csvData as $row) {
      //   $sei   = $row['sei'];
      //   $mei = $row['mei'];
      //   $email = $row['email'];
      //   $content = $row['content'];
      //   //ループのたびにsqlを実行する。
      //   $stmt->execute();
      // }
      // $dbh->commit();
      // header("Location:http://phpform2.herokuapp.com/member.php");
      // exit;