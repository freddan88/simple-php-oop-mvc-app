<?php

declare(strict_types=1);

class Response {

    /**
     * Usage: Response::render('viewName', [viewData] Optional, 'viewPath' Optional - Root = /views)
     * OBS: ViewData will be transformed to an object and passed to selected view [stdClass]
     * 
     * @param string $viewName
     * @param array $viewData
     * @param string $viewPath
     * @return void
     */
    public static function render($viewName, $viewData = [], $viewPath = '')
    {
        $viewPath = $viewPath ? 'views/' . trim($viewPath,'/') : 'views';
        $viewData = empty($viewData) ? ['pageTitle' => 'Document'] : $viewData;
        $viewData = (object) $viewData;
        require_once(__DIR__ . "../../../$viewPath/$viewName.view.php");
        exit;
    }

    /**
     * Usage: Response::json([data])
     *
     * @param array $apiData
     * @return void
     */
    public static function json($apiData)
    {
        echo json_encode($apiData);
        exit;
    }

    /**
     * Usage: Response::json('urlPath')
     *
     * @param string $urlPath
     * @return void
     */
    public static function redirect($urlPath)
    {
        header("Location: $urlPath");
        exit;
    }
}