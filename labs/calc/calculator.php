<?php
// Основной блок обработки POST запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем выражение из запроса
    $expression = $_POST['expression'] ?? '';

    // Если выражение пустое или невалидное
    if (!is_valid_expression($expression)) {
        log_error("Ошибка ввода: Неверное выражение");
        echo json_encode(['result' => 'Ошибка ввода']);
        exit;
    }

    // Пытаемся вычислить результат
    try {
        $result = evaluate($expression);
        echo json_encode(['result' => strval($result)]);
    } catch (Exception $e) {
        log_error("Ошибка вычисления: " . $e->getMessage());
        echo json_encode(['result' => 'Ошибка вычисления']);
    }
}

// Функция для проверки валидности выражения
function is_valid_expression($expression) {
    // Проверяем, что в выражении только цифры, операторы и скобки
    return (preg_match('/^[\d\+\-\*\/\(\)\s]+$/', $expression));
}

// Функция для вычисления выражения
function evaluate($expression) {
    // Убираем пробелы из выражения
    $expression = str_replace(' ', '', $expression);
    return parse_expression($expression);
}

// Рекурсивный разбор и вычисление выражения
function parse_expression($expr) {
    if ($expr === '') {
        throw new Exception('Пустое выражение');
    }

    if (is_numeric($expr)) {
        return (int)$expr;
    }

    if (starts_with($expr, '(') && ends_with($expr, ')') && matching_brackets($expr)) {
        return parse_expression(substr($expr, 1, -1));
    }

    $min_priority = null;
    $pos = null;
    $depth = 0;
    $length = strlen($expr);

    // Проходим по выражению и ищем операторы с наименьшим приоритетом
    for ($i = 0; $i < $length; $i++) {
        $c = $expr[$i];

        if ($c === '(') {
            $depth++;
        } elseif ($c === ')') {
            $depth--;
        } elseif ($depth === 0) {
            if (($c === '+' || $c === '-') && ($i > 0)) {
                if ($min_priority === null || $min_priority > 1) {
                    $min_priority = 1;
                    $pos = $i;
                }
            } elseif (($c === '*' || $c === '/') && $min_priority !== 1) {
                if ($min_priority === null || $min_priority > 2) {
                    $min_priority = 2;
                    $pos = $i;
                }
            }
        }
    }

    // Если нашли оператор с наименьшим приоритетом, выполняем операцию
    if ($pos !== null) {
        $left = parse_expression(substr($expr, 0, $pos));
        $right = parse_expression(substr($expr, $pos + 1));
        $op = $expr[$pos];
        return apply_op($left, $right, $op);
    }

    // Обработка унарного минуса
    if (starts_with($expr, '-')) {
        return -parse_expression(substr($expr, 1));
    }

    throw new Exception('Неверное выражение');
}

// Применение операции к двум числам
function apply_op($a, $b, $op) {
    if ($op === '+') return $a + $b;
    if ($op === '-') return $a - $b;
    if ($op === '*') return $a * $b;
    if ($op === '/') {
        if ($b == 0) {
            throw new Exception('Деление на ноль');
        }
        return $a / $b;
    }
    throw new Exception('Неизвестная операция');
}

// Вспомогательные функции
function starts_with($haystack, $needle) {
    return substr($haystack, 0, strlen($needle)) === $needle;
}

function ends_with($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}

function matching_brackets($expr) {
    $count = 0;
    $length = strlen($expr);
    for ($i = 0; $i < $length; $i++) {
        if ($expr[$i] === '(') {
            $count++;
        } elseif ($expr[$i] === ')') {
            $count--;
            if ($count < 0) {
                return false;
            }
        }
    }
    return $count === 0;
}