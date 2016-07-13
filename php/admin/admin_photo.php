<meta charset="UTF-8">
<?php
    require_once 'AdminClass.php';
    $admin = new AdminClass();
    $admin->loggedIn();

    echo "<br>Добро пожаловать в панель редактирования отзывов<br>";
    include_once ('../otziv/const.php');
    $arrImages = file_exists('true_image.txt') ? file('true_image.txt'): array();
?>
  <form method="post" action="save_permission.php" id="fSavePerm">
      <button value="submit"> Сохранить изменения! </button>
  </form>
<?php
     echo '<ul>images_for_comments>';
     echo $admin->ShowAllImagesAndComments('../../data/images_for_comments');
     echo '</ul>';


    echo '<ul>images_for_comments from baza>';
    echo $admin->ShowCommentsFromBase();
    echo '</ul>';
