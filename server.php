<?php

/**
 * Laravel - Web職人のためのPHPフレームワーク.
 *
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// このファイルはPHPの組み込みWebサーバーで、Apacheの"mod_rewrite"機能を
// エミュレートするためのものです。これにより、Laravelアプリケーションをテストするために
// 「本当」のWebサーバーソフトウェアをインストールしなくても済むようにしてくれます。
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
