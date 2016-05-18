<meta charset="utf-8">
<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 18.05.2016
 * Time: 19:20
 */
    $summa = 0;
    $tovar1 = 'IPhone';
    $costTovar1 = 25500;
    $countTovar1=1;
    $countTovar2=10;
    $countTovar3=15;
    $tovar2 = 'fmModule';
    $costTovar2 = 1500;
    $tovar3 = 'packet';
    $costTovar3 = 15;

    $tovar4 = 'Samsumg';
    $costTovar4 = 20000;
    $countTovar4=1;
    $countTovar5=10;
    $countTovar6=15;
    $tovar5 = 'Calculator';
    $costTovar5 = 1500;
    $tovar6 = 'MS Office';
    $costTovar6 = 15;

    $summa = $costTovar1*$countTovar1 + $costTovar2*$countTovar2 + $costTovar3*$countTovar3;

    echo "1.$tovar1 по цене $costTovar1 количество $countTovar1 на сумму ". $costTovar1*$countTovar1."<br>";
    echo "2.$tovar2 по цене $costTovar2 количество $countTovar2 на сумму ". $costTovar2*$countTovar2."<br>";
    echo "3.$tovar3 по цене $costTovar3 количество $countTovar3 на сумму ". $costTovar3*$countTovar3."<br>";
    echo "Общая сумма заказа = $summa";

    echo "<table border='2'><tr><td>Товар</td><td>Цена</td><td>Кол-во</td><td>К оплате</td></tr>";
    echo "<tr><td>$tovar1</td><td>$costTovar1</td><td>$countTovar1</td><td>".$costTovar1*$countTovar1."</td></tr>";
    echo "<tr><td>$tovar2</td><td>$costTovar2</td><td>$countTovar2</td><td>".$costTovar2*$countTovar2."</td></tr>";
    echo "<tr><td>$tovar3</td><td>$costTovar3</td><td>$countTovar3</td><td>".$costTovar3*$countTovar3."</td></tr>";
    echo "<tr><td colspan='3'>Общая сумма</td><td>$summa</td></tr>";
