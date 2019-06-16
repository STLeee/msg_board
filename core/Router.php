<?php

// 預設的路由器
class Router
{

    // 預設的動作
    protected $action = 'index';

    // 在建構函式中解析 GET 變數
    public function __construct()
    {
        $this->action = isset($_GET['act']) ? strtolower($_GET['act']) : 'index';
    }

    // 取得解析後的動作名稱
    public function getAction()
    {
        return $this->action;
    }

}