<?php
/*ヘッダーの内容を記載する*/
define('header_amp_section', 'header_amp_section'); //セクションIDの定数化
define('header_logo_amp_pc_image', 'header_logo_amp_pc_image');
define('header_contact_sp_amp_button_image', 'header_contact_sp_amp_button_image');
define('button_contact_amp_image', 'button_contact_amp_image');
define('link_button_contact_amp_pref', 'link_button_contact_amp_pref');
define('button_sp_menu_open_amp_image', 'button_sp_menu_open_amp_image');
define('button_sp_menu_close_amp_image', 'button_sp_menu_close_amp_image');

define('svg_text_box_amp_01', 'svg_text_box_amp_01');
define('svg_text_box_amp_02', 'svg_text_box_amp_02');
define('svg_text_box_amp_03', 'svg_text_box_amp_03');
define('svg_text_box_amp_04', 'svg_text_box_amp_04');

function theme_header_amp_customizer( $wp_customize ) {
    $wp_customize->add_section( header_amp_section , array(
        'title' => 'ヘッダー(AMP用)設定', //セクション名
        'priority' => 30, //カスタマイザー項目の表示順
        'description' => 'ヘッダー(AMP用)設定について', //セクションの説明
    ) );    
    
    $wp_customize->add_setting( header_logo_amp_pc_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, header_logo_amp_pc_image, array(
        'label' => 'ロゴ画像（PC）', //設定ラベル
        'section' => header_amp_section, //セクションID
        'settings' => header_logo_amp_pc_image, //セッティングID
        'description' => 'ロゴ画像（PC）をアップロードして変えましょう。',
    ) ) );
    $wp_customize->add_setting( svg_text_box_amp_01 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_box_amp_01, array(
        'label'	=> 'ロゴsvg',
        'section'	=> header_amp_section,
        'settings'	=> svg_text_box_amp_01,
        'type'          => 'textarea',
        'description' => 'svgコードで記載する場合はこちらに記載してください。こちらに入力した場合こちらが優先的に出力されます。',
    ) ) );
    
    $wp_customize->add_setting( button_sp_menu_open_amp_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, button_sp_menu_open_amp_image, array(
        'label' => 'スマホボタンの画像（通常）', //設定ラベル
        'section' => header_amp_section, //セクションID
        'settings' => button_sp_menu_open_amp_image, //セッティングID
        'description' => 'スマホボタンの画像（通常時）の画像をアップしましょう。',
    ) ) );
    $wp_customize->add_setting( svg_text_box_amp_03 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_box_amp_03, array(
        'label'	=> 'スマホボタンの画像（通常）（SVGコード用）',
        'section'	=> header_amp_section,
        'settings'	=> svg_text_box_amp_03,
        'type'          => 'textarea',
        'description' => 'スマホボタンの画像（通常時）の画像（SVGコード用）を入力して下さい。こちらに入力した場合こちらが優先的に出力されます。',
    ) ) );
    
    
    $wp_customize->add_setting( button_sp_menu_close_amp_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, button_sp_menu_close_amp_image, array(
        'label' => 'スマホボタンの画像（押込み時）', //設定ラベル
        'section' => header_amp_section, //セクションID
        'settings' => button_sp_menu_close_amp_image, //セッティングID
        'description' => 'スマホボタンの画像（押込み時）をアップロードして変えましょう。',
    ) ) );
    $wp_customize->add_setting( svg_text_box_amp_04 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_box_amp_04, array(
        'label'	=> 'スマホボタンの画像（押込み時）（SVGコード用）',
        'section'	=> header_amp_section,
        'settings'	=> svg_text_box_amp_04,
        'type'          => 'textarea',
        'description' => 'スマホボタンの画像（押込み時）の画像（SVGコード用）を入力して下さい。こちらに入力した場合こちらが優先的に出力されます。',
    ) ) );

}
add_action( 'customize_register', 'theme_header_amp_customizer' );//カスタマイザーに登録
 

?>