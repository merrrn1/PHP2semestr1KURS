<?php

echo "<br>Задание №1: ";
$array = ['a', 'b', 'c', 'b', 'a'];
$result = array_count_values($array);
print_r($result);

echo "<br>Задание №2: ";
$array = ['a'=>1, 'b'=>2, 'c'=>3];
$result = array_flip($array);
print_r($result);

echo "<br>Задание №3: ";
$array = [1, 2, 3, 4, 5];
$result = array_reverse($array);
print_r($result);

echo "<br>Задание №4: ";
$array1 = ['a', 'b', 'c']; 
$array2 = [1, 2, 3];
$result = array_combine($array1, $array2);
print_r($result);

echo "<br>Задание №7: ";
$array1 = ['a', 'b', 'c']; 
$array2 = [1, 2, 3];
$result = array_merge($array1, $array2);
print_r($result);

echo "<br>Задание №9: ";
$array = ['a'=>1, 'b'=>2, 'c'=>3];
$result = array_rand($array);
print_r($array[$result]);   

echo "<br>Задание №11: ";
$array = ['a', 'b', 'c', 'd', 'e'];
$array = array_replace($array, [0 => '!', 3 => '!!']);
print_r($array);
 
echo "<br>Задание №15: ";
$array = [1, 2, 3, 4, 5];
array_unshift($array, 0);
array_push($array, 6);
print_r($array);

echo "<br>Задание №16: ";
$array = [1, 2, 3, 4, 5, 6, 7, 8];
$result = [];
while ($array) {
    array_push($result, array_shift($array));
    array_push($result, array_pop($array));
}
print_r($result);

echo "<br>Задание №19: ";
$array = [1, 2, 3, 4, 5];
$result = array_slice($array, 1);
print_r($result);

echo "<br>Задание №21: ";
$array = [1, 2, 3, 4, 5];
$result = array_sum($array)/count($array);
print_r($result);
?>