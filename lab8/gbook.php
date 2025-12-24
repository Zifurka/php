<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книга</title>
    <script>
        function confirmDelete() {
            return confirm("Вы уверены, что хотите удалить эту запись?");
        }
    </script>
</head>
<body>

<h1>Гостевая книга</h1>

<?php
require_once 'config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_set_charset($conn, DB_CHARSET);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'])));
    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
    $msg = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['msg'])));

    $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Убедитесь, что вы удаляете только одну запись с указанным id
    $sql = "DELETE FROM msgs WHERE id = $id LIMIT 1"; // Добавлено LIMIT 1
    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM msgs ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

echo "<p>Записей в гостевой книге: $count</p>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<p><strong>Имя:</strong> " . $row['name'] . "<br>";
    echo "<strong>Email:</strong> " . $row['email'] . "<br>";
    echo "<strong>Сообщение:</strong> " . $row['msg'] . "<br>";
    echo "<a href='" . $_SERVER['PHP_SELF'] . "?delete=" . $row['id'] . "' onclick='return confirmDelete();'>Удалить</a></p>";
}

mysqli_close($conn);
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Ваше имя:<br>
    <input type="text" name="name" required><br>
    Ваш E-mail:<br>
    <input type="email" name="email" required><br>
    Сообщение:<br>
    <textarea name="msg" cols="50" rows="5" required></textarea><br>
    <br>
    <input type="submit" value="Добавить!">
</form>

</body>
</html>
