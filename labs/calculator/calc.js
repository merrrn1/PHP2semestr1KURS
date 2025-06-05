function validateInput() {
    const input = document.getElementById('expression').value;
    const pattern = /^[\d+\-*/()\s]+$/;
    if (!pattern.test(input)) {
        alert('Пожалуйста, введите корректное выражение (только цифры, скобки и знаки операций).');
        return false;
    }
    return true;
}

function appendToExpression(value) {
    const expressionField = document.getElementById('expression');
    expressionField.value += value;
}
