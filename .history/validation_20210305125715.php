<?php
    function validation($request) {
        $errors = [];

        if (empty($request['sei'])) {
            $errors[] = '姓（セイ）は必須です。';
        } elseif () {

        }

        if (empty($request['mei'])) {
            $errors[] = '名（メイ）は必須です。';
        } elseif () {

        }

        if (empty($request['email'])) {
            $errors[] = 'メールアドレスは必須です。';
        } elseif  {

        }

        return $errors;
    }
?>