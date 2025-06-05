<?php 
function calculate($val) {
    if (strlen($val) == 0) return 0;

    $val = "0+".$val;
    $val = str_replace(' ', '', $val);
    $val = str_replace('--', '+', $val);
    $val = str_replace('+-', '-', $val);
    $val = str_replace('-+', '-', $val);
    $val = str_replace('++', '+', $val);

    while (preg_match('/([a-z]+)\((-?\d+)\)/i', $val, $matches)) {
        $function = strtolower($matches[1]);
        $degrees =  (double) $matches[2];
        $result = '';

        switch ($function) {
            case 'sin': 
                $result = sin(deg2rad($degrees));
                break;
            case 'cos':
                $result = cos(deg2rad($degrees));
                break;
            case 'tan':
                $result = tan(deg2rad($degrees));
                break; 
            case 'cot' :
                $result = cot(deg2rad($degrees));
                break;     
        }
        $val = str_replace($matches[0], $result, $val);
    }

    while (preg_match('/(\-?\d+\.?\d*)([\/\*])(\-?\d+\.?\d*)/', $val, $matches)) {

        $left = $matches[1];
        $operator = $matches[2];
        $right = $matches[3];
        $newVal = 1;
        switch ($operator) {
            case '*':
                $newVal = (double) $left * (double) $right;
                break;
            case '/':
                if ((double) $right === 0) return "division by zero";
                else $newVal = (double) $left / (double) $right;
                break;          
        }
        $val = str_replace($matches[0], $newVal, $val);
    }

    while (preg_match('/(\-?\d+\.?\d*)([\+\-])(\-?\d+\.?\d*)/', $val, $matches)) {
        $left = $matches[1];
        $operator = $matches[2];
        $right = $matches[3];
        $newVal = $operator === '+' ? (double) $left + (double) $right : (double) $left - (double) $right;
        $val = str_replace($matches[0], $newVal, $val);
    }
    return $val;
}
echo(calculate('4/3*cos(30)'));
?>