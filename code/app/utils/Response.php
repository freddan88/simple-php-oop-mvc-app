<?php

declare(strict_types=1);

class Response {

    public static function render($viewName, $viewData = null, $viewPath = '')
    {
        $viewPath = $viewPath ? 'views/' . trim($viewPath,'/') : 'views';
        $viewData = $viewData ? $viewData : ['pageTitle' => 'Document'];
        $viewData = (object) $viewData;
        require_once(__DIR__ . "../../../$viewPath/$viewName.view.php");
        exit;
    }

    public static function json($Data)
    {
        echo json_encode($Data);
        exit;
    }

    public static function redirect($path)
    {
        header("Location: $path");
        exit;
    }
}