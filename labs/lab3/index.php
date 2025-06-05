<?php 

$text = '12345';
$file = 'test.txt';

$file_add_text = file_put_contents($file, $text);
if ($file_add_text !== false) {
    echo 'Текст для задания 1 добавлен в файл успешно!<br>';
} else {
    echo 'Неудача!';}




$file2 = 'test2.txt';
$file_get_num = pow(file_get_contents($file2), 2);

if ($file_get_num !== false) {
    echo "$file_get_num <br>";
} else {
    echo 'Неудача!';
}




$file3 = 'test3.txt';
$file_size = filesize($file3);
if ($file_size !== false) {
    echo "$file_size<br>";
} else {
    echo 'Неудача!';
}




$file3_data = file('test3.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
print_r($file3_data);




$files_array = ['1.txt', '2.txt', '3.txt'];

foreach ($files_array as $file) {
    if (file_exists($file)) {
        unlink($file);
        echo "Файл $file удалён<br>";
    } else {
        echo "Файл $file не найден<br>";
    }
}
?>
