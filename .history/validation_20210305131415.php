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
    // 氏名
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
    // タイトル
    if (empty($_GET['title'])) {
        $errors[] = 'タイトルは必須項目です。';
    }
    // お問い合わせ内容
    if (empty($_GET['content'])) {
        $errors[] = 'お問い合わせ内容は必須項目です。';
    } elseif (mb_strlen($_POST['content']) > 255) {
        $errors[] = 'お問い合わせ内容は255文字以内でお願いします。';
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