<meta charset="utf-8">
<?php
    
    session_start();
    
    if ( !isset($_POST['login']) || !isset($_POST['password']) ) {
       echo 'Недостаточно параметров';
       exit(-1); 
    }
    
    if (isset($_SESSION['login']))
        unset($_SESSION['login']); 
    
    $str = file_get_contents('../../data/secret.txt');
    
    $arrAdmin = explode(';', $str);
    
    if( $arrAdmin[0] == $_POST['login'] && $arrAdmin[1] == $_POST['password'] ) {
        
        $_SESSION['login'] = $_POST['login'];
        echo "Авторизация прошла успешно";
        include_once ('admin_photo.php');
    }
    else
        echo 'Неверное значение имени и пароля!';