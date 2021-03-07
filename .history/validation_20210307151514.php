<?php
// セッションの有効期限を上書き
ini_set('session.gc_maxlifetime', 10);
// セッションデータを破棄するgcの動作確立を100パーセントにする
// 分子
ini_set('session.gc_probability', 1);
// 分母
ini_set('session.gc_divisor', 1);

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


$_SESSION['sei'] = $_GET['sei'];
$_SESSION['mei'] = $_GET['mei'];
$_SESSION['email'] = $_GET['email'];
$_SESSION['content'] = $_GET['content'];




// エラー内容
$errors = [];

// 送信データをチェック
if (isset($_GET)) {
    // 姓（セイ）
    if (empty($_GET['sei'])) {
        $errors[] = '「姓（セイ）」は必須項目です。';
    } elseif (!preg_match("/^[ァ-ヶー]+$/u", $_GET['sei'])) {
        $errors[] = '姓（セイ）は「全角カナ」で入力してください。';
    }

    // 名（メイ）
    if (empty($_GET['mei'])) {
        $errors[] = '「名（メイ）」は必須項目です。';
    } elseif (!preg_match("/^[ァ-ヶー]+$/u", $_GET['mei'])) {
        $errors[] = '名（メイ）は「全角カナ」で入力してください。';
    }

    // Eメール
    if (empty($_GET['email'])) {
        $errors[] = '「メールアドレス」は必須項目です。';
    } elseif (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = '正しいEメールアドレスを指定してください。';
    }

    // 補足事項
    if( 100 < mb_strlen($_GET['content'])) {
        $error[] = "補足事項は100文字以内で入力してください";
      }


}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>フォーム</title>
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

    .error_list {
        padding: 10px 30px;
        color: #ff2e5a;
        border: 1px solid #ff2e5a;
        border-radius: 5px;
    }
</style>

<body>
    <?php if (empty($errors)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-4 col-xs-4">
        <h1>確認画面</h1>

        <form action="member.php" method="get">
            <div>
                <tr>
                    <th>姓（セイ）:</th>
                    <!--htmlタグとして機能しないようにする、クロスサイトスクリプティング対策-->
                    <td><?= htmlspecialchars($_GET['sei']) ?></td>
                </tr>
                <tr>
                    <th>名（メイ）:</th>
                    <td><?= htmlspecialchars($_GET['mei']) ?></td>
                </tr>
                <tr>
                    <th>メールアドレス：</th>
                    <td><?= htmlspecialchars($_GET['email']) ?></td>
                </tr>
                <tr>
                    <th>補足事項：</th>
                    <!--nl2brはenterに対してbrタグを追加するためのもの-->
                    <td><?= nl2br(htmlspecialchars($_GET['content'])) ?></td>
                </tr>
                <button type="submit" name="confirm" value="send">登録</button>
            </div>
        </form>
                </div></div></div>
    <?php else : ?>
        <div class="col-xs-offset-4 col-xs-4">
        <ul class="error_list">
            <?php foreach ($errors as $msg) : ?>
                <li><?= $msg ?>
                </li>
            <?php endforeach; ?>
        </ul>
        </div>
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
                            <label for="content">補足事項(100文字以内):</label>
                            <textarea class="form-control" cols="20" rows="5" name="content" id="content" maxlength="100"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">送信</button>
                    </form>
                    <form action="member.php">
                        <button type="submit" 　class="btn btn-success btn-block">一覧確認</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>