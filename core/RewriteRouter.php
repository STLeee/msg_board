<?php

// 網址重寫路由器
class RewriteRouter extends Router
{

    // 可以解析 http://xxxxx/basedir/action
	public function __construct()
	{
        $basedir = basename(APP_REAL_PATH);
        $currdir = str_replace('index.php', '', $_SERVER["REQUEST_URI"]);
        $pattern = '/^\/' . $basedir . '\/*(.*)$/';
        preg_match($pattern, $currdir, $matches);
        $tickets = isset($matches[1]) ? explode('/', $matches[1]) : array ('');
        $this->action = ($tickets[0]) ? strtolower($tickets[0]) : 'index';
    }

}