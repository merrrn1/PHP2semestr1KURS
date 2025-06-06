<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $expression = file_get_contents(__DIR__ . '/labs/calc/expression.txt');

    $expression = preg_replace_callback('/(sin|cos|tan|cot)\s*\(([^)]+)\)/i', function ($matches) {
        $func = strtolower($matches[1]);
        $arg = $matches[2];
        $rad = "deg2rad($arg)";
        
        if ($func === 'cot') {
            return "(1 / tan($rad))";
        } else {
            return "$func($rad)";
        }
    }, $expression);

    try {
        $result = eval("return $expression;");
        echo json_encode(['result' => $result]);
    } catch (Exception $e) {
        echo json_encode(['result' => 'Ошибка в вычислениях']);
    }
} else {
    echo json_encode(['result' => 'Неверный запрос']);
}

?>
