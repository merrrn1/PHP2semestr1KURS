<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Solve</title>
</head>
<body>
    <header>
        <a href="../mainPage.html">
            <img src="../logo.svg" style="filter: brightness(0)" width=200px alt="logo_polytech">
        </a>
        <p>1.2. Домашняя работа: Solve the equation.</p>
    </header>
    <main>
        <?php 
            function findX($expression) {
                $parts = explode(' ', $expression);

                $numDemo = $parts[0];
                $result = $parts[sizeof($parts) - 1];
                $num;

                if ($numDemo === 'x') {
                    $num = (int) $parts[2];
                }
                else {
                    $num = (int) $numDemo;
                }

                $x = $result / $num;
                return $x;
            }
            $inputExpression = "x * 8 = 49";
            echo "<p>";
                print_r($inputExpression);
            echo "</p>";    
            echo "<p>";
                print_r("x = " . findX($inputExpression));
            echo "</p>";    
        ?>
        <br/>
    </main>
    <footer>
    </footer>
</body>
</html>