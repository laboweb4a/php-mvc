<?php

require_once('config/config.php');

function autoloader($class)
{
    if (file_exists("./core/".$class.".php")) {
        include "core/".$class.".php";
    } elseif (file_exists("./models/".$class.".php")) {
        include "models/".$class.".php";
    }
}

spl_autoload_register('autoloader');


$uri = $_SERVER['REQUEST_URI'];

$uri = trim($uri, '/');

$uriExploded = explode('?', $uri);

$uri = $uriExploded[0];

$matched = false;

$args = [
    "POST"=>$_POST,
    "GET"=>$_GET
];



foreach ($routes as $name => $infos) {
    if ($uri === $infos['path']) {
        if ($_SERVER['REQUEST_METHOD'] !== $infos['method']) {
            $matched = false;
            break;
        }
        
        $controllerPath = 'controllers/'.$infos['controller'].'.php';
        if (file_exists($controllerPath)) {
            include($controllerPath);
            $obj = new $infos['controller'];
            if (method_exists($obj, $infos['action'].'Action')) {
                $action = $infos['action'].'Action';
                $obj->$action($args);
                $matched = true;
                break;
            }
        }
    }
}


if (!$matched) {
    header('Location: /404');
}
