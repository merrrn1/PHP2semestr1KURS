<?php

echo "<br>Задание №1: ";
$a = 27;
$b = 12; 
$c = number_format(sqrt($a**2 + $b**2), 2);
echo "$c <br>";



echo "<br>Задание №2: ";
$c = number_format(sqrt($a**2 - $b**2), 2);
echo "$c <br>";



echo "<br>Задание №3: <br>";
$a = 27;
$b = 23;
$c = sqrt($a**2 + $b**2);

$angle_radians = atan($b / $a);
$angle_degrees = rad2deg($angle_radians);
echo "Другой острый угол: " . number_format(90 - $angle_degrees, 2) . "°<br>";

$other_cathetus = sqrt($c**2 - $b**2);
echo "Значение другого катета: " . number_format($other_cathetus, 2) . "<br>";



echo "<br>Задание №4: <br>";
$a = 27;
$b = 12;

$alpha = rad2deg(atan($b / $a));
$beta = 90 - $alpha;

echo "Угол α: " . number_format($alpha, 2) . "°<br>";
echo "Угол β: " . number_format($beta, 2) . "°<br>";
echo "Угол γ: 90°<br>";



echo "<br>Задание №5: <br>";
$a = 2;
$b = 2.0;
$c = '2';
$d = 'two';
$g = true;
$f = false;

echo "Операции, которые дадут string:<br>";
$result = [];
$result[] = $a . $b; 
$result[] = $a . $c;
$result[] = $a . $d;
$result[] = $a . $g;
$result[] = $a . $f;
$result[] = $b . $c;   
$result[] = $b . $d;  
$result[] = $b . $g; 
$result[] = $b . $f;  
$result[] = $c . $d;   
$result[] = $c . $g;  
$result[] = $c . $f;  
$result[] = $d . $g; 
$result[] = $d . $f;  
$result[] = $g . $f;           
print_r($result);
echo "<br>";



echo "<br>Задание №6: <br>";
echo "Операции, которые дадут bool:<br>";
$result = [];
$result[] = ($a == $b);
$result[] = ($a === $b);
$result[] = ($a == $c);
$result[] = ($a === $c);
$result[] = ($a != $d);
$result[] = ($b > $f);
$result[] = ($g && $f);
$result[] = ($g || $f);
$result[] = (!$g);
$result[] = (!$f);
$result[] = ($g xor $f);
$result[] = boolval($a + $b);
$result[] = boolval($c - $b);
$result[] = boolval($d);
$result[] = boolval($f);
print_r($result);
echo "<br>";



echo "<br>Задание №7: <br>";
echo "Операции, которые дадут float:<br>";
$result = [];
$result[] = $a + $b;
$result[] = $a - $b;
$result[] = $a * $b;
$result[] = $a / $b;
$result[] = $b + $c;
$result[] = $b - $c;
$result[] = $b * $c;
$result[] = $b / $c;
$result[] = $a / $c;
$result[] = $a / 3;
$result[] = $b + $g;
$result[] = $b - $g;
$result[] = $b * $g;
$result[] = $b / $g;
print_r($result);
echo "<br>";



echo "<br>Задание №8: <br>";
$a = true;
$b = false;
echo "Значение переменной a: " . $a . "<br>";
echo "Значение переменной b: " . $b . "<br>";



echo "<br>Задание №9: <br>";
echo "Операции, которые дадут int:<br>";
$result = [];
$result[] = $a + $c;
$result[] = $a - $c;
$result[] = $a * $c;
$result[] = $a % $c;
$result[] = $a + $g;
$result[] = $a - $g;
$result[] = $a * $g;
$result[] = $a % $g;
$result[] = $a + $f;
$result[] = $a - $f;
$result[] = $a * $f;
$result[] = $a + $b;
$result[] = $a - $b;
$result[] = $a * $b;
print_r($result);
echo "<br>";



echo "<br>Задание №10: <br>";
$hunter = 'охотник'; 
$wants_to = 'желает';
$know = 'знать'; 
$fizan = 'фазан'; 
$sits = 'сидит';
$mnemonic_phrase = "Каждый $hunter $wants_to $know, где $sits $fizan.";
echo $mnemonic_phrase . "<br>";



echo "<br>Задание 11: <br>";
$quieter = 'Тише'; 
$go = 'едешь'; 
$further = 'дальше'; 
echo $quieter . " " . $go . ", " . $further . " будешь<br>";



echo "<br>Задание 12: <br>";
$not_take_risks = 'Кто не рискует';
$not_drink = 'не пьет'; 
$ellipsis = '...';
echo  $not_take_risks . ", тот " . $not_drink . $ellipsis
?>