<?php
namespace admin;

// error_reporting(E_ALL ^ E_NOTICE);
// error_reporting(0);

define('PATH_APP', realpath(__DIR__).'\\'.'..'.'\\');
define('ENV', 'dev');       // 配置文件目录

include('../../../vendor/autoload.php');
\Li\App::init()->run(__NAMESPACE__);
