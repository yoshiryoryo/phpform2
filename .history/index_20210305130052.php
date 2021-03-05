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

    require 'validation.php';
    $errors = validation($_POST);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if(!empty($errors)): ?>
        <?php echo '<ul>'; ?>
            <?php
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
            ?>
        <?php echo '</ul>'; ?>
    <?php endif ?>

    <form action="confirm.php" method="get">
        <p>姓（セイ）：<input type="text" name="sei"></p>
        <p>名（メイ）：<input type="" name="mei"></p>
        <p>メールアドレス：<input type="email" name="email"></p>
        <textarea name="text" id="" cols="5" rows="10"></textarea>
        <input type="submit">
    </form>
</body>
</html>