<?php
$currentPage = $_SERVER['REQUEST_URI'];

if (isset($_COOKIE[session_name()])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['visited_pages'])) {
        $_SESSION['visited_pages'] = []; 
    }
    $pages = &$_SESSION['visited_pages'];
} else {
    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    $storageFile = __DIR__ . '/sess_' . $fingerprint;
    
    $pages = file_exists($storageFile) ? json_decode(file_get_contents($storageFile), true) : [];
}

if (empty($pages) || end($pages) !== $currentPage) {
    $pages[] = $currentPage;

    if (!isset($_COOKIE[session_name()])) {
        file_put_contents($storageFile, json_encode($pages));
    }
}
?>