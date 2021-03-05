<?php
//var_dump($clean);

// 変数の初期化
$page_flag = 0;
$clean = array();
$error = array();

// サニタイズ
if( !empty($_POST) ) {
	foreach( $_POST as $key => $value ) {
		$clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	} 
}

if( !empty($clean['btn_confirm']) ) {

	$error = validation($clean);

	if( empty($error) ) {
		$page_flag = 1;
	}

} elseif( !empty($clean['btn_submit']) ) {

--- 省略 ---

	// 管理者へメール送信
	mb_send_mail( 'webmaster@gray-code.com', $admin_reply_subject, $admin_reply_text, $header);
}

function validation($data) {

	$error = array();

	// 氏名のバリデーション
	if( empty($data['your_name']) ) {
		$error[] = "「氏名」は必ず入力してください。";
	}

	return $error;
}
?>