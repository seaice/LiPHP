<?php
include ('../../../li/App.php');

define('APP_PATH', realpath(__DIR__).'\\'.'..'.'\\');

// define('APP', 'core'); // 项目目录
define('ENV', 'shb');       // 配置文件目录
define('DEBUG', true);      // 开发或者调试模式
// define('APP_PATH', realpath(__DIR__)); // 应用目录

// \Li\App::init()->run();
include ('../../../li/bootstrap.php');
?>
