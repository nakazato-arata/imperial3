<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );


// ★これを追加 ↓を監視　プロファイルの出力開始
// tideways_xhprof_enable();

// try {

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';

// } finally {
        
    // // ★これを追加 ↑を監視 終了
    // $data = tideways_xhprof_disable(); 
    // // ファイルに出力する 第一引数はファイル保存先 ファイル名は数字にするのが無難。xhprof-htmlが動かなくなる
    // file_put_contents("C:\Users\nanar\Desktop\memo\xhprof/3.xhprof", serialize($data));
// }


