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

session_cache_expire()
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
        $errors[] = 'Eメールは必須項目です。';
    } elseif (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = '正しいEメールアドレスを指定してください。';
    }

    // 補足事項

    
    // セッション時間を10秒

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title></title>
</head>
<body>
    <?php if (empty($errors)): ?>
        <h2>確認画面</h2>
    <form action="member.php" method="get">
    <div>
        <tr>
        <th>姓（セイ）:</th>
        <!--htmlタグとして機能しないようにする、クロスサイトスクリプティング対策-->
        <td><?=htmlspecialchars($_GET['sei'])?></td>
        </tr>
        <tr>
        <th>名（メイ）:</th>
        <td><?=htmlspecialchars($_GET['mei'])?></td>
        </tr>
        <tr>
        <th>メールアドレス：</th>
        <td><?=htmlspecialchars($_GET['email'])?></td>
        </tr>
        <tr>
        <th>補足事項：</th>
        <!--nl2brはenterに対してbrタグを追加するためのもの-->
        <td><?=nl2br(htmlspecialchars($_GET['content']))?></td>
        </tr>
        <button type="submit" name="confirm" value="send">登録</button>
    </div>
    </form>
    <?php else: ?>
    <ul>
        <?php foreach ($errors as $msg): ?>
        <li><?= $msg ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <p>* は必須項目です</p>
    <form action="validation.php" method="get">
        <input type="hidden" value="$token">
        <label for="sei">*姓（セイ）:</label>
        <input type="text" name="sei" id="sei">
        <label for="mei">*名（メイ）:</label>
        <input type="text" name="mei" id="mei">
        <label for="email">*Eメール:</label>
        <input type="text" name="email" id="email">
        <label for="gender">性別</label>
        <label for="content">補足事項(100文字以内):</label>
        <textarea rows="10" name="content" id="content">
            </textarea>
        <input type="submit" value="送信">
    </form>
    <form action="member.php">
        <input type="submit" value="一覧確認">
    </form>
    <?php endif; ?>
</body>
</html>