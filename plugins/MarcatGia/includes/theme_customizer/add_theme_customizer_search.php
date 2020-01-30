<?php
define('section_search', 'section_search'); //セクションIDの定数化

define('page_search_pc_imglinks_image', 'page_search_pc_imglinks_image'); //セクションIDの定数化
define('page_search_sp_imglinks_image', 'page_search_sp_imglinks_image'); //セクションIDの定数化

define('svg_text_search_box_01', 'svg_text_search_box_01');
define('svg_text_search_box_02', 'svg_text_search_box_02');
define('svg_text_search_box_03', 'svg_text_search_box_03');
define('svg_text_search_box_04', 'svg_text_search_box_04');
define('svg_text_search_box_05', 'svg_text_search_box_05');
define('svg_text_search_box_06', 'svg_text_search_box_06');


function theme_search_customizer( $wp_customize ) {
    $wp_customize->add_section( section_search , array(
        'title' => 'search部分', //セクション名
        'priority' => 30, //カスタマイザー項目の表示順
        'description' => 'search部分', //セクションの説明
    ) );

    $wp_customize->add_setting( page_search_pc_imglinks_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, page_search_pc_imglinks_image, array(
        'label' => '検索ページトップ画像（PC）', //設定ラベル
        'section' => section_search, //セクションID
        'settings' => page_search_pc_imglinks_image, //セッティングID
        'description' => '検索ページトップ画像（SP）をアップロードして変えましょう。',
    ) ) );
    
    $wp_customize->add_setting( page_search_sp_imglinks_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, page_search_sp_imglinks_image, array(
        'label' => '検索ページトップ画像（SP）', //設定ラベル
        'section' => section_search, //セクションID
        'settings' => page_search_sp_imglinks_image, //セッティングID
        'description' => '検索ページトップ画像（SP）をアップロードして変えましょう。',
    ) ) );
    
    $wp_customize->add_setting( svg_text_search_box_01 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_search_box_01, array(
        'label'	=> 'SVGボックス01',
        'section'	=> section_search,
        'settings'	=> svg_text_search_box_01,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_search_box_02 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_search_box_02, array(
        'label'	=> 'SVGボックス02',
        'section'	=> section_search,
        'settings'	=> svg_text_search_box_02,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_search_box_03 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_search_box_03, array(
        'label'	=> 'SVGボックス03',
        'section'	=> section_search,
        'settings'	=> svg_text_search_box_03,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_search_box_04 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_search_box_04, array(
        'label'	=> 'SVGボックス04',
        'section'	=> section_search,
        'settings'	=> svg_text_search_box_04,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_search_box_05 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_search_box_05, array(
        'label'	=> 'SVGボックス05',
        'section'	=> section_search,
        'settings'	=> svg_text_search_box_05,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_search_box_06 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_search_box_06, array(
        'label'	=> 'SVGボックス06',
        'section'	=> section_search,
        'settings'	=> svg_text_search_box_06,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
}
add_action( 'customize_register', 'theme_search_customizer' );//カスタマイザーに登録
 
//ヘッダーテンプレートの取得
function get_the_search_temp_select(){
 return get_theme_mod( temp_search_select);
}
?>