<?php
define('section_404', 'section_404'); //セクションIDの定数化
define('temp_404_select', 'temp_404_select'); //セクションIDの定数化
define('page_404_pc_imglinks_image', 'page_404_pc_imglinks_image'); //セクションIDの定数化
define('page_404_sp_imglinks_image', 'page_404_sp_imglinks_image'); //セクションIDの定数化
define('page_404_sub_imglinks_image', 'page_404_sub_imglinks_image'); //セクションIDの定数化

define('svg_text_404_box_01', 'svg_text_404_box_01');
define('svg_text_404_box_02', 'svg_text_404_box_02');
define('svg_text_404_box_03', 'svg_text_404_box_03');
define('svg_text_404_box_04', 'svg_text_404_box_04');
define('svg_text_404_box_05', 'svg_text_404_box_05');
define('svg_text_404_box_06', 'svg_text_404_box_06');

function theme_404_customizer( $wp_customize ) {
    $wp_customize->add_section( section_404 , array(
        'title' => '404部分', //セクション名
        'priority' => 30, //カスタマイザー項目の表示順
        'description' => '404部分', //セクションの説明
    ) );

    
    $wp_customize->add_setting( page_404_pc_imglinks_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, page_404_pc_imglinks_image, array(
        'label' => '404トップ画像（PC）', //設定ラベル
        'section' => section_404, //セクションID
        'settings' => page_404_pc_imglinks_image, //セッティングID
        'description' => '404トップ画像（SP）をアップロードして変えましょう。',
    ) ) );
    
    $wp_customize->add_setting( page_404_sp_imglinks_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, page_404_sp_imglinks_image, array(
        'label' => '404トップ画像（SP）', //設定ラベル
        'section' => section_404, //セクションID
        'settings' => page_404_sp_imglinks_image, //セッティングID
        'description' => '404トップ画像（SP）をアップロードして変えましょう。',
    ) ) );
    
    $wp_customize->add_setting( page_404_sub_imglinks_image );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, page_404_sub_imglinks_image, array(
        'label' => '404タイトル画像', //設定ラベル
        'section' => section_404, //セクションID
        'settings' => page_404_sub_imglinks_image, //セッティングID
        'description' => '404タイトル画像をアップロードして変えましょう。',
    ) ) );
    
    $wp_customize->add_setting( svg_text_404_box_01 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_404_box_01, array(
        'label'	=> 'SVGボックス01',
        'section'	=> section_404,
        'settings'	=> svg_text_404_box_01,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_404_box_02 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_404_box_02, array(
        'label'	=> 'SVGボックス02',
        'section'	=> section_404,
        'settings'	=> svg_text_404_box_02,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_404_box_03 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_404_box_03, array(
        'label'	=> 'SVGボックス03',
        'section'	=> section_404,
        'settings'	=> svg_text_404_box_03,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_404_box_04 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_404_box_04, array(
        'label'	=> 'SVGボックス04',
        'section'	=> section_404,
        'settings'	=> svg_text_404_box_04,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_404_box_05 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_404_box_05, array(
        'label'	=> 'SVGボックス05',
        'section'	=> section_404,
        'settings'	=> svg_text_404_box_05,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
    $wp_customize->add_setting( svg_text_404_box_06 );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, svg_text_404_box_06, array(
        'label'	=> 'SVGボックス06',
        'section'	=> section_404,
        'settings'	=> svg_text_404_box_06,
        'type'          => 'textarea',
        'description' => 'SVGのコードを入力して下さい',
    ) ) );
}
add_action( 'customize_register', 'theme_404_customizer' );//カスタマイザーに登録
 
//ヘッダーテンプレートの取得
function get_the_404_temp_select(){
 return get_theme_mod( temp_404_select);
}

?>