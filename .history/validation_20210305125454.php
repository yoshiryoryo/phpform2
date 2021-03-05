<?php
    function validation($request) {
        $errors = [];

        if (empty($request['sei'])) {
            $errors[] = '氏名は必須です。';
        } else

        if (empty($request['mei'])) {
            $errors[] = '年齢は必須です。';
        }

        return $errors;
    }
?>