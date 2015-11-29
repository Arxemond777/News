<?php
ini_set('display_errors',2);//TODO
date_default_timezone_set('Etc/GMT+3');//TODO

class MyClass {

    function __autoload($class_name1){
        require $class_name1.'.php';
    }

}

$obj = new MyClass();
$obj->__autoload('INewsDB.class');

class NewsDB implements INewsDB {

    private $mysqli;
    private $dblocation = 'localhost';
    public $news;
    public $errMsq = '';
    private $dt;
    public $category;

    public $date_start;
    public $date_end;

    public function __construct($dbname){

        $this->mysqli = new mysqli($this->dblocation, 'root', '', $dbname);
        if (!$this->mysqli) {
            die('Error connection: ' . mysql_error());
        } else {
            //echo 'Suecces conection';
        }
        if(!mysqli_select_db($this->mysqli, $dbname)){
            if(mysql_query("CREATE DATABASE ".$dbname)){
                echo '<br> BD '.$dbname.' create success';
            }

            $sql = "CREATE TABLE MyGuests (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        title VARCHAR(100) NOT NULL,
                        category INT(100),
                        description VARCHAR(150),
                        source VARCHAR(50),
                        datetime TIMESTAMP
                    )";
            if(mysql_db_query($dbname, $sql)){
                echo '<br> BD MyGuests success create';
            }
            $sql = "CREATE TABLE category (
                        id INT(6),
                        name VARCHAR(100)
                    )";
            if(mysql_db_query($dbname, $sql)){
                echo '<br> BD category success create';
            }

