<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<img src="test1.php" />

<form action="" method="POST">

    <input type="text" name="captcha_code">
    <input type="submit" value="OK" name="req">
</form>
</body>
</html>

<?php

session_start();

$code=$_SESSION['code'];

if($_POST['captcha_code']=="" || $_POST['captcha_code']==" ")
{
    die("Введите символы!");
}
else
{
    $p_code=$_POST['captcha_code'];
    if($p_code!=$code)
    {
        die("Неверно введены символы!");
    }
    else
    {
        echo 'Тут делаем все что должно быть,';
    }
}