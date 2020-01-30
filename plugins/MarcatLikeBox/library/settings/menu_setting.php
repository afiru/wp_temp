<?php

//MarcatLikeボタンの設定
require_once(dirname(__FILE__) . '/menu_page/like_button_setting.php');

//MarcatLike履歴ユーザーの調査ページ
require_once(dirname(__FILE__) . '/menu_page/like_history.php');

//投稿者管理
require_once(dirname(__FILE__) . '/menu_page/like_post_history.php');

//ユーザー管理
//require_once(dirname(__FILE__) . '/menu_page/like_wp_users.php');

//CSV
//require_once(dirname(__FILE__) . '/menu_page/like_wp_users_csv.php');

add_action('admin_menu', 'myplugin_menu_pages');
function myplugin_menu_pages() {
    $page_title = 'MarcatLikeボタン管理';
    $menu_title = 'MarcatLikeボタン管理';
    $capability = 'manage_options';
    $menu_slug = 'custom_like_count_box_setting';
    $function = 'custom_like_count_box_setting_page';
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);

    $sub_menu_title = 'MarcatLikeボタン画像設定';
    add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);

    $submenu_page_title = 'MarcatLikeボタン履歴';
    $submenu_title = 'MarcatLikeボタン履歴管理';
    $submenu_slug = 'like_history';
    $submenu_function = 'like_history';
    add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
  
    $submenu_page_title = 'MarcatLike投稿ランキング';
    $submenu_title = 'MarcatLike投稿履歴管理';
    $submenu_slug = 'like_post_history';
    $submenu_function = 'like_post_history';
    add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
    
//    $submenu_page_title = 'WPユーザー管理';
//    $submenu_title = 'WPユーザー管理';
//    $submenu_slug = 'like_wp_users';
//    $submenu_function = 'like_wp_users';
//    add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
//    
//    $submenu_page_title = 'WPユーザー管理CSV';
//    $submenu_title = 'WPユーザー管理CSV書き出し';
//    $submenu_slug = 'like_wp_users_csv';
//    $submenu_function = 'like_wp_users_csv';
//    add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
}



?>