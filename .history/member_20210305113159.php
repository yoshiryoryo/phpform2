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
       </tr>
        <?php
        foreach ($stmt as $row) {
        ?>
            <tr>
                <td>
                    <?= $row['name_1']; ?>
                </td>
                <td>
                    <?= $row['name_2']; ?>
                </td>     
                <td>
                    <?= $row['email']; ?>
                </td>
                <td>
                    <?=$row['text'];?>
                </td>
            
        <?php }
        ?>
    </table>
    </div>


    <p><a href="index.php">入力画面に戻る</a></p>
</body>
</html>