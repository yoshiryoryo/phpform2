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

<style>
        body {
            background: #f3f3f3;
        }
        .container {
            margin-top: 60px;
        }
        h1 {
            margin-bottom: 50px;
            text-align: center;
        }
        button {
            margin-top: 30px;
        }
    </style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-4 col-xs-4">
                <h1>登録フォーム</h1>
                <p>* は必須項目です</p>
                <form action="validation.php" method="get">
                    <input type="hidden" value="$token">
                    <div class="form-group">
                        <label for="sei">*姓（セイ）:</label>
                        <input type="text" class="form-control" name="sei" id="sei">
                    </div>
                    <div class="form-group">
                        <label for="mei">*名（メイ）:</label>
                        <input type="text" class="form-control" name="mei" id="mei">
                    </div>
                    <div class="form-group">
                        <label for="email">*Eメール:</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="content">補足事項(50文字以内):</label>
                        <textarea class="form-control" rows="5" name="content" id="content"></textarea>
                    </div>
                    <button type="submit"  class="btn btn-success btn-block">送信</button>
                </form>
                <form action="member.php">
                    <button type="submit"　class="btn btn-success btn-block">一覧確認</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>