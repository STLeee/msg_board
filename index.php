<?php

// 載入設定
require_once 'config.php';

$include_path = array ();

// 系統的 include_path
$include_path[] = get_include_path();

// 目前專案所需要的 include_path
$include_path[] = APP_REAL_PATH . '/core';
$include_path[] = APP_REAL_PATH . '/controllers';
$include_path[] = APP_REAL_PATH . '/models';
$include_path[] = APP_REAL_PATH . '/views';

// 設定新的 include_path
set_include_path(join(PATH_SEPARATOR, $include_path));

function __autoload($class_name)
{
    require_once $class_name . '.php';
}

$controller = new IndexController;
$controller->setRouter(new Router);
$controller->run();