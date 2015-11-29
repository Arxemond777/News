<!DOCTYPE html>
<html>
<head>
    <title>Удалить новость</title>
    <meta charset="utf-8" />
</head>
<body>
    <a href="news.php">Добавить новость</a>
    <a href="get_news.php">Просмотреть новости</a>

    <form action="" method="post">
        Id статьи для удаления:<br />
        <input type="text" name="id" /><br />
        <input type="submit" value="Удалить!" name="submit"/>
    </form>
</body>
</html>

<?php
include('NewsDB.class.php');
///print_r($_POST['id']);die;
if(!empty($_POST['id'])){
    $obj->deleteNews($_POST['id']);
}
