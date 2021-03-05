<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>確認画面</h2>
    <div>
        <tr>
        <th>姓（セイ）:</th>
        <td><?=escape($_GET['sei'])?></td>
        </tr>
        <tr>
        <th>名（メイ）:</th>
        <td><?=escape($_GET['mei'])?></td>
        </tr>
        <tr>
        <th>メールアドレス：</th>
        <td><?=escape($_GET['email'])?></td>
        </tr>
        <tr>
        <th>補足事項：</th>
        <td><?=n12br(escape($_GET))></td>
        </tr>
    </div>
</body>
</html>