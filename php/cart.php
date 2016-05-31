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
<div>
    Я вас категорически приветствую!
</div>
<table>

<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.05.16
 * Time: 19:19
 */
function formProcessing($array, $param, $i)
{
    if ($i == 0)
    {
        $array[$i] = $_REQUEST[$param][$i];
        return $array;
    }
    else
    {
        $array[$i] = $_REQUEST[$param][$i];
        return formProcessing($array, $param, $i-1);
    }
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
    $textTableLocal = BEGIN_ROW. (count($products) + $i+1) . COL_LINE . $name[$i] . COL_LINE . $cost[$i]
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
?>
    <thead>
        <tr> <td style="width:10px;">#</td> <td>Name</td> <td>Cost</td> <td>Count</td><td>Sum</td><td>Available</td><td>Sale</td></tr>
    </thead>
    <tbody>
<?php
    const COL_LINE = '</td><td>';
    const BEGIN_ROW = '<tr><td>';
    const END_ROW = '</td></tr>';

$i = 0;

do
{
    $textAvailable = 'товар ' . ($products[$i]['available'] ? 'готово к отгрузке' : 'ждем поставки');
    $action = array_key_exists( 'action', $products[$i] ) ? (100 - $products[$i]['action']) / 100 : 1;
    $summaProduct = $products[$i]['cost'] * $products[$i]['count'] * $action;
    $textTable .= BEGIN_ROW. ($i + 1);
    foreach ($products[$i] as $key => $value)
    {
       switch ($key)
       {
         case 'count':
             $textTable.= COL_LINE . $value . COL_LINE . $summaProduct;
               break;
         case 'available' :
             $textTable.= COL_LINE . $textAvailable;
               break;
           default:
               $textTable.= COL_LINE . $value;
       }
    }
    $textTable .=   END_ROW;
    $summa += $summaProduct;
    $i++;
}
while( $i < count($products));

$name = array ();
$cost = array ();
$action = array ();
$j=0;
if ($_REQUEST){
    $j = count($_REQUEST['name']);
    $name = formProcessing($name, 'name', $j-1);
    $cost = formProcessing($cost, 'price', $j-1);
    $action = formProcessing($action, 'sale', $j-1);
    array_multisort($cost, $name, $action);
    $textTable .= tableFormation($_REQUEST, $name, $cost, $action, $products, $summa, $j-1, 0);
}
echo  $textTable;
?>
    </tbody>
</table>

