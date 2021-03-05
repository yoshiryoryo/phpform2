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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

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

    <form action="" method="POST">
        <p>氏名<input type="text" name="name">
        <p>年齢<input type="number" name="age">
        <input type="submit">
    </form>
</body>
</html>