<meta charset="utf-8">
<style>
    body {
        /*font-family: "Courier";*/
    }
    table {
        border: dashed 1px #ff3a44;
    }
    table tbody td:nth-child(1n+3) {
        text-align: right;
    }
</style>
<table>
<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.05.16
 * Time: 19:19
 */
//Не рабочая, но попытка не пытка
//function formProcessing($arr)
//{
//    if (!isset($massive))
//    {
//        global $massive;
//        $massive = array();
//        var_dump($massive);
//    }
//    var_dump($massive);
//    $i = count($massive);
//    echo $i;
//    print_r($arr[$i]);
//    if (!isset($arr[$i]))
//        return $massive;
//    $massive[$i] = $arr[$i];
//    return formProcessing($arr);
//}

//100% рабочая от 10.06.16
//function formProcessing($array, $param, $i)
//{
//    if (!isset($_REQUEST[$param][$i]))
//        return $array;
//    $array[$i] = $_REQUEST[$param][$i];
//    return formProcessing($array, $param, ++$i);
//}

function formProcessing($requestTek,$array, $i)
{
    if (!isset($requestTek[$i]))
        return $array;
    $array[$i] = $requestTek[$i];
    return formProcessing($requestTek, $array, ++$i);
}

function tableFormation($massive, $name, $cost, $action, $products, $summa, $j, $i)
{
    if (!isset($action[0])){
        return BEGIN_ROW . ' '. COL_LINE. "Общая сумма заказа " . COL_LINE . ' '.
        COL_LINE.' '. COL_LINE.$summa . END_ROW;
    }
    if (!isset( $massive['count'])){
        $massive['count'] = 1;}
    $subtotal = $cost[$i] * $massive['count'] * (100 - $action[$i] ) / 100;
    //                                                  отнял -4 (потом убрал и -4 и +1), что бы не менять код, но нумеровать добавленные товары с 1
    $textTableLocal = BEGIN_ROW. (count($products) + $i) . COL_LINE . $name[$i] . COL_LINE . $cost[$i]
        .COL_LINE . $massive['count'] . COL_LINE . $subtotal.COL_LINE . ' '.COL_LINE .$action[$i] .END_ROW;
    $summa += $subtotal;
    if ($i==$j){
        return $textTableLocal.= BEGIN_ROW . ' '. COL_LINE. "Общая сумма заказа " . COL_LINE . ' '.
            COL_LINE.' '. COL_LINE.$summa . END_ROW;
    }
    else {
        return $textTableLocal.tableFormation($_REQUEST, $name, $cost, $action, $products, $summa, $j, ++$i);
    }
}

    $summa = 0;
    $textTable = '';

    $products = array(
        [
                'name'      => '<a>   iPhone          </a>',
                'cost'      => 25500,
                'count'     => 1,
                'available' => false,
                'action'    => 20,
        ],
        array(
                'name'      =>  '   fmModule         _',
                'cost'      => 1500,
                'count'     => 2,
                'available' => true,
        ),
        array(
                'name'      => '   packet          _',
                'cost'      => 15,
                'count'     => 11,
                'available' => true,
        ),
        [
            'name'      => '   Bently (model)',
            'cost'      => 150,
            'count'     => 1,
            'available' => true,
            'action'    => 100,
        ]
    );

//session_start();
//echo '<pre>';
//var_dump($_SESSION);
//var_dump( session_name());
//echo '</pre>';



?>
    <thead>
        <tr> <td style="width:10px;">#</td> <td>Name</td> <td>Cost</td> <td>Count</td><td>Sum</td><td></td><td>Sale</td></tr>
<!--        Заголовок таблицы до изъятия первой части (не удалять)-->
<!--        <tr> <td style="width:10px;">#</td> <td>Name</td> <td>Cost</td> <td>Count</td><td>Sum</td><td>Available</td><td>Sale</td></tr>-->
    </thead>
    <tbody>
<?php
    const COL_LINE = '</td><td>';
    const BEGIN_ROW = '<tr><td>';
    const END_ROW = '</td></tr>';

$i = 0;

//БЛОК "Вывод первой части таблицы"
//do
//{
//    $textAvailable = 'товар ' . ($products[$i]['available'] ? 'готово к отгрузке' : 'ждем поставки');
//    $action = array_key_exists( 'action', $products[$i] ) ? (100 - $products[$i]['action']) / 100 : 1;
//    $summaProduct = $products[$i]['cost'] * $products[$i]['count'] * $action;
//    $textTable .= BEGIN_ROW. ($i + 1);
//    foreach ($products[$i] as $key => $value)
//    {
//       switch ($key)
//       {
//         case 'count':
//             $textTable.= COL_LINE . $value . COL_LINE . $summaProduct;
//               break;
//         case 'available' :
//             $textTable.= COL_LINE . $textAvailable;
//               break;
//           default:
//               $textTable.= COL_LINE . $value;
//       }
//    }
//    $textTable .=   END_ROW;
//    $summa += $summaProduct;
//    $i++;
//}
//while( $i < count($products));
//ВЫВОД БЛОК "Вывод первой части таблицы" закончен


//

//foreach ($_REQUEST as $key=>$value){
//    var_dump($key);
//    echo '<br>';
//    var_dump($value);
//    echo '<br>';
//}

//var_dump($_REQUEST[1]);
//
//echo '<br>';
//echo '<br>';
    if (isset($_COOKIE['ip']))
    {
        if ($_COOKIE['ip'] == $_SERVER['REMOTE_ADDR'])
        {
            echo 'Добрый день! В прошлый раз Вас заинтересовали:';
        }
        else 
        {
            echo "Что-то с тобой не то, дружище!";    
        }
    }
    else
    {
        setcookie('ip', $_SERVER['REMOTE_ADDR'], time()+60*60*24*7,'/');
    }

function dataPreparation($paramArray){
    $name = array ();
    $cost = array ();
    $sale = array ();
    $j=0;
    $products = 0;
    $summa = 0;
    $textTableLocal = '';
    $j = count($paramArray['name']);
    $name = formProcessing($paramArray['name'],$name, 0);
    $cost = formProcessing($paramArray['price'],$cost, 0);
    $sale = formProcessing($paramArray['sale'],$sale, 0);
    array_multisort($cost, $name, $sale);
    $textTableLocal .= tableFormation($paramArray, $name, $cost, $sale, $products, $summa, $j-1, 0);
    return $textTableLocal;
}

if ($_REQUEST){
    foreach($_REQUEST as $key=>$value)
    {
        $cookieValue = '';
        foreach ($value as $need)
        {
            $cookieValue .= ';'.$need;
        }
        setcookie($key, substr($cookieValue,1), time()+60*60*24*7,'/');
    }
    $textTable .= dataPreparation($_REQUEST);
} elseif (isset($_COOKIE['name'])) {
    $cookieArray = array();
    $needMassives = array('name','price','sale');
    foreach ($_COOKIE as $key=>$value)
    {
        if(in_array($key, $needMassives))
        {
            $$key = explode(';', $value);
            $cookieArray[$key] = $$key;
        }
    }
    $textTable .= dataPreparation($cookieArray);
}

echo "<div class='col-md-offset-3'>";
echo '<br>';
echo  $textTable;
echo '</br>';
echo "</div>";

?>
    </tbody>
</table>

