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
?>