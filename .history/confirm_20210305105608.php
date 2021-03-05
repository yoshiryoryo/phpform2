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
        <!--htmlタグとして機能しないようにする、-->
        <td><?=htmlspecialchars($_GET['sei'])?></td>
        </tr>
        <tr>
        <th>名（メイ）:</th>
        <td><?=htmlspecialchars($_GET['mei'])?></td>
        </tr>
        <tr>
        <th>メールアドレス：</th>
        <td><?=htmlspecialchars($_GET['email'])?></td>
        </tr>
        <tr>
        <th>補足事項：</th>
        <!--nl2brはenterに対してbrタグを追加するためのもの-->
        <td><?=nl2br(htmlspecialchars($_GET['text']))?></td>
        </tr>
    </div>
</body>
</html>