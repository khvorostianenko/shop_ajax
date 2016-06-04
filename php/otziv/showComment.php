<meta charset="utf-8">
<?php

    include_once 'const.php';

    If ( !($rows = fileToArray(FILENAME)) )
        exit(-1);
    //var_dump($rows);
    $count = count($rows);
    $i = 0; //Счетчит отвечает за строк файла db
    foreach ( $rows as $row ) {
        $i++;
        if($i!=$count)
        {
            $parts = explode(';', $row);// explode — Разбивает строку $row с помощью разделителя ;
            $photos = (isset($parts[5])?($parts[5].'<br>'):(''));
            if(isset($_GET['Fl'])){$photos = str_replace("../../","",$photos);}
            if ($parts[1] == $_REQUEST['idTovar']) {
                echo $parts[0].' '.$parts[4] . '<br> Пользователь ' . $parts[2] . ' написал: <br>' . $parts[3] . '<br>'.$photos;
            }
        }
        else
            break;
    }
?>