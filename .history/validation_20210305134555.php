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
        <td><?=nl2br(htmlspecialchars($_GET['text']))?></td>
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
        <label for="sei">*姓（セイ）</label>
        <input type="text" name="sei" id="sei">
        <label for="mei">*名（メイ）</label>
        <input type="text" name="mei" id="mei">
        <label for="email">*Eメール</label>
        <input type="text" name="email" id="email">
        <label for="content">*お問い合わせ内容(255文字以内)</label>
        <textarea rows="10" name="text" id="content">
            </textarea>
        <input type="submit" value="送信">
    </form>
    <?php endif; ?>
</body>
</html>