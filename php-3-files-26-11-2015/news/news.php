<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Добавить лента</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>
<body>
  <h1>Добавить новости</h1>
  <a href="delete_news.php">Удалить новость</a>
  <a href="get_news.php">Просмотреть новости</a>
  <form action="" method="post">
    Заголовок новости:<br />
    <input type="text" name="title" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}?>" style="width: 412px"/><br />
    Выберите категорию:<br />
    <select name="category" id="category">
        <option value="1" <?= !empty($_POST['category']) && $_POST['category'] == 1 ? 'selected="selected"' : ''?>>Политика</option>
        <option value="2" <?= !empty($_POST['category']) && $_POST['category'] == 2 ? 'selected="selected"' : ''?>>Культура</option>
        <option value="3" <?= !empty($_POST['category']) && $_POST['category'] == 3 ? 'selected="selected"' : ''?>>Спорт</option>
        <?php
            if(!empty($_POST['category'])){

//                echo $_POST['category']==1 ? '<option value="1" selected="selected">Политика</option>' : '<option value="1">Политика</option>';
//                echo $_POST['category']==2 ? '<option value="2" selected="selected">Культура</option>' : '<option value="2">Культура</option>';
//                echo $_POST['category']==3 ? '<option value="3" selected="selected">Спорт</option>'    : '<option value="3">Спорт</option>';

//                echo '  <option value="1" '.$_POST['category']==1 ?  'selected="selected"' : 'selected=" "'.'>Политика</option>
//                        <option value="2" '.$_POST['category']==2 ? 'selected="selected"' : 'selected=" "'.'>Культура</option>
//                        <option value="3" '.$_POST['category']==3 ? 'selected="selected"' : 'selected=" "'.'>Спорт</option>
//                         ';
//                if($_POST['category'] == 1){
//                    echo '  <option value="1" selected="selected">Политика</option>
//                            <option value="2">Культура</option>
//                            <option value="3">Спорт</option>
//                         ';
//                } elseif($_POST['category'] == 2){
//                    echo '  <option value="1">Политика</option>
//                            <option value="2" selected="selected">Культура</option>
//                            <option value="3">Спорт</option>
//                         ';
//                } elseif($_POST['category'] == 3){
//                    echo '
//                            <option value="1">Политика</option>
//                            <option value="2">Культура</option>
//                            <option value="3" selected="selected">Спорт</option>
//                         ';
//                }
            }
        ?>
    </select>
    <br />
    Текст новости:<br />
    <textarea name="description" cols="50" rows="5"><?php if(!empty($_POST['description'])){echo $_POST['description'];}?></textarea><br />
    Источник:<br />
    <input type="text" name="source" value="<?php if(!empty($_POST['source'])){echo $_POST['source'];}?>" style="width: 412px"/><br />
    <br><div>Enter Captcha</div>
    <table>
      <tr>
        <td>
          <img src="captcha.php" width="365" height="60" id="captcha" alt="защитный код">
        </td>
        <td>
            <div id="style-captcha">
              <a id="link-captcha" href="#" onclick="document.getElementById('captcha').src='captcha.php?' + Math.random()">refresh</a>
            </div>
        </td>
      </tr>
    </table>
    Captcha:
    <br />
    <input type="text" name="captcha" /><br />
    <input type="submit" value="Добавить!" name="submit"/>
</form>

<?php
echo "<script type='text/javascript'>
    /*$(document).ready(function(){
        var val = document.getElementById('category');
        //return val.value;
        alert(val.value);
    });*/
</script>";
session_start();
if($_POST['captcha']!=$_SESSION['captcha']) {
  die('Error Captcha');
} else {
  include('NewsDB.class.php');
  if(isset($_POST['submit'])){
    if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['source'])){
      //header("Location: ".$_SERVER['HTTP_REFERER']."");
      $obj->saveNews($_POST['title'], $_POST['category'], $_POST['description'], $_POST['source']);
    } else {
      echo "Не заполенны все поля";die;
    }
  }
}
?>
</body>
</html>