<?php
/*ヘッダーの内容を記載する*/
define('header_section', 'header_section'); //セクションIDの定数化
define('header_logo_pc_image', 'header_logo_pc_image');
define('header_contact_sp_button_image', 'header_contact_sp_button_image');
//define('tel_number_logo_image', 'tel_number_logo_image');
//define('tel_number_header_pref', 'tel_number_header_pref');
define('button_contact_image', 'button_contact_image');
define('link_button_contact_pref', 'link_button_contact_pref');
//define('button_faq_image', 'button_faq_image');
//define('link_button_faq_pref', 'link_button_faq_pref');
//define('button_topics_image', 'button_topics_image');
//define('link_button_topics_pref', 'link_button_topics_pref');
define('button_sp_menu_open_image', 'button_sp_menu_open_image');
define('button_sp_menu_close_image', 'button_sp_menu_close_image');
//define('header_temp_select', 'header_temp_select');
//define('header_back_image', 'header_back_image');

define('svg_text_box_01', 'svg_text_box_01');
define('svg_text_box_02', 'svg_text_box_02');
define('svg_text_box_03', 'svg_text_box_03');
define('svg_text_box_04', 'svg_text_box_04');
//define('svg_text_box_05', 'svg_text_box_05');
//define('svg_text_box_06', 'svg_text_box_06');

function theme_header_customizer( $wp_customize ) {
    $wp_customize->add_section( header_section , array(
        'title' => 'ヘッダー(通常用)設定', //セクション名
        'priority' => 30, //カスタマイザー項目の表示順
        'description' => 'ヘッダー(通常用)設定について', //セクションの説明
    ) );    

    
    $wp_customize->add_setting( header_logo_pc_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, header_logo_pc_image, array(
        'label' => 'ロゴ画像（PC）', //設定ラベル
        'section' => header_section, //セクションID
        'settings' => header_logo_pc_image, //セッティングID
        'description' => 'ロゴ画像（PC）をアップロードして変えましょう。',
    ) ) );
    $wp_customize->add_setting( svg_text_box_01 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_box_01, array(
        'label'	=> 'ロゴsvg',
        'section'	=> header_section,
        'settings'	=> svg_text_box_01,
        'type'          => 'textarea',
        'description' => 'svgコードで記載する場合はこちらに記載してください。こちらに入力した場合こちらが優先的に出力されます。',
    ) ) );
    
    $wp_customize->add_setting( button_sp_menu_open_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, button_sp_menu_open_image, array(
        'label' => 'スマホボタンの画像（通常）', //設定ラベル
        'section' => header_section, //セクションID
        'settings' => button_sp_menu_open_image, //セッティングID
        'description' => 'スマホボタンの画像（通常時）の画像をアップしましょう。',
    ) ) );
    $wp_customize->add_setting( svg_text_box_03 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_box_03, array(
        'label'	=> 'スマホボタンの画像（通常）（SVGコード用）',
        'section'	=> header_section,
        'settings'	=> svg_text_box_03,
        'type'          => 'textarea',
        'description' => 'スマホボタンの画像（通常時）の画像（SVGコード用）を入力して下さい。こちらに入力した場合こちらが優先的に出力されます。',
    ) ) );
    
    
    $wp_customize->add_setting( button_sp_menu_close_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, button_sp_menu_close_image, array(
        'label' => 'スマホボタンの画像（押込み時）', //設定ラベル
        'section' => header_section, //セクションID
        'settings' => button_sp_menu_close_image, //セッティングID
        'description' => 'スマホボタンの画像（押込み時）をアップロードして変えましょう。',
    ) ) );
    $wp_customize->add_setting( svg_text_box_04 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_box_04, array(
        'label'	=> 'スマホボタンの画像（押込み時）（SVGコード用）',
        'section'	=> header_section,
        'settings'	=> svg_text_box_04,
        'type'          => 'textarea',
        'description' => 'スマホボタンの画像（押込み時）の画像（SVGコード用）を入力して下さい。こちらに入力した場合こちらが優先的に出力されます。',
    ) ) );

}
add_action( 'customize_register', 'theme_header_customizer' );//カスタマイザーに登録
 
//ヘッダーテンプレートの取得
function get_the_header_temp_select(){
 return get_theme_mod( header_temp_select);
}
function get_the_header_h1_text(){
 return get_theme_mod( h1_text);
}


?>