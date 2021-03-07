<?php 
if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {
    $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
    $file_name = $_FILES["csvfile"]["name"];
  
    //拡張子を判定
    if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
      $err_msg = 'CSVファイルのみ対応しています。';
    } else {
      //ファイルをdataディレクトリに移動
      if (move_uploaded_file($file_tmp_name, "../../data/uploaded/" . $file_name)) {
        //後で削除できるように権限を644に
        chmod("../../data/uploaded/" . $file_name, 0644);
        $msg = $file_name . "をアップロードしました。";
        $file = '../../data/uploaded/'.$file_name;
        $fp   = fopen($file, "r");
  
        //配列に変換する
        while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
          $csvData[] = $data;
        }
        fclose($fp);
        //ファイルの削除
        unlink('../../data/uploaded/'.$file_name);

    // データベースに接続
    // データベースのenvファイルを持ってくる
    $url = parse_url(getenv('DATABASE_URL'));

    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));

    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    
    

    //  データの追加
      $sql_create = "INSERT INTO form (sei, mei, email, content) VALUES (:sei , :mei , :email , :content)";
      $stmt = $pdo->prepare($sql_create);
      $stmt->bindParam(':sei', $sei, PDO::PARAM_STR);
      $stmt->bindParam(':mei', $mei, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':content', $content, PDO::PARAM_STR);
      $dbh->beginTransaction();
      foreach ($csvData as $row) {
        $sei   = $row['sei'];
        $mei = $row['mei'];
        $email = $row[‘email’];
        $content = $row[‘content’];
        //ループのたびにsqlを実行する。
        $stmt->execute();
      }
      $dbh->commit();

      } else {
        $err_msg = "ファイルをアップロードできません。";
      }
    }
  } else {
    $err_msg = "ファイルが選択されていません。";
  }
