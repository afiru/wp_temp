<?php
/*
Plugin Name: MarcatLikeBox
Plugin URI: 
Description: ログイン認証を使用した、１度しか押せないライクボタン
Author: MarcatCube
Version: 0.1
Author URI: http://www.marcatcube.com
*/

//画像設定画面設定
require_once(dirname(__FILE__) . '/library/settings/menu_setting.php');

//ログインredirect設定
require_once(dirname(__FILE__) . '/library/login_func.php');

//MarcatLikeボタン設定
require_once(dirname(__FILE__) . '/library/like_button_fc.php');

//現状のライクカウントの抽出
require_once(dirname(__FILE__) . '/library/like_counter.php');

//ライクカウントの管理ページ
//require_once(dirname(__FILE__) . '/library/like_count_setting.php');

class Custom_like_count_tables {
    public function __construct()
    {
        global $wpdb;
        // 接頭辞（wp_）を付けてテーブル名を設定
        // プラグイン有効かしたとき実行
        register_activation_hook (__FILE__, array($this, 'create_tables_01'));
    }
    public function create_tables_01() {
        global $wpdb;
        //MarcatLikeのカウント用テーブルの作成
            $sql = "";
            $charset_collate = "";
            // 接頭辞の追加（socal_count_cache）
            $table_name = $wpdb->prefix . 'like_post_count';
            $table_name2 = $wpdb->prefix . 'like_count_user';
            // charsetを指定する
            if ( !empty($wpdb->charset) )
              $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} ";

            // 照合順序を指定する（ある場合。通常デフォルトのutf8_general_ci）
            if ( !empty($wpdb->collate) )
              $charset_collate .= "COLLATE {$wpdb->collate}";
            // SQL文でテーブルを作る
            $sql = "
            CREATE TABLE {$table_name} (
               post_id bigint(20) NOT NULL,               
               like_count bigint(20) DEFAULT 1,
               like_count_category varchar(60) DEFAULT 0,
               last_count_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
               PRIMARY KEY  (post_id)
            ) {$charset_collate};";
            $sql .= "
            CREATE TABLE {$table_name2} (
               like_id bigint(20) NOT NULL AUTO_INCREMENT,               
               like_count_category varchar(60) DEFAULT 0,
               like_count_user_login_neme varchar(60) DEFAULT 0,
               post_id bigint(20) NOT NULL,
               last_count_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
               PRIMARY KEY  (like_id)
            ) {$charset_collate};";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );        
    }
    
}
$active = new Custom_like_count_tables();



function rest_api_js_read_00(){
    $filepass = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
    echo '<script async type="text/javascript" src="'.$filepass.'js/set_cookie.min.js"></script>'."\n";
}
add_action('wp_footer', 'rest_api_js_read_00');





?>