<?php
// 使用する変数を初期化
$sei = '';
$mei = '';
$email = '';
$text = '';

// エラー内容
$errors = [];

// 送信データをチェック
if (isset($_GET)) {
    // 姓（セイ）
    if (empty($_GET['sei'])) {
        $errors[] = '「姓（セイ）」は必須項目です。';
    } elseif (!preg_match("/^[ァ-ヶー]+$/u", $_GET['sei'])) {
        $errors[] = '「全角カナ」で入力してください。';
    }

    // 名（メイ）
    if (empty($_GET['mei'])) {
        $errors[] = '「名（メイ）」は必須項目です。';
    } elseif (!preg_match("/^[ァ-ヶー]+$/u", $_GET['sei'])) {
        $errors[] = '「全角カナ」で入力してください。';
    }

    // Eメール
    if (empty($_GET['email'])) {
        $errors[] = 'Eメールは必須項目です。';
    } elseif (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = '正しいEメールアドレスを指定してください。';
    }
    
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>バリデーション結果</title>
</head>
<body>
    <h1>バリデーション結果</h1>
    <?php if (empty($errors)): ?>
        <h2>確認画面</h2>
    <form action="member.php" method="get">
    <div>
        <tr>
        <th>姓（セイ）:</th>
        <!--htmlタグとして機能しないようにする、クロスサイトスクリプティング対策-->
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
        <button type="submit" name="confirm" value="send">登録</button>
    </div>
    </form>
    <?php else: ?>
    <ul>
        <?php foreach ($errors as $msg): ?>
        <li><?= $msg ?>
        </li>
        <?php endforeach; ?>
    </ul>
    
    <?php endif; ?>
</body>
</html>