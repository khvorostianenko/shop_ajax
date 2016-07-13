<?php


class AdminClass
{
    private $connectionToBase='';

    public function __construct()
    {
        session_start();
    }

    public function connection($host, $user, $pass, $db){
        $this->connectionToBase = mysqli_connect($host, $user, $pass, $db);
    }
    
    public function loggedIn(){
        if ( !isset($_SESSION['login']) ) {
            echo 'not login';
            exit(-1);
        }
    }

    public function authentification()
    {
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
            header('Location: admin_photo.php');
        }
        else
            echo 'Неверное значение имени и пароля!';
    }

    public function ShowCommentsFromBase(){
        require_once '../../data/config_mysql2.php';
        $this->connection($db_hostname, $db_username, $db_password, $db_database);
        $query = "SELECT * FROM comments LEFT JOIN images ON comments.id_comment=images.id_comment ORDER BY id_tovar";
        $result = mysqli_query($this->connectionToBase, $query);
        $Fl1 = 0;
        $Fl2 = 0;
        $text = '<ul>';
        while($row = mysqli_fetch_array($result)){
            if($Fl1!=$row[1])
            {
                if($Fl2 == 0)
                {
                    $text .='<li>'.$row[1].'><br>';
                    $Fl2 = 1;
                } else
                {
                $text .='</li><li>'.$row[1].'><br>';
                $Fl1 = $row[1];
                }
            }
            $text .= "<li>>{$row[0]} {$row[2]} 
                                    <div>
                                    <input type='text' hidden  form='fSavePerm' name='path_for_comment[]' value=''/>
                                    <textarea form='fSavePerm' name='comment[]'>{$row[4]}</textarea></div>
    
</li>". htmlspecialchars_decode($row[6],ENT_QUOTES);;


        }
        $text .= '<ul>';
        echo $text;

    }

    public function ShowAllImagesAndComments($path)
    {
        global $arrImages;
        $pathImage = opendir($path);
        $text = '<ul>';
        while ( $file = readdir($pathImage) ) {
            if ( $file == '..' || $file == '.' || $file>48)
                continue;
            elseif (filetype($path . '/' . $file) == 'dir'){
                $text .= '<li>'.$file  . '><br>' . $this->ShowAllImagesAndComments( $path . '/' . $file ).'</li>';
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
}
