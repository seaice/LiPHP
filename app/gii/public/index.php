<?php
namespace gii;

error_reporting(E_ALL ^ E_NOTICE);
define('PATH_APP', realpath(__DIR__).'\\'.'..'.'\\');
define('ENV', 'dev');       // 配置文件目录
define('DEBUG', true);      // 开发或者调试模式

include('../../../vendor/autoload.php');
\Li\App::init()->run(__NAMESPACE__);
