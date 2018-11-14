<?php 

$routes = yaml_parse_file('config/routes.yml');
$config = yaml_parse_file('config/config.yml');

define('DBHOST', $config['db']['host']);
define('DBUSER', $config['db']['user']);
define('DBNAME',$config['db']['database']);
define('DBPWD',$config['db']['password']);

