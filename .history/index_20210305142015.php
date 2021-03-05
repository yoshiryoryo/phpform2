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
    <p>* は必須項目です</p>
    <form action="validation.php" method="get">
        <input type="hidden" value="$token">
        <label for="sei">*姓（セイ）:</label>
        <input type="text" name="sei" id="sei">
        <label for="mei">*名（メイ）:</label>
        <input type="text" name="mei" id="mei">
        <label for="email">*Eメール:</label>
        <input type="text" name="email" id="email">
        <label for="content">*補足事項(100文字以内):</label>
        <textarea rows="10" name="content" id="content">
            </textarea>
        <input type="submit" value="送信">
    </form>
    <form action="member.php">
        <input type="submit" value="一覧確認">
    </form>
    
</body>
</html>