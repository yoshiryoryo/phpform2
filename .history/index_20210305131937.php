<?php
// セッションIDは個人を識別するために必要なID
session_start();
function generateToken()
{
    // セキュリティ上他者からの予測を困難にするため、乱数を設定する
    $bytes = openssl_random_pseudo_bytes(16);
    return bin2hex($bytes);
}
$token = generateToken();
$_SESSION['token'] = $token;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>コンタクト</title>
</head>
<body>
    <h1>お問い合わせフォーム</h1>
    <p>* は必須項目です</p>
    <form action="validation.php" method="get">
        <label for="sei">*姓（セイ）</label>
        <input type="text" name="sei" id="sei">
        <label for="mei">*名（メイ）</label>
        <input type="text" name="mei" id="sei">
        <label for="email">*Eメール</label>
        <input type="text" name="email" id="email">
        <label for="gender">性別</label>
        <select name="gender" id="gender">
            <option value=""></option>
            <option value="male">男性</option>
            <option value="female">女性</option>
        </select>
        <label for="title">*タイトル</label>
        <input type="text" name="title" id="title">
        <label for="content">*お問い合わせ内容(255文字以内)</label>
        <textarea rows="10" name="content" id="content">
            </textarea>
        <input type="submit" value="送信">
    </form>
</body>
</html>