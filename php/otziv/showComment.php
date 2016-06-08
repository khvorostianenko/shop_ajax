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
//            echo 'До обаботки трушкой';
//            echo $parts[5];
            $photoPosleTrue= isset($parts[5])? returnTrueImages($parts[5]): false ;
//            echo "<br><br><br><br><br><br><br><br>";
//            echo 'После обаботки трушкой';
//            echo $photoPosleTrue;
//            echo 'До вывода отзыва';
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
?>