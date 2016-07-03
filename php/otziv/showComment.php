<meta charset="utf-8">
<?php
    function returnTrueImages($filename) {
        $images = '';
        $trueImages = file('../admin/true_image.txt');
        $dbImages = explode('>',$filename);
        for ($i = 0; $i < count ($dbImages)-1; $i++){
            for($j = 0; $j < count ($trueImages); $j++)
            {
                //нормально затримил $imageTek
                $imageTek = trim($trueImages[$j]);
                $nahogdenie = strpos($dbImages[$i], $imageTek);
                if($nahogdenie != false)
                {
                    echo "Нашло совпадение";
                    $images .= $dbImages[$i].'>';
                }
            }
        }
        return $images;
    }

    include_once 'const.php';

    If ( !($rows = fileToArray(FILENAME)) )
        exit(-1);
    $count = count($rows);
    $i = 0; //Счетчит отвечает за строк файла db
    foreach ( $rows as $row ) {
        $i++;
        if($i!=$count)
        {
            $parts = explode(';', $row);// explode — Разбивает строку $row с помощью разделителя ;
            $photoPosleTrue= isset($parts[5])? returnTrueImages($parts[5]): false ;
            $photoPosleTrue = isset($photoPosleTrue)?($photoPosleTrue.'<br>'):'';
            $comments = $parts[4];
            if(isset($_GET['Fl'])){
                $photoPosleTrue = str_replace("../../","",$photoPosleTrue);
            }
            if ($parts[1] == $_REQUEST['idTovar']) {
                //[0] = счетчик; [1] = Номер товара; [2] = имя покупателя; [3] = время; [4] = путь к комментарию; [5] = ссылка на картинки
                echo "id=".$parts[0].' '.$parts[3] . '<br> Пользователь ' . $parts[2] . ' написал: <br>' . file_get_contents($comments) . '<br>'.$photoPosleTrue;
            }
        }
        else
            break;
    }

    require_once '../../data/config_mysql.php';
    $query = "SELECT * FROM comments JOIN images ON comments.id_comment=images.id_comment WHERE id_tovar='{$_REQUEST['idTovar']}'";
    $resultT = mysql_query($query);
    while($rowTovar = mysql_fetch_assoc($resultT)){
        $photoMySql = htmlspecialchars_decode($rowTovar['img_path'],ENT_QUOTES);
        $photoMySql = str_replace("../../","",$photoMySql);
        echo "mysql_id=".$rowTovar['id_comment'].' '.$rowTovar['time']. '<br> Пользователь ' . $rowTovar['customer_name'] .
            ' написал: <br>' . $rowTovar['comment'] . '<br>'.$photoMySql.'<br><br>';
    }

?>