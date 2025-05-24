<?php
session_start();

define('BASE_URL', '/framework-mvc/public');

require_once '../core/Router.php';

$uri = $_SERVER['REQUEST_URI'];
Router::route($uri);
