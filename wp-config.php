<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * データベース設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** データベース設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'wp_okistyle_imperial' );

/** データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** データベースのパスワード */
define( 'DB_PASSWORD', '' );

/** データベースのホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']><R7LB$,@91W)XNAh1Ns,p{}!vEn0{hm?,;c*$S/d=vf]j{cOye-2{ko7dJ|3-e' );
define( 'SECURE_AUTH_KEY',  'Lp10vT7d*&TINUJ(ebu(A7TCHP`]$fLBE^tX^ F0~0>4Y7uVW(^_653`&KwN~HX0' );
define( 'LOGGED_IN_KEY',    'S9 EV^Ibz#UQR#XPc|-?$Dd?1a$j1C`Ro{w>R)IHon!mZi>Bg%-7ph&O1n5XglPB' );
define( 'NONCE_KEY',        'U9^IEX*0Tr&jgc7=*cNu*G Ne{2V,&S{k1nx)2>zSE(E>tlXoBsll/-8zC ];@K0' );
define( 'AUTH_SALT',        'w$7OTL[1RtCr99~3#50/G<LM)al$yM8]bdBozh&5#njo/^Ti [mxxP{gz4.j@!_6' );
define( 'SECURE_AUTH_SALT', 'N!hGIYu|g2CnAf3/7y6ous>jtP9MTyVTr[A}^MND%$rh?/s6S,>VNy/?r]rz^nUh' );
define( 'LOGGED_IN_SALT',   'AW!zb$1*uKiQB0XszL}[V`YR>C8:?PyKj1;$_6eW<`jZaOb^qzeDRje8hKE~r3Q2' );
define( 'NONCE_SALT',       '8&LGsn%#q)%,{O=mRG5;*Xta<P.}Q!xr|l%]9XQSY_RhD.lG~|k[!gGXS{=F%YQ_' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define("WP_DEBUG_LOG", "tmp/debug.log" );
ini_set("display_errors", 0); //PHPの画面エラー出力ON/OFF
ini_set("error_log", "tmp/debugPHP.log");//PHPのエラー出力先
ini_set("log_errors", 1); //PHPのログ出力ON/OFF
ini_set('error_reporting', E_ALL); //最大限出す

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */



/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


@ini_set("upload_max_filesize", '128M');
@ini_set('post_max_size', '128M');
@ini_set('memory_limit', '256M');
@ini_set('max_execution_time', '300');
@ini_set('max_input_time', '300');