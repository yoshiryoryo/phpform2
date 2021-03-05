<?php
    function validation($request) {
        $errors = [];

        if (empty($request['sei'])) {
            $errors[] = '「姓（セイ）」は必須です。';
        } elseif (preg_match("/^[ァ-ヶー]+$/u", $request['sei'])) {
            echo "「全角カタカナ」で入力してください";
        }

        if (empty($request['mei'])) {
            $errors[] = '「名（メイ）」は必須です。';
        } elseif  (preg_match("/^[ァ-ヶー]+$/u", $request['mei'])) {
            echo "「全角カタカナ」で入力してください";
        }

        if (empty($request['email'])) {
            $errors[] = 'メールアドレスは必須です。';
        } elseif  (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
            echo '正しいEメールアドレスを指定してください。';
          }

        return $errors;
    }
?>