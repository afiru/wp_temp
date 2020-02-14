<?php

define('seo_tab_section', 'seo_tab_section'); //セクションIDの定数化
define('seo_title', 'seo_title'); //セクションIDの定数化
define('h1_text', 'h1_text'); //セクションIDの定数化
define('keywords', 'keywords');
define('description', 'description');
define('google_analytics', 'google_analytics');

define('body_after_code', 'body_after_code');
define('thanks_cvc_tag', 'thanks_cvc_tag');

function theme_seo_customizer( $wp_customize ) {
    $wp_customize->add_section( seo_tab_section , array(
        'title' => 'SEO関連設定', //セクション名
        'priority' => 30, //カスタマイザー項目の表示順
        'description' => 'SEO関連設定', //セクションの説明
    ) );

    
    $wp_customize->add_setting( h1_text );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, h1_text, array(
        'label'	=> 'h1の設定',
        'section'	=> seo_tab_section,
        'settings'	=> h1_text,
        'description' => 'h1の設定を行いましょう。',
    ) ) );
    


}
add_action( 'customize_register', 'theme_seo_customizer' );//カスタマイザーに登録