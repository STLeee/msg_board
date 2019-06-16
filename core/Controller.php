<?php

// 抽象控制類別
abstract class Controller
{

    // 動作名稱
    protected $action = '';

    // 抽象：預設動作
    protected abstract function index();

    // 路由器
    protected $router = NULL;

    // 設定路由器
    public function setRouter(Router $router)
    {
        if (method_exists($this, ($action = $router->getAction())))
        {
            $this->action = $action;
        }    	
    }

    // 執行動作
    public abstract function run();
    /*{
	    $this->{$this->action}();
    }*/

    // 頁面重導向
    protected function redirectTo($url)
    {
        header('Location: ' . $url);
    }

}