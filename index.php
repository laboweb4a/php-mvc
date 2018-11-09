<?php

$uri = $_SERVER['REQUEST_URI'];

$uri = ltrim($uri, '/');

$routes = yaml_parse_file('config/routes.yml');
$config = yaml_parse_file('config/config.yml');

$uriExploded = explode('?', $uri);

$uri = $uriExploded[0];
$query = $uriExploded[1];

$matched = false;

$args['POST'] = $_POST;
$args['GET'] = $_GET;

foreach ($routes as $name => $infos) {
    if (preg_match('%^'.$uri.'$%', $infos['path'])) {
        
        if($_SERVER['REQUEST_METHOD'] !== $infos['method']){
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

function dump($var){
    echo "<pre>";
    var_dump($var);
    die();
}
function gentle_dump($var){
    echo "<pre>";
    var_dump($var);
}