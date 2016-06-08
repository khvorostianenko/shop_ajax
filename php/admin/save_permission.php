<meta charset="UTF-8">
<?php
    
    $text = '';
    foreach ($_POST['images'] as $value)
    {
        $text .= $value . PHP_EOL;  
    }

    for ($i=0; $i<count($_POST['comment']); $i++){
        file_put_contents($_POST['path_for_comment'][$i], $_POST['comment'][$i]);
    }
    
    if (!file_put_contents('true_image.txt', $text))
        echo "Произошла ошибка. Ваши изменения могут быть не сохранены!";
    echo "Ваши изменения успешно сохранены!";