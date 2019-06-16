<?php

// 輸出 HTML 格式內容
class HtmlView extends View
{

    // 取得樣版並解析
    public function fetch()
    {
        $args = func_get_args();
        $template_filename = $args[0];

        $html = '';
        ob_start();
		include 'templates/header.tpl.php';
        include 'templates/' . $template_filename;
		include 'templates/footer.tpl.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    // 輸出
    public function render()
    {
        // 因為 View 類別的 render 函式沒有參數
        // 所以 render 要自行取得
        $args = func_get_args();
        $template_filename = $args[0];

        header('Content-Type: text/html; charset=utf-8');
        echo $this->fetch($template_filename);
    }

}
