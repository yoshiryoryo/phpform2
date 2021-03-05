<?php
    function validation($request) {
        $errors = [];

        if (empty($request['sei'])) {
            $errors[] = 'は必須です。';
        } elseif () {

        }

        if (empty($request['mei'])) {
            $errors[] = '年齢は必須です。';
        }

        return $errors;
    }
?>