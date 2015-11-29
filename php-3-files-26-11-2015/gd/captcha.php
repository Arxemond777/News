<img src="test.php" width="365" height="60">

<form action="" method="post">
    Введите капчу<br />
    <input type="text" name="captcha" /><br />
    <input type="submit" value="Отправить!" name="submit_category"/>
</form>
<?php

    if($_POST['captcha']!=$_SESSION['captcha']) {
        die("Неверно введены символы!");
    } else {
        echo 'Тут делаем все что должно быть,';
    }
