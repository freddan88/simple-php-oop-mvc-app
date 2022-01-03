<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class NotFoundController {

    public static function jsonResponse()
    {
        $jsonData = [
            'code' => 501,
            'message' => 'Not Implemented',
        ];
        Response::json($jsonData);
    }
}