<?php
    function validation($request) {
        $errors = [];

        if (empty($request['name'])) {
            $errors[] = '氏名は必須です。';
        }

        if (empty($request['age'])) {
            $errors[] = '年齢は必須です。';
        }

        return $errors;
    }
?>