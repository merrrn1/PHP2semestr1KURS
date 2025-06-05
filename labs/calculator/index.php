<?php
require_once __DIR__ . '../Eval/index.php';
function validate($expr) {
    return preg_match('/^[\d\+\-\*\/\(\)\s]+$/', $expr);
}

function calculate($expr) {
    $expr = str_replace(' ', '', $expr);
    while (preg_match('/\(([^\(\)]+)\)/', $expr, $matches)) {
        $sub = calculate($matches[1]);
        $expr = str_replace($matches[0], $sub, $expr);
    }

    foreach (['*','/','+','-'] as $op) {
        $pattern = '/(-?\d+)(\\'. $op .')(-?\d+)/';
        while (preg_match($pattern, $expr, $m)) {
            switch ($op) {
                case '*': $res = $m[1] * $m[3]; break;
                case '/': $res = $m[3] == 0 ? '∞' : $m[1] / $m[3]; break;
                case '+': $res = $m[1] + $m[3]; break;
                case '-': $res = $m[1] - $m[3]; break;
            }
            $expr = preg_replace($pattern, $res, $expr, 1);
        }
    }

    return $expr;
}

$result = '';
$input = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['expression'] ?? '';
    if (validate($input)) {
        $result = evaluate_trig_expression($input);
    } else {
        $result = 'Ошибка: недопустимое выражение.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="../calc.css">
</head>
<body>
    <div class="calculator">
        <h2>Калькулятор</h2>
        <form method="POST" action="" onsubmit="return validateInput();">
            <input type="text" name="expression" id="expression" placeholder="Введите выражение" value="<?= htmlspecialchars($input) ?>">
            <button type="submit">Посчитать</button>
        </form>

        <div class="buttons">
            <button onclick="appendToExpression('1')">1</button>
            <button onclick="appendToExpression('2')">2</button>
            <button onclick="appendToExpression('3')">3</button>
            <button onclick="appendToExpression('+')">+</button>

            <button onclick="appendToExpression('4')">4</button>
            <button onclick="appendToExpression('5')">5</button>
            <button onclick="appendToExpression('6')">6</button>
            <button onclick="appendToExpression('-')">-</button>

            <button onclick="appendToExpression('7')">7</button>
            <button onclick="appendToExpression('8')">8</button>
            <button onclick="appendToExpression('9')">9</button>
            <button onclick="appendToExpression('*')">*</button>

            <button onclick="appendToExpression('0')">0</button>
            <button onclick="appendToExpression('(')">(</button>
            <button onclick="appendToExpression(')')">)</button>
            <button onclick="appendToExpression('/')">/</button>
        </div>

        <?php if ($result !== ''): ?>
            <div class="result">
                Результат: <?= htmlspecialchars($result) ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="../calc.js"></script>
</body>
</html>
