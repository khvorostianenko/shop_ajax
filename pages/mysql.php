<meta charset="UTF-8">
<?php
    $db_hostname = 'localhost';
    $db_database = 'shoprk';
    $db_username = 'admin';
    $db_password = 'admin';
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);

    if(!$db_server){
        die ("Невозможно подключиться к mySQL: ".mysql_error());
    } else {
        //echo 'Вы успешно подключились к серверу<br>';
    }

    mysql_select_db($db_database) or die('Невозможно выбрать базу данных '.$db_database.' из-за ошибки '.mysql_error());
    //echo 'Вы подключились к базе '.$db_database.'<br>';

    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER SET 'utf8'");
    mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");

    $query = "SELECT * FROM categories";
    $result = mysql_query($query);
    if (!$result) die ('Сбой при доступе к базе данных: '.mysql_error().'<br>');

    function isChildren($parent){
    $query = "SELECT count(*) FROM categories WHERE parent=".$parent;
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    return $row[0];
}

function showCategory($parent = 0){
    $query = 'SELECT * FROM categories WHERE parent='.$parent.' ORDER BY showMethod';
    $result = mysql_query($query);
    $text = '';
    while($row = mysql_fetch_row($result)){
        $text.='<li>'.$row[1].'</li>';
        $new_parent = $row[0];
        if(isChildren($new_parent)){
            $text.= '<ul>'.showCategory($new_parent).'</ul>';
        } else {
            $queryTovar = 'SELECT name FROM tovaru WHERE categoriesKey='.$new_parent.' ORDER BY showMethod';
            $resultTovar = mysql_query($queryTovar);
            $text.= '<ul>';
            while($rowTovar = mysql_fetch_row($resultTovar)){
                $text.='<li>'.$rowTovar[0].'</li>';
            }
            $text.= '</ul>';
        }
    }
    return $text.'</ul>';
}
echo '<br><br>';
//echo (showCategory()); //Выводит все дерево с товарами

$queryTovar = 'SELECT name FROM tovaru ORDER BY categoriesKey, showMethod';
$resultTovar = mysql_query($queryTovar);
echo "<section class='row' style='text-align: center;'>";
while($rowTovar = mysql_fetch_row($resultTovar)){
    echo
    <<<_END
            <div class="col-sm-3">
                   $rowTovar[0]
            </div>
_END;
}
echo '</section>';

mysql_close($db_server);