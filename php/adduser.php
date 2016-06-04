<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 02.06.2016
 * Time: 14:56
 */

function validate_forename($field)
{
    return ($field == "") ? "Не введено имя<br>" : "";
}

function validate_surname($field)
{
    return ($field == "") ? "Не введена фамилия<br>" : "";
}

function validate_username($field)
{
    if ($field == "") return "Не введено имя пользователя<br>";
    else if (strlen($field) < 5)
        return "В имени пользователя должно быть не менее 5 символов<br>";
    else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
        return "В имени пользователя допускаются только буквы, цифры, - и _<br>";
    return "";
}
function validate_password($field)
{
    if ($field == "") return "Не введен пароль<br>";
    else if (strlen($field) < 6)
        return "В пароле должно быть не менее 6 символов<br>";
    else if ( !preg_match("/[a-z]/", $field) ||
        !preg_match("/[A-Z]/", $field) ||
        !preg_match("/[0-9]/", $field))
        return "Пароль требует 1 символа из каждого набора a-z, A-Z и 0-9<br>";
    return "";
}

function validate_age($field)
{
    if ($field == "") return "Не введен возраст<br>";
    else if ($field < 18 || $field > 110)
        return "Возраст должен быть между 18 и 110<br>";
    return "";
}
function validate_email($field)
{
    if ($field == "") return "Не введен адрес электронной почты<br>";
    else if (!((strpos($field, ".") > 0) &&
            (strpos($field, "@") > 0)) ||
        preg_match("/[^a-zA-Z0-9.@_-]/", $field))
        return "Электронный адрес имеет неверный формат<br>";
    return "";
}

function fix_string($string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
}

$forename = $surname = $username = $password = $age = $email = "";
if (isset($_POST['forename']))
    $forename = fix_string($_POST['forename']);
if (isset($_POST['surname']))
    $surname = fix_string($_POST['surname']);
if (isset($_POST['username']))
    $username = fix_string($_POST['username']);
if (isset($_POST['password']))
    $password = fix_string($_POST['password']);
if (isset($_POST['age']))
    $age = fix_string($_POST['age']);
if (isset($_POST['email']))
    $email = fix_string($_POST['email']);

$fail = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_username($username);
$fail .= validate_password($password);
$fail .= validate_age($age);
$fail .= validate_email($email);