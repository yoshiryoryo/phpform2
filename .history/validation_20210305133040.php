<?php
// 使用する変数を初期化
$sei = '';
$mei = '';
$email = '';
$content = '';

// エラー内容
$errors = [];

// 送信データをチェック
if (isset($_GET)) {

    // 姓（セイ）
    if (empty($_GET['sei'])) {
        $errors[] = '「姓（セイ）」は必須項目です。';
    } elseif (preg_match('/^[ァ-ヶー]+$/u', $_GET['sei'])) {
        $errors[] = '「全角カナ」で入力してください。';
    }

    // 名（メイ）
    if (empty($_GET['mei'])) {
        $errors[] = '「名（メイ）」は必須項目です。';
    } elseif (preg_match("/^[ァ-ヶー]+$/u", $_GET['mei'])) {
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