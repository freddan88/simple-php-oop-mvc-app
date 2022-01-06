<?php
    $metaTitle = $viewData->metaTitle ?? 'Document';
    $metaAuthor = $viewData->metaAuthor ?? 'Me';
    $metaKeywords = $viewData->metaKeywords ?? 'WEB, MVC, PHP';
    $metaDescription = $viewData->metaDescription ?? 'This is my webpage';
    $pageJavascriptFileNames = empty($viewData->pageJavascriptFileNames) ? [] : $viewData->pageJavascriptFileNames;
    $pageStyleSheetFileNames = empty($viewData->pageStyleSheetFileNames) ? [] : $viewData->pageStyleSheetFileNames;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= $metaDescription ?>" />
    <meta name="keywords" content="<?= $metaKeywords ?>" />
    <meta name="author" content="<?= $metaAuthor ?>" />
    <title><?= $metaTitle ?></title>

    <?php if($viewData->useMainStylesheet): ?>
        <link type="text/css" rel="stylesheet" href="assets/main.css" />
    <?php endif; ?>

    <?php foreach ($pageStyleSheetFileNames as $styleSheetFileName): ?>
        <?php $styleSheetFilePath = "assets/styles/$styleSheetFileName.css" ?>
        <link type="text/css" rel="stylesheet" href="<?= $styleSheetFilePath ?>" />
    <?php endforeach; ?>

    <?php if($viewData->useMainJavascript): ?>
        <script defer type="text/javascript" src="assets/main.js"></script>
    <?php endif; ?>

    <?php foreach ($pageJavascriptFileNames as $javascriptFileName): ?>
        <?php $javascriptFilePath = "assets/scripts/$javascriptFileName.js" ?>
        <script defer type="text/javascript" src="<?= $javascriptFilePath ?>"></script>
    <?php endforeach; ?>

</head>