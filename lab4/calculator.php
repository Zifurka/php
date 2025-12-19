<?php
 declare(strict_types=1);

 $result = null;

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	 $num1 = $_POST['num1'];
	 $num2 = $_POST['num2'];
	 $operator = $_POST['operator'];

	 if (is_numeric($num1) && is_numeric($num2)) {
	     $num1 = (float) $num1;
	     $num2 = (float) $num2;

         switch ($operator) {
         case '+':
             $result = $num1 + $num2;
             break;
         case '-':
             $result = $num1 - $num2;
             break;
         case '*':
             $result = $num1 * $num2;
             break;
         case '/':
             $result = $num2 != 0 ? $num1 / $num2 : 'На ноль делить нельзя!';
             break;
         }
     }
 }
?>
<!DOCTYPE html>
<html lang="ru">
 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Калькулятор</title>
 </head>
 <body>

  <h1>Калькулятор</h1>

  <?php
   if (is_numeric($result)) {
       echo $num1, ' ', $operator, ' ', $num2, ' = ';
   }
   echo $result;
  ?>

  <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
   <p>
    <label for="num1">Число 1</label>
    <br>
    <input type="text" name="num1" id="num1" required>
   </p>
   <p>
    <label for="operator">Оператор</label>
    <br>
    <select name="operator" id="operator">
     <option value="+" selected>+</option>
     <option value="-">-</option>
     <option value="*">*</option>
     <option value="/">/</option>
    </select>
   </p>
   <p>
    <label for="num2">Число 2</label>
    <br>
    <input type="text" name="num2" id="num2" required>
   </p>
   <button type="submit">Считать!</button>
  </form>

 </body>
</html>
