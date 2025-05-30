<?php

class Router
{
    public static function route($uri)
    {
        $basePath = '/framework-mvc/public'; 
        $path = str_replace($basePath, '', parse_url($uri, PHP_URL_PATH));
        $segments = explode('/', trim($path, '/'));

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $methodName = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        $controllerFile = '../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();
            
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                echo "Метод $methodName не найден в контроллере $controllerName.";
            }
        } else {
            echo "Контроллер $controllerName не найден.";
        }
    }
}

