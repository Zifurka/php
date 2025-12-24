<?php
$dir = '.';
$files = scandir($dir);
$allowed = ['jpg', 'jpeg', 'png', 'webp']; // Добавил чуть больше форматов
$images = [];

foreach ($files as $file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $allowed)) {
        $images[] = $file;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Photos Style Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #ffffff;
            --text-color: #3c4043;
            --header-height: 64px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding-top: var(--header-height);
            color: var(--text-color);
        }

        /* Шапка в стиле Google */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: #fff;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 2px 6px 2px rgba(60,64,67,0.15);
            z-index: 1000;
        }

        header .logo {
            font-size: 22px;
            font-weight: 500;
            color: #5f6368;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Контейнер галереи */
        .container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 16px;
        }

        .gallery {
            display: grid;
            /* Делаем сетку более плотной, как в оригинале */
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            grid-auto-rows: 180px;
            gap: 12px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px; /* Фирменное закругление */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s;
            cursor: pointer;
            background-color: #f1f3f4;
        }

        /* Эффект при наведении */
        .gallery-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Адаптивность для мобилок */
        @media (max-width: 600px) {
            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                grid-auto-rows: 120px;
                gap: 4px;
            }
            .gallery-item {
                border-radius: 4px;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="#4285F4" d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM8 20H4v-4h4v4zm0-6H4v-4h4v4zm0-6H4V4h4v4zm6 12h-4v-4h4v4zm0-6h-4v-4h4v4zm0-6h-4V4h4v4zm6 12h-4v-4h4v4zm0-6h-4v-4h4v4zm0-6h-4V4h4v4z"/></svg>
            Google Фото <span style="font-size: 14px; color: #888;">(Demo)</span>
        </div>
    </header>

    <div class="container">
        <div class="gallery">
            <?php if (empty($images)): ?>
                <p>Изображения не найдены в папке.</p>
            <?php else: ?>
                <?php foreach ($images as $image): ?>
                    <div class="gallery-item">
                        <img src="<?= htmlspecialchars($image) ?>" alt="Photo" loading="lazy">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>