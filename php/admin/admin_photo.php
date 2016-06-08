<meta charset="UTF-8">
<?php
function ShowAllImagesAndComments($path)
{
    global $arrImages;
    $pathImage = opendir($path);
    $text = '<ul>';
    while ( $file = readdir($pathImage) ) {
        if ( $file == '..' || $file == '.' )
            continue;
        elseif (filetype($path . '/' . $file) == 'dir'){
            $text .= '<li>'.$file  . '><br>' . ShowAllImagesAndComments( $path . '/' . $file ).'</li>';
        }
        else {
            $fullName = trim("$path/$file");
            if (strstr($fullName, 'txt'))
                {
                    $commentContent = file_get_contents($fullName);
                    $text.= "<div>
                                    <input type='text' hidden  form='fSavePerm' name='path_for_comment[]' value='{$fullName}'/>
                                    <textarea form='fSavePerm' name='comment[]'>{$commentContent}</textarea></div>";
                }
            else
                {
                $isChecked = in_array($fullName, $arrImages) ? 'checked' : '';
                foreach($arrImages as $value)
                  if ($fullName == trim($value) )
                    $isChecked = 'checked';
                $text .= "<div> $file <input type='checkbox' $isChecked  form='fSavePerm' name='images[]' 
                                value='$fullName'/><br> <img src='$fullName' width='50px' /> </div>";
                }

        }
    }
    return $text.'</ul>';
}

    if ( !isset($_SESSION['login']) ) {
         echo 'not login';
         exit(-1);
    }         

    echo "<br>Добро пожаловать в панель редактирования отзывов<br>";
    include_once ('../otziv/const.php');
    $arrImages = file_exists('true_image.txt') ? file('true_image.txt'): array();
?>
  <form method="post" action="save_permission.php" id="fSavePerm">
      <button value="submit"> Сохранить изменения! </button>
  </form>
<?php
     echo '<ul>images_for_comments>';
     echo ShowAllImagesAndComments('../../data/images_for_comments');
     echo '</ul>';

