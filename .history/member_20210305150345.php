<?php
// セッションの開始
session_start();

$sei = htmlspecialchars($_SESSION['sei'], ENT_QUOTES, 'UTF-8');
$mei = htmlspecialchars($_SESSION['mei'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8');


// データベースに接続
// データベースのenvファイルを持ってくる
$url = parse_url(getenv('DATABASE_URL'));

$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));

$pdo = new PDO($dsn, $url['user'], $url['pass']);
// var_dump($pdo->getAttribute(PDO::ATTR_SERVER_VERSION));

//  データの追加
$sql_create = "INSERT INTO form (sei, mei, email, content) VALUES ('  $sei  ','  $mei  ','  $email  ', ' $content ')";
$stmt = $pdo->prepare($sql_create);
$stmt->execute();

// SELECT文を変数に格納
$sql_read = "SELECT * FROM form";

// SQLステートメントを実行し、結果を変数に格納
$stmt = $pdo->query($sql_read);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h3>登録一覧</h3>
    <table class="table table-bordered">
    <tr>
           <th>姓</th>
           <th>名</th>
           <th>アドレス</th>
           <th>補足事項</th>
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
                    <?= $row['content'];?>
                </td>
            
        <?php }
        ?>
    </table>
    </div>
    
    <form action="index.php">
     <input type="submit" value="戻る">

    </form>
</body>
</html>