<!--<!DOCTYPE html>-->
<!--<html lang="ru">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Гостевая книга</title>-->
<!--    <script>-->
<!--        function confirmDelete() {-->
<!--            return confirm("Вы уверены, что хотите удалить эту запись?");-->
<!--        }-->
<!--    </script>-->
<!--</head>-->
<!--<body>-->

<!--<h1>Гостевая книга</h1>-->

<!--?php-->
<!--require_once 'config.php';-->

<!--$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);-->
<!--mysqli_set_charset($conn, DB_CHARSET);-->

<!--if ($conn->connect_error) {-->
<!--    die("Connection failed: " . $conn->connect_error);-->
<!--}-->

<!--if ($_SERVER["REQUEST_METHOD"] == "POST") {-->
<!--    $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'])));-->
<!--    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));-->
<!--    $msg = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['msg'])));-->

<!--    $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";-->
<!--    if (mysqli_query($conn, $sql)) {-->
<!--        header("Location: " . $_SERVER['PHP_SELF']);-->
<!--        exit();-->
<!--    } else {-->
<!--        echo "Error: " . $sql . "<br>" . mysqli_error($conn);-->
<!--    }-->
<!--}-->

<!--if (isset($_GET['delete'])) {-->
<!--    $id = intval($_GET['delete']);-->
    <!--// Убедитесь, что вы удаляете только одну запись с указанным id-->
    <!--$sql = "DELETE FROM msgs WHERE id = $id LIMIT 1"; // Добавлено LIMIT 1-->
<!--    if (mysqli_query($conn, $sql)) {-->
<!--        header("Location: " . $_SERVER['PHP_SELF']);-->
<!--        exit();-->
<!--    } else {-->
<!--        echo "Error deleting record: " . mysqli_error($conn);-->
<!--    }-->
<!--}-->

<!--$sql = "SELECT * FROM msgs ORDER BY id DESC";-->
<!--$result = mysqli_query($conn, $sql);-->
<!--$count = mysqli_num_rows($result);-->

<!--echo "<p>Записей в гостевой книге: $count</p>";-->

<!--while ($row = mysqli_fetch_assoc($result)) {-->
<!--    echo "<p><strong>Имя:</strong> " . $row['name'] . "<br>";-->
<!--    echo "<strong>Email:</strong> " . $row['email'] . "<br>";-->
<!--    echo "<strong>Сообщение:</strong> " . $row['msg'] . "<br>";-->
<!--    echo "<a href='" . $_SERVER['PHP_SELF'] . "?delete=" . $row['id'] . "' onclick='return confirmDelete();'>Удалить</a></p>";-->
<!--}-->

<!--mysqli_close($conn);-->
<!--?>-->

<!--<form action="?php echo $_SERVER['PHP_SELF']; ?>" method="post">-->
<!--    Ваше имя:<br>-->
<!--    <input type="text" name="name" required><br>-->
<!--    Ваш E-mail:<br>-->
<!--    <input type="email" name="email" required><br>-->
<!--    Сообщение:<br>-->
<!--    <textarea name="msg" cols="50" rows="5" required></textarea><br>-->
<!--    <br>-->
<!--    <input type="submit" value="Добавить!">-->
<!--</form>-->

<!--</body>-->
<!--</html>-->


<?php
/**
 * Гостевая книга — точное соответствие стилю с фото
 */

require_once 'config.php';

header('Content-Type: text/html; charset=utf-8');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    die('Ошибка подключения к БД: ' . htmlspecialchars($mysqli->connect_error));
}

$mysqli->set_charset(DB_CHARSET);

// Удаление записи
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $mysqli->prepare("DELETE FROM msgs WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;
}

// Добавление записи
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg = trim($_POST['msg'] ?? '');

    if ($name !== '' && $email !== '' && $msg !== '') {
        $stmt = $mysqli->prepare("INSERT INTO msgs (name, email, msg) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $msg);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;
}

// Выборка всех записей
$result = $mysqli->query("SELECT id, name, email, msg FROM msgs ORDER BY id DESC");
$mysqli->close(); // Закрываем соединение
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Гостевая книга</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], textarea {
            width: 300px;
            padding: 5px;
            box-sizing: border-box;
        }
        textarea { height: 100px; }
        .message {
            border-top: 1px solid #ccc;
            padding: 15px 0;
            margin: 15px 0 0 0;
        }
        .author-link {
            color: blue;
            text-decoration: underline;
            font-weight: bold;
        }
        .delete-link {
            float: right;
            color: blue;
            text-decoration: underline;
            font-size: 14px;
        }
    </style>
</head>
<body>

<h1>Гостевая книга</h1>

<form method="post" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>">
    <label>Ваше имя:</label>
    <input type="text" name="name" required>

    <label>Ваш E-mail:</label>
    <input type="email" name="email" required>

    <label>Сообщение:</label>
    <textarea name="msg" required></textarea>

    <br><br>
    <input type="submit" value="Добавить!">
</form>

<hr>

<?php
$count = $result->num_rows;
echo "<p>Записей в гостевой книге: <strong>$count</strong></p>";

if ($count > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="message">';
        echo '<a href="mailto:' . htmlspecialchars($row['email']) . '" class="author-link">' . htmlspecialchars($row['name']) . '</a>';
        echo '<div>' . nl2br(htmlspecialchars($row['msg'])) . '</div>';
        echo '<a href="?delete=' . $row['id'] . '" class="delete-link" onclick="return confirm(\'Удалить запись?\')">Удалить</a>';
        echo '</div>';
    }
} else {
    echo '<p>Пока нет записей.</p>';
}
?>

</body>
</html>