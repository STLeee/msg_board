<?php

// 抽象視圖類別
abstract class View
{

    // 樣版變數
    protected $vars = array ();

    // 設定樣版變數
    public function setVar($tpl_var, $value = null)
    {
        if (is_array($tpl_var))
        {
            foreach ($tpl_var as $key => $val)
            {
                if ($key != '')
                {
                    $this->vars[$key] = $val;
                }
            }
        }
        else
        {
            if ($tpl_var != '')
            {
                $this->vars[$tpl_var] = $value;
            }
        }
    }

    // 自動取得對應的樣版變數
    public function __get($name)
    {
        return isset($this->vars[$name]) ? $this->vars[$name] : NULL;
    }

    // 抽象：擷取結果
    public abstract function fetch();

    // 抽象：輸出結果
    public abstract function render();

}