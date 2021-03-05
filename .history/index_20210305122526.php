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

// バリデーション
function validation($data) {

	$error = array();

	// 姓（セイ）のバリデーション
	if( empty($data['sei']) ) {
		$error[] = "「姓（セイ）」は必ず入力してください。";
	}

    // 名（メイ）
    if( empty($data['sei']) ) {
		$error[] = "「名（メイ）」は必ず入力してください。";
	}　else

	// メールアドレスのバリデーション
	if( empty($data['email']) ) {
		$error[] = "「メールアドレス」は必ず入力してください。";
	}

	// 性別のバリデーション
	if( empty($data['gender']) ) {
		$error[] = "「性別」は必ず入力してください。";
	}

	// 年齢のバリデーション
	if( empty($data['age']) ) {
		$error[] = "「年齢」は必ず入力してください。";
	}

	// お問い合わせ内容のバリデーション
	if( empty($data['contact']) ) {
		$error[] = "「お問い合わせ内容」は必ず入力してください。";
	}

	// プライバシーポリシー同意のバリデーション
	if( empty($data['agreement']) ) {
		$error[] = "プライバシーポリシーをご確認ください。";
	}

	return $error;
}
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
    <form action="validate.php" method="get">
      <div>
        <tr>
            <th>姓（セイ）:</th>
            <td><input type="text" name="sei"></td>
        </tr>
        <tr>
            <th>名（メイ）:</th>
            <td><input type="text" name="mei"></td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <th>補足事項</th>
            <td><textarea name="text" id="" cols="5" rows="10"></textarea></td>
        </tr>
      </div>
      <button type="submit" name="confirm" value="send">確認</button>
      <button><a href="member.php">一覧確認</a></button>
    </form>   
</body>
</html>