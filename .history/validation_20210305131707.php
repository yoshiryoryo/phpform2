<?php
// 使用する変数を初期化
$name = '';
$email = '';
$gender = '';
$title = '';
$content = '';

// エラー内容
$errors = [];

// 送信データをチェック
if (isset($_GET)) {
    // 姓
    if (empty($_GET['name'])) {
        $errors[] = '氏名は必須項目です。';
    }
    // Eメール
    if (empty($_GET['email'])) {
        $errors[] = 'Eメールは必須項目です。';
    } elseif (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = '正しいEメールアドレスを指定してください。';
    }
    // 性別
    if (!empty($_GET['gender']) && !in_array($_GET['gender'], ['female','male'])) {
        $errors[] = '性別を選択してください。';
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
    <p>バリデーションエラーはありません。</p>
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