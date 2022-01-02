<?php

declare(strict_types=1);

class Response {

    public static function render($viewName, $viewData)
    {
        $viewData;
        require_once(__DIR__ . "../../views/$viewName.view.php");
    }

    public static function json($Data)
    {
        echo json_encode($Data);
        exit;
    }
}