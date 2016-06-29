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
function formProcessing($requestTek,$array, $i)
{
    if (!isset($requestTek[$i]))
        return $array;
    $array[$i] = $requestTek[$i];
    return formProcessing($requestTek, $array, ++$i);
}

function dataPreparation($paramArray){
    $name = array ();
    $cost = array ();
    $sale = array ();
    $j=0;
    $products = 0;
    $summa = 0;
    $j = count($paramArray['name']);
    $name = formProcessing($paramArray['name'],$name, 0);
    $cost = formProcessing($paramArray['price'],$cost, 0);
    $sale = formProcessing($paramArray['sale'],$sale, 0);
    array_multisort($cost, $name, $sale);
    $textTableLocal = tableFormation($paramArray, $name, $cost, $sale, $products, $summa, $j-1, 0);
    return $textTableLocal;
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



    const COL_LINE = '</td><td>';
    const BEGIN_ROW = '<tr><td>';
    const END_ROW = '</td></tr>';
    const TABLE_HEAD =  "<thead><tr> <td style='width:10px;'>#</td> <td>Name</td> <td>Cost</td> 
                    <td>Count</td><td>Sum</td><td></td><td>Sale</td></tr></thead><tbody>";

    if (!isset($_COOKIE['ipAndUserAgent'])) {
            setcookie('ipAndUserAgent', hash('ripemd128',$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']), time() + 60 * 60 * 24 * 7, '/');
    }

    if ($_REQUEST)
    {
        foreach($_REQUEST as $key=>$value)
        {
            $cookieValue = '';
            foreach ($value as $need)
            {
                $cookieValue .= ';'.$need;
            }
            setcookie($key, substr($cookieValue,1), time()+60*60*24*7,'/');
        }
        echo '<br><br>Сейчас Вы выбрали:<br><br>';
        $textTable = dataPreparation($_REQUEST);
    }
    elseif (isset($_COOKIE['ipAndUserAgent']))
    {
        if (($_COOKIE['ipAndUserAgent'] == hash('ripemd128',$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))
        &&(isset($_COOKIE['name'])))
        {
            $cookieArray = array();
            $desiredArrays = array('name','price','sale');
            foreach ($_COOKIE as $key=>$value)
            {
                if(in_array($key, $desiredArrays))
                {
                    $$key = explode(';', $value);
                    $cookieArray[$key] = $$key;
                }
            }
            echo '<br><br>Добрый день! При прошлом посещении Вы выбрали:<br><br>';
            $textTable = dataPreparation($cookieArray);
        }
    }


    //var_dump($_COOKIE);
    echo "<div class='col-md-offset-3'>";
//    echo '<br>';
    if (isset($textTable))
    {
        echo TABLE_HEAD.$textTable;
    }
    echo '</br>';
    echo "</div>";

    ?>
        </tbody>
    </table>

