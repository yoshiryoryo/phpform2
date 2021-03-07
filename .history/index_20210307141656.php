<?php
// セッションの有効期限を10秒に設定
session_set_cookie_params(10);
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
    <title>登録フォーム</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-4 col-xs-4">
                <h2>登録フォーム</h2>
                <p>* は必須項目です</p>
                <form action="validation.php" method="get">
                    <input type="hidden" value="$token">
                    <div class="form-group">
                        <label for="sei">*姓（セイ）:</label>
                        <input type="text" name="sei" id="sei">
                    </div>
                    <div class="form-group">
                        <label for="mei">*名（メイ）:</label>
                        <input type="text" name="mei" id="mei">
                    </div>
                    <div class="form-group">
                        <label for="email">*Eメール:</label>
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="content">補足事項(100文字以内):</label>
                        <textarea rows="10" name="content" id="content"></textarea>
                    </div>
                    <input type="submit" value="送信" class="class="btn btn-success btn-block">
                </form>
                <form action="member.php">
                    <input type="submit" value="一覧確認" class="class="btn btn-success btn-block">
                </form>
            </div>
        </div>
    </div>
</body>

</html>