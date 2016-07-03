<?php
    if (isset($_POST['url'])) {
        $page = file_get_contents('../pages/'. SanitizeString($_POST['url']));
        $page_str=str_replace("\n", "", $page);
        preg_match('/<p.*p>/', $page_str, $match);
        print_r($match[0]);
                              }

    function SanitizeString($var)
    {
        $var = strip_tags($var);
        $var = htmlentities($var);
        return stripslashes($var);
    }

/*
 * Created by PhpStorm.
 * User: Михаил
 * Date: 17.05.2016
 * Time: 17:36
 */
?>
