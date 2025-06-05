<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            font-size: 20px;
        }
        a {
            text-decoration: none;
        }
        .main_menu {
            display: flex;
            flex-direction: row;
            gap: 2rem;
        }
        .menu_buttons {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            background-color: #e0e0e0; /* серый фон */
            color: #333; /* темно-серый текст */
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease; /* плавные переходы */
            text-align: center;
            text-decoration: none;`
        }
        .selected {
            background-color: #4CAF50; /* зеленый */
            color: white;
            font-weight: bold;
        }
        .pages a, .pages span{

        }
    </style>
</head>
<body>
    <?php 
    require 'menu.php';
    
    $allowedValues = ['viewer', 'add', 'edit', 'delete'];

    if( !in_array($_GET['p'], $allowedValues) ) {
        die('Недопустимое значение параметра!'); 
    }

    if( $_GET['p'] == 'viewer' ) { 
        include 'viewer.php'; 
        $sort = 'byid';
        $pg = 0;
        if (isset($_GET['sort'])) $sort = $_GET['sort'];
        if (isset($_GET['pg'])) $pg = $_GET['pg'];

        echo getFriendsList($sort, $pg);
    } 
    else if( $_GET['p'] == 'add' ) { 
        include 'add.php'; 
    } 
    else if( $_GET['p'] == 'edit' ) { 
        include 'edit.php'; 
    } 
    else if( $_GET['p'] == 'delete' ) { 
        include 'delete.php'; 
    }
    ?>
</body>
</html>