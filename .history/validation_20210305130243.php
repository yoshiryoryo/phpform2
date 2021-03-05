<?php
    function validation($request) {
        $errors = [];

        if (empty($request['sei'])) {
            $errors[] = '「姓（セイ）」は必須です。';
        } elseif (preg_match("/^[ァ-ヶー]+$/u", $request['sei'])) {
            $errors[] = "「全角カタカナ」で入力してください";
        }

        if (empty($request['mei'])) {
            $errors[] = '「名（メイ）」は必須です。';
        } elseif  (preg_match("/^[ァ-ヶー]+$/u", $request['mei'])) {
            $errors[] = "「全角カタカナ」で入力してください";
        }

        if (empty($request['email'])) {
            $errors[] = 'メールアドレスは必須です。';
        } elseif  (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] '正しいEメールアドレスを指定してください。';
          }

        return $errors;
    }
?>