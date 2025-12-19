<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['visited_pages']) && count($_SESSION['visited_pages']) > 0) {
?>
    <h3>Список посещённых страниц:</h3>
    <ul>
        <?php foreach ($_SESSION['visited_pages'] as $page) : ?>
            <li><?php echo htmlspecialchars($page); ?></li>
        <?php endforeach; ?>
    </ul>
<?php
} else {
    echo '<p>Список посещённых страниц пуст.</p>';
}
?>
