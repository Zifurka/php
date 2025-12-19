<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Загрузка файла на сервер</title>
</head>
<body>
  <div>
   <?php
/*
ЗАДАНИЕ
- Проверьте, отправлялся ли файл на сервер
- В случае, если файл был отправлен, выведите: имя файла, размер, имя временного файла, тип, код ошибки
- Для проверки типа файла используйте функцию mime_content_type() из модуля Fileinfo
- Если загружен файл типа "image/jpeg", то с помощью функции move_uploaded_file() переместите его в каталог upload. В качестве имени файла используйте его MD5-хеш.
*/

// Проверяем, отправлялся ли файл на сервер
if (isset($_FILES['fupload']) && $_FILES['fupload']['error'] != UPLOAD_ERR_NO_FILE) {
    echo "<h3>Информация о загруженном файле:</h3>";
    
    // Получаем информацию о файле
    $fileName = $_FILES['fupload']['name'];
    $fileSize = $_FILES['fupload']['size'];
    $tmpName = $_FILES['fupload']['tmp_name'];
    $errorCode = $_FILES['fupload']['error'];
    
    // Выводим информацию о файле
    echo "Имя файла: " . htmlspecialchars($fileName) . "<br>";
    echo "Размер файла: " . $fileSize . " байт<br>";
    echo "Имя временного файла: " . $tmpName . "<br>";
    
    // Определяем MIME-тип файла
    if (function_exists('mime_content_type') && file_exists($tmpName)) {
        $fileType = mime_content_type($tmpName);
        echo "Тип файла (MIME): " . $fileType . "<br>";
    } else {
        $fileType = $_FILES['fupload']['type'];
        echo "Тип файла (из формы): " . $fileType . "<br>";
    }
    
    echo "Код ошибки: " . $errorCode . "<br>";
    
    // Проверяем, нет ли ошибок при загрузке
    if ($errorCode === UPLOAD_ERR_OK) {
        // Если загружен файл типа "image/jpeg"
        if ($fileType === 'image/jpeg') {
            // Создаем каталог upload, если он не существует
            $uploadDir = 'upload/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Создаем файл .htaccess для разрешения просмотра директории
            $htaccessFile = $uploadDir . '.htaccess';
            if (!file_exists($htaccessFile)) {
                file_put_contents($htaccessFile, "Options All +Indexes\n");
            }
            
            // Вычисляем MD5-хеш файла
            $fileHash = md5_file($tmpName);
            $newFileName = $uploadDir . $fileHash . '.jpg';
            
            // Перемещаем файл в каталог upload
            if (move_uploaded_file($tmpName, $newFileName)) {
                echo "<div style='color: green; font-weight: bold;'>";
                echo "Файл успешно загружен!<br>";
                echo "Новое имя файла: " . $fileHash . '.jpg' . "<br>";
                echo "Путь: " . $newFileName;
                echo "</div>";
            } else {
                echo "<div style='color: red;'>Ошибка при перемещении файла!</div>";
            }
        } elseif (!empty($fileType)) {
            echo "<div style='color: orange;'>";
            echo "Файл не является JPEG-изображением (тип: " . $fileType . "). Загрузка не выполнена.";
            echo "</div>";
        }
    } else {
        // Выводим сообщение об ошибке
        $errorMessages = array(
            UPLOAD_ERR_INI_SIZE => 'Файл превышает размер, указанный в upload_max_filesize в php.ini',
            UPLOAD_ERR_FORM_SIZE => 'Файл превышает размер, указанный в MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'Файл был загружен только частично',
            UPLOAD_ERR_NO_FILE => 'Файл не был загружен',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
            UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла'
        );
        
        echo "<div style='color: red; font-weight: bold;'>";
        echo "Ошибка загрузки: ";
        echo isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : "Неизвестная ошибка";
        echo "</div>";
    }
    
    echo "<hr>";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<div style='color: red;'>Файл не был выбран для загрузки!</div><hr>";
}
   ?>

  </div>
  <form enctype="multipart/form-data"
        action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <p>
      <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
      <input type="file"   name="fupload"><br>
      <button type="submit">Загрузить</button>
    </p>
   </form>
   
   <div style="margin-top: 20px;">
    <h3>Примечания:</h3>
    <ul>
        <li>Максимальный размер файла: 10 МБ (10485760 байт)</li>
        <li>Принимаются только JPEG-изображения (MIME-тип: image/jpeg)</li>
        <li>Загруженные файлы сохраняются в каталоге <code>upload/</code> под именем, соответствующим MD5-хешу файла</li>
        <li>Для просмотра загруженных файлов откройте: <a href="upload/" target="_blank">каталог upload</a></li>
    </ul>
   </div>
 </body>
</html>
