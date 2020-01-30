<?php

add_action('wp_login', 'redirect_page', 10, 2);
function redirect_page($user_login, $user){
    $user_role = $user->roles[0];
    if( $user_role == 'subscriber' ){//購読者なら
        if(!empty(get_option('custom_like_text_redirect'))) {
            wp_redirect( get_option('custom_like_text_redirect') );
        }else {
            wp_redirect( home_url() );
        }
        exit();
    }
}
function my_function_admin_bar($content) {
	return ( current_user_can( 'administrator' ) ) ? $content : false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar'); 

function remove_menus () {    
    global $wp_meta_boxes;
    global $menu;    
    if (current_user_can('subscriber')) {
        add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));

        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPressニュース        
        remove_meta_box( 'jetpack_summary_widget', 'dashboard', 'normal' ); // WordPressニュース
        
        
        
        unset($menu[2]);  // ダッシュボード
        unset($menu[4]);  // メニューの線1
        unset($menu[5]);  // 投稿
        unset($menu[10]); // メディア
        unset($menu[15]); // リンク
        unset($menu[20]); // ページ 

        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);   // 現在の状況（概要）
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);   // 最近のコメント
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);   // 被リンク
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);   // プラグイン
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);   // クイック投稿
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);   // 最近の下書き
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);   // WordPressブログ
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);   // WordPressフォーラム
        
        remove_menu_page( 'index.php' );
        remove_menu_page( 'Jetpack' );
    }
}
add_action('admin_menu', 'remove_menus');


?>