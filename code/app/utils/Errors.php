<?php

declare(strict_types=1);

class Errors {

    private static $fieldErrors = [];

    public static function addField($message, $field)
    {
        Self::$fieldErrors[$field] = $message;
    }

    public static function fields()
    {
        return count(Self::$fieldErrors) > 0 ? true : false;
    }

    public static function getFields()
    {
        $data = [
            'code' => 400,
            'success' => false,
            'fieldErrors' => Self::$fieldErrors,
        ];
        return $data;
    }
}