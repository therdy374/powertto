<?php

$name= "therdy";
echo "Your Name is: " .$name;
echo "<br>";


$therd = 2;
function showMessage($therd){
    return("Si Therd daw ay $therd" );
}

echo showMessage($therd);
echo "<br>";

$array = ['apple', 'banana', 'lemon'];
$array1 = array('a'=>'apple', 'banana', 'lemon');

print_r($array1);
echo "<br>";


echo $therd === '3' ? "ang galing mo" : "ang kagago mo";
echo "<br>";


$var_while = 1;
while($var_while <= 5){
    echo "tae ka " .$var_while ."<br>";
    $var_while++;
}
echo "<br>";


for($t = 1; $t <= 10; $t++){
    echo $t ."<br>";
}
echo "<br>";

$xArr = ['Boss', 'therd', 'Galingan', 'Mo', 'pA'];
foreach($xArr as $value)
{
    echo "Isa pa: " .$value[1] . "<br>";
}
echo "<br>";

switch($therd)
{
    case 1:
        echo "Tama"."<br>"; break;
    case 2:
        echo "Gago"."<br>"; break;
    default:
    echo "Tae Ka";

}



?>