            $sql = "INSERT INTO category(id, name)
                   VALUES
                   (1, 'Politics'),
                   (2, 'Culture'),
                   (3, 'Sport')";
            if(mysql_db_query($dbname, $sql)){
                echo '<br> BD category insert success';
            }
        } else {
            //echo '<br> БД существует';
        }

    }

    /*public function __destruct(){
        mysql_close($this->mysqli);
    }*/

    function saveNews($title, $category, $description, $source){
        $this->dt = new DateTime('now', new DateTimeZone('MSK'));
        $date = $this->dt->format('Y-m-d H:i:s');
        $sql = "INSERT INTO MyGuests(title, category, description, source, datetime)
                   VALUES
                   ('".$title."', ".$category.", '".$description."', '".$source."', '".$date."')";
        if(mysql_query($sql)){
            echo '<br> Insert save News success';
        }

    }

    function getNews(){
       print_r($_POST);
        if(!empty($this->category)){
            $str = '';
            $sql_check_results = 'SELECT MyGuests.id from MyGuests where MyGuests.category = '.$this->category.';';
            $limit = '';
            if(mysql_query($sql_check_results)){
                $check_results = mysql_num_rows(mysql_query($sql_check_results));
                $check_results<5 ? $limit = $check_results : $limit = 5;
            }
            $this->category == 1 ? $this->category = 'Politics' : $this->category;
            $this->category == 2 ? $this->category = 'Culture' : $this->category;
            $this->category == 3 ? $this->category = 'Sport' : $this->category;
            /*$sql = "
                SELECT
                  MyGuests.id, MyGuests.title,
                  category.name, MyGuests.description,
                  MyGuests.source, MyGuests.datetime
                FROM category, MyGuests
                where category.id = MyGuests.category and category.name = '".$this->category."'
                ORDER BY MyGuests.datetime DESC limit ".$limit.";
            ";*/
            $stp = $this->mysqli->prepare("
                SELECT
                  MyGuests.id, MyGuests.title,
                  category.name, MyGuests.description,
                  MyGuests.source, MyGuests.datetime
                FROM category, MyGuests
                where category.id = MyGuests.category and category.name = '?'
                ORDER BY MyGuests.datetime DESC limit ?;
            ");
            //$stp->bind_param('CN',$this->category);
            print_r($stp->bind_param("sn", $limit));die;


            print_r($stp->execute());die;

            if(mysqli_stmt_execute($sql)){
                for($i=0; $i<$limit; $i++){
                    if(!empty(mysql_result(mysql_query($sql), $i))){
                        $str .=
                            '<tr>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 0).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 1).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 2).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 3).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 4).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 5).'</td>'.
                            '</tr>';
                    }
                }
                echo '
                    <table border="1" class="table">
                      <tbody>
                        <td>id</td>
                        <td>title</td>
                        <td>name category</td>
                        <td>description</td>
                        <td>source</td>
                        <td>datetime</td>
                      </tbody>
                      '.$str.'
                    </table>
                ';
            }
            mysqli_stmt_execute($sql);
        }

        if(!empty($this->date_start) || !empty($this->date_end)){
            if(!empty($this->date_start) && !empty($this->date_end)){
                $date_start = $this->date_start;
                $date_end = $this->date_end;
                $sql = '';
                $limit = '';
                if($date_start > $date_end){//если дата конца раньше даты начала
                    echo 'Вы ввели дату начала раньше даты конца';
                } else {
                    $sql_check_results = "
                      SELECT MyGuests.id from MyGuests
                      where
                      MyGuests.datetime > '".date('Y-m-d 00:00:00', strtotime($date_start))."'
                      and MyGuests.datetime < '".date('Y-m-d 23:59:59', strtotime($date_end))."'";
                    if(mysql_query($sql_check_results)){
                        $check_results = mysql_num_rows(mysql_query($sql_check_results));
                        $check_results<5 ? $limit = $check_results : $limit = 5;
                    }
                    $sql = "
                             SELECT
                               MyGuests.id, MyGuests.title,
                               category.name, MyGuests.description,
                               MyGuests.source, MyGuests.datetime
                             FROM category, MyGuests
                             where category.id = MyGuests.category
                             and MyGuests.datetime > '".date('Y-m-d 00:00:00', strtotime($date_start))."'
                             and MyGuests.datetime < '".date('Y-m-d 23:59:59', strtotime($date_end))."'
                             ORDER BY MyGuests.datetime DESC limit ".$limit.";
                           ";
                }
            } elseif (!empty($this->date_start)){
                //todo test3.MyGuests посмотри на 2 строки ниже
                $sql_check_results = "
                      SELECT MyGuests.id from MyGuests
                      where
                      MyGuests.datetime > '".date('Y-m-d 00:00:00', strtotime($this->date_start))."';";
                if(mysql_query($sql_check_results)){
                    $check_results = mysql_num_rows(mysql_query($sql_check_results));
                    $check_results<5 ? $limit = $check_results : $limit = 5;
                }
                $sql = "
                         SELECT
                           MyGuests.id, MyGuests.title,
                           category.name, MyGuests.description,
                           MyGuests.source, MyGuests.datetime
                         FROM category INNER JOIN MyGuests ON category.id = MyGuests.category
                         where MyGuests.datetime > '".date('Y-m-d 00:00:00', strtotime($this->date_start))."'
                         ORDER BY MyGuests.datetime DESC limit ".$limit.";
                       ";
            } elseif(!empty($this->date_end)){
                $sql_check_results = "
                      SELECT MyGuests.id from MyGuests
                      where
                      MyGuests.datetime < '".date('Y-m-d 23:59:59', strtotime($this->date_end))."';";
                if(mysql_query($sql_check_results)){
                    $check_results = mysql_num_rows(mysql_query($sql_check_results));
                    $check_results<5 ? $limit = $check_results : $limit = 5;
                }
                $sql = "
                             SELECT
                               MyGuests.id, MyGuests.title,
                               category.name, MyGuests.description,
                               MyGuests.source, MyGuests.datetime
                             FROM category, MyGuests
                             where category.id = MyGuests.category
                             and MyGuests.datetime < '".date('Y-m-d 23:59:59', strtotime($this->date_end))."'
                             ORDER BY MyGuests.datetime DESC limit ".$limit.";
                           ";
            }
            if(mysql_query($sql)){
                $str = '';
                for($i=0; $i<$limit; $i++){
                    if(!empty(mysql_result(mysql_query($sql), $i))){
                        $str .=
                            '<tr>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 0).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 1).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 2).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 3).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 4).'</td>'.
                            '<td>'.mysql_result(mysql_query($sql), $i, 5).'</td>'.
                            '</tr>';
                    }
                }
                if(!empty($str)) {
                    echo '
                    <table border="1" class="table">
                      <tbody>
                        <td>id</td>
                        <td>title</td>
                        <td>name category</td>
                        <td>description</td>
                        <td>source</td>
                        <td>datetime</td>
                      </tbody>
                      ' . $str . '
                    </table>
                ';
                } else {
                    $start = '';
                    $end = '';
                    if(!empty($this->date_start)) $start = ' c: '.$this->date_start;
                    if(!empty($this->date_end)) $end = ' по: '.$this->date_end;
                    echo "Не найдено результатов за заданный интервал дат".$start . $end;
                }
            }
        }

    }
    function deleteNews($id){
        if(!empty($id)){
            $sql_for_check = "SELECT * FROM MyGuests where id =".$id.";";//checking the existence of records
            if(mysql_result(mysql_query($sql_for_check), 0, 0)){
                $sql = "DELETE FROM MyGuests where id =".$id.";";
                if(mysql_query($sql)){
                    echo '<br> Delete news success with id = №'.$id;
                }
            } else {
                echo 'Заданного id = №'.$id.' нет в базе';
            }
        }
    }
}

$obj = new NewsDB('test3');


//$obj->query('test3');