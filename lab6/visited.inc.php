<?php
if (isset($_COOKIE[session_name()])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $pages = $_SESSION['visited_pages'] ?? [];
} else {
    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    $storageFile = __DIR__ . '/sess_' . $fingerprint;
    $pages = file_exists($storageFile) ? json_decode(file_get_contents($storageFile), true) : [];
}

if (!empty($pages)) {
?>
    <h3>Список посещённых страниц:</h3>
    <ul>
        <?php foreach ($pages as $page) : ?>
            <li><?php echo htmlspecialchars($page); ?></li>
        <?php endforeach; ?>
    </ul>
<?php
} else {
    echo '<p>Список посещённых страниц пуст.</p>';
}
?>