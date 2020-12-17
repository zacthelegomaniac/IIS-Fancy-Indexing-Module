<?php
// Get path
$path = $_SERVER['REQUEST_URI'];

// Correct characters from URL's path
if ($path != '/') {
 $path = str_replace('%20', ' ', $path);
 $path = str_replace('%27', '\'', $path);
}
?><!DOCTYPE html>

<html lang="en">
<head>
 <title>z14n.com | Index of: <?php echo $path; ?></title>

 <meta charset="UTF-8">
 <meta name="language" content="en">
 <meta name="author" content="Zachary Wilkinson">
 <meta name="reply-to" content="zacthelegomaniac@live.com">
 <meta name="generator" content="Notepad++">

 <link rel="icon" href="/FancyIndexing/gfx/bsd.png">
 <link rel="stylesheet" type="text/css" href="/FancyIndexing/includes/stylesheet.css">
 
 <link rel="preload" as="font" href="/FancyIndexing/fonts/Verdana Pro.woff2" type="font/woff2" crossorigin="anonymous">
 <link rel="preload" as="font" href="/FancyIndexing/fonts/Verdana Pro Bold.woff2" type="font/woff2" crossorigin="anonymous">
</head>
<body>

<div style="padding: 10px;"></div>
