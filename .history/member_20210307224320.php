<?php
    

    // SELECT文を変数に格納
    $sql_read = "SELECT * FROM form";

    // SQLステートメントを実行し、結果を変数に格納
    $stmt = $pdo->query($sql_read);
    $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>登録一覧</title>
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

    table {
        background-color: white;
    }
</style>


<body>

    <div class="container">
        <h1>登録一覧</h1>
        <form action="download.php" method="get">
            <button type="submit" class="btn btn-info">CSVダウンロード</button>
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
        <form action="index.php" 　method="get">
            <button type="submit" class="btn btn-default">戻る</button>
        </form>
    </div>


</body>

</html>
</body>

</html>