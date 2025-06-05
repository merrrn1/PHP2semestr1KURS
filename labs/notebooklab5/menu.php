<meta charset="UTF-8">
<div id="menu">

    <?php
        // если нет параметра меню – добавляем его
        if( !isset($_GET['p']) ) $_GET['p']='viewer'; 
    ?>
    <div id="main_menu">
    <a href="<?=($_SERVER['SCRIPT_NAME'])?>/?p=viewer"  
        <?php if( $_GET['p'] == 'viewer' ) echo ' class="selected menu_buttons"'; // выделяем его ?>
    >Просмотр</a>

    <a href="<?=($_SERVER['SCRIPT_NAME'])?>/?p=add"
        <?php if( $_GET['p'] == 'add' ) echo ' class="selected menu_buttons"'; ?>
    >Добавление записи</a>

    <a href="<?=($_SERVER['SCRIPT_NAME'])?>/?p=edit"
        <?php if( $_GET['p'] == 'edit' ) echo ' class="selected menu_buttons"'; ?> 
    >Изменение записи</a>

    <a href="<?=($_SERVER['SCRIPT_NAME'])?>/?p=delete"
        <?php if( $_GET['p'] == 'delete' ) echo ' class="selected menu_buttons"'; ?> 
    >Удаление записи</a>
    </div>

    <?php
    if( $_GET['p'] == 'viewer' )  //если был выбран первый пунт меню
    {
        ?>   
        <div id="submenu">

        <a href="<?=($_SERVER['SCRIPT_NAME'])?>/?p=viewer&sort=byid "
            <?php if( !isset($_GET['sort']) || $_GET['sort'] == 'byid' ) echo ' class="selected"'; ?>
        >По-умолчанию</a>

        <a href="<?=($_SERVER['SCRIPT_NAME'])?>/?p=viewer&sort=fam"  
            <?php if( isset($_GET['sort']) && $_GET['sort'] == 'fam' ) echo ' class="selected"'; ?>
        >По фамилии</a>
        <?php  
    }
    ?>
</div>
</div>