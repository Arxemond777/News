<!DOCTYPE html>
<html>
    <head>
        <title>Новостная лента</title>
        <meta charset="utf-8" />
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Последние новости (выводится 5 последних по новизне)</h1>
        <a href="news.php">Добавить новость</a>
        <a href="delete_news.php">Удалить новость</a>

        <form action="" method="post">
            Введите название интересующий Вас картегрии:<br />
            <!--input type="text" name="category" /><br /-->
            <select name="category" id="category">
                <option value="1">Политика</option>
                <option value="2">Культура</option>
                <option value="3">Спорт</option>
            </select>
            <br>
            <input type="submit" value="Просмотреть новости из этой категории!" name="submit_category"/>
        </form>

        <form action="" method="post">
            Выберите интересующий Вас интервал дат:<br />
            Дата начала <input type="date" name="date_start" /><br />
            Дата конца <input type="date" name="date_end" /><br />
            <input type="submit" value="Просмотреть новости за эту дату!" name="submit_date"/>
        </form>
    </body>
</html>


<?php
include('NewsDB.class.php');
//print_r($_POST);
if (!empty($_POST['category'])
    && (
        $_POST['category'] == '1'//Politics
        || $_POST['category'] == '2'//Culture
        || $_POST['category'] == '3'//Sport
    ))
{
    $obj->category = $_POST['category'];
    $obj->getNews();
}

if(!empty($_POST['date_start'])  || !empty($_POST['date_end'])){
    $obj->date_start = $_POST['date_start'];
    $obj->date_end = $_POST['date_end'];
    $obj->getNews();
}
