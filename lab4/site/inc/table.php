<!DOCTYPE html>
<html lang="ru">
    <!-- Верхняя часть страницы -->
    <?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$cols = abs((int) $_POST['cols']);
	$rows = abs((int) $_POST['rows']);
	$color = trim(strip_tags($_POST['color']));
}else{
    $cols = 10;
    $rows = 10;
    $color = '#ffff00';
}
?>

    <!-- Верхняя часть страницы -->

   <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
  <label>Количество колонок: </label><br>
  <input name="cols" type="text" value="<?= htmlspecialchars($cols) ?>"><br>

  <label>Количество строк: </label><br>
  <input name="rows" type="text" value="<?= htmlspecialchars($rows) ?>"><br>

  <label>Цвет: </label><br>
  <input name="color" type="color" value="<?= htmlspecialchars($color) ?>" list="listColors"><br>

  <datalist id="listColors">
    <option>#ff0000</option>
    <option>#00ff00</option>
    <option>#0000ff</option>
    <option>#ffff00</option>
  </datalist>
      <br>
  <input type="submit" value="Создать">
</form>
    <br>
    <!-- Таблица -->
    <?php drawTable($cols, $rows, $color); ?>
    
    <!-- Таблица -->
    <!-- Область основного контента -->
 
    <!-- Нижняя часть страницы -->
    <!-- Нижняя часть страницы -->
 
</html>
