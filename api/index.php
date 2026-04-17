<?php
$uri = $_SERVER['REQUEST_URI'];
$basePath = __DIR__ . '/..';

// Remove query strings
$path = parse_url($uri, PHP_URL_PATH);

if ($path === '/' || empty($path)) {
    require $basePath . '/index.php';
} else if (file_exists($basePath . $path)) {
    if (str_ends_with($path, '.php')) {
        require $basePath . $path;
    } else {
        // Let Vercel serve static files
        return false;
    }
} else {
    require $basePath . '/index.php';
}
