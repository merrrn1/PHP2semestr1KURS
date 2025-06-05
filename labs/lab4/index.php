<?php

// ЗАДАНИЕ 1
// На карманы при замене Дана строка вида 'a1b2c3'.
//  Напишите регулярку, которая найдет все цифры и удвоит их количество таким образом: 'a11b22c33' 
// (то есть рядом с каждой цифрой напишет такую же).
$string = 'a1b2c3';
$result = preg_replace('~(\d)~', '$1$1', $string);
echo $result;

echo '<BR>';

// ЗАДАНИЕ 2
// С помощью preg_match определите, что переданная строка является доменом вида http://site.ru. 
// Протокол может быть как http, так и https.
$pattern = '~^https?:\/\/[a-z0-9-]+(\.[a-z]{2,}){1,}$~';
$url = "https://site.ru";
if (preg_match($pattern, $url)) {
    echo "Строка является валидным доменом с протоколом HTTP/HTTPS";
} else {
    echo "Строка не соответствует формату";
}

echo '<BR>';

// ЗАДАНИЕ 3
// Дана строка 'bbb /aaa\ bbb /ccc\'. 
// Напишите регулярку, которая найдет содержимое всех конструкций /...\ и заменит их на '!'.

$string = 'bbb /aaa\ bbb /ccc\ ';
$result = preg_replace('~(\/.*?\\\\)~', '!', $string);
echo $result;

echo '<BR>';

// ЗАДАНИЕ 4
// Дана строка с целыми числами. С помощью регулярки преобразуйте строку так, 
// чтобы вместо этих чисел стояли их квадраты.

$string = 'a 123 b 3';
$result = preg_replace_callback(
    '~\b\d+\b~',
    function($matches) {
        $number = (int)$matches[0];
        $square = $number * $number;
        return (string)$square;
    },
    $string
);
echo $result;

echo '<BR>';

// ЗАДАНИЕ 5
// Дана строка 'a1a a22a a333a a4444a a55555a aba aca'. 
// Напишите регулярку, которая найдет строки, в которых по краям стоят буквы 'a', 
// а между ними любое количество цифр.

$string = 'a1a a22a a333a a4444a a55555a aba aca a5ba';
preg_match_all('~a\d+a~', $string, $matches);
print_r($matches[0]);