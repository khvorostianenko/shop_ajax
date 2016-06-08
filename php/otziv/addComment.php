<meta charset="utf-8">
<?php

include_once 'const.php';

function ReadAntimat( $filename ) {

 If ( !($rows = fileToArray( $filename )) )
     return [];

 return $rows;
}

function countOtziv(){
    $counter = 0;
    if(file_exists('../../data/counter.txt')){
        $counter = file_get_contents('../../data/counter.txt');
        $counter++;
        $f = fopen('../../data/counter.txt','w+');
        fwrite($f,$counter);
        fclose($f);
    }
    else{
        $f = fopen('../../data/counter.txt','w+');
        fwrite($f,0);
        fclose($f);
    }
    return $counter;
}

function pathForImageAndComment($counter){
    $baza = "../../data/images_for_comments/".$_REQUEST['idTovar']."/";
    if(!file_exists($baza)) mkdir($baza);
    $baza .= $counter."/";
    if(!file_exists($baza)) mkdir($baza);
    return $baza;
}

function images($counter)
{
        $photos = '';
        foreach ($_FILES['filename']['type'] as $i=>$value)
        {
            switch($_FILES['filename']['type'][$i])
            {
                case 'image/jpeg': $ext = 'jpg'; break;
                case 'image/gif':  $ext = 'gif'; break;
                case 'image/png':  $ext = 'png'; break;
                case 'image/tiff': $ext = 'tif'; break;
                default:           $ext = '';    break;
            }
            if ($ext)
            {
                $put = pathForImageAndComment($counter);
                $full_path_for_image = $put."image".$i.".".$ext;
                move_uploaded_file($_FILES['filename']['tmp_name'][$i], $full_path_for_image);
                $photos .= "<img src='{$full_path_for_image}'>";
            }
        }
        return ($photos)?(';'.$photos):($photos);
}

function comments($counter, $lowerStr){
        $put = pathForImageAndComment($counter);
        $full_path_for_comment = $put."comment.txt";
        file_put_contents($full_path_for_comment, $lowerStr);
        return ";".$full_path_for_comment;
}

 $antimat = ReadAntimat(ANTIMAT);
 $replaces= ReadAntimat(FILE_REPLACES);
 $handle = fopen(FILENAME, 'a');
if (isset($_POST['idTovar']))
{
     $counter = countOtziv();
     $lowerStr = mb_strtolower( $_REQUEST['comment'], 'UTF-8');
     $path_to_comment = comments($counter, $lowerStr);
     if(isset($_FILES['filename']['name'])) $path_to_image = images($counter);
     $lowerStr  =  str_replace( $antimat, $replaces, $lowerStr );
     //[0] = счетчик; [1] = Номер товара; [2] = имя покупателя; [3] = время; [4] = путь к комментарию; [5] = ссылка на картинки
     $toWrite = $counter. ';' .$_REQUEST['idTovar'] . ';' . $_REQUEST['nameCustomer'] . ';' .
                date('H:i:s') . $path_to_comment. $path_to_image . PHP_EOL;
     fwrite($handle, $toWrite);
     fclose($handle);
}

 include_once 'showComment.php';
?>