<?php

declare(strict_types=1);

class Response {

    public static function render($viewName, $viewData = null)
    {
        if (!$viewData) {
            $viewData = ['pageTitle' => 'Document'];
        }
        $viewData;
        require_once(__DIR__ . "../../views/$viewName.view.php");
    }

    public static function json($Data)
    {
        echo json_encode($Data);
        exit;
    }
}