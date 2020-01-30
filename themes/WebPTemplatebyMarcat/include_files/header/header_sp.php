<header class="sp_display_flex_center wapper sp_header_box">
    <a class="logo_sp_box" href="<?php echo home_url('/'); ?>">
        <?php echo get_logo_img(); ?>
        <h1 class="logo_etc_head_logo_h1">株式会社コウキ</h1>
    </a>
    <div class="sp_menu_box_wapper sp_menu_button off">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<!--ロゴ出力時-->
<h1 class="header_base_logo_wapper"><?php echo get_logo_img(); ?></h1>

<!--お問合せ画像出力時使用-->
<div class="contact_button_wapper"><?php echo get_contact_sp_pass_img(); ?></div>

<!--スマホメニューボタン使用-->
<div class="sp_menu_button off"><?php echo get_sp_menu_button_img(); ?></div> 

<!--メニューの呼び込み(ここから）-->
<?php 
$header_menu_name = 'メニューでチェックを入れた場所の名前';//要変更
$header_menu_nav_class = 'メニューのnavタグのクラス名';//要変更
$header_menu_ul_class = 'メニューのulタグのクラス名';//要変更
if( has_nav_menu( $header_menu_name ) ){ 
    wp_nav_menu ( array (
        'menu' => $header_menu_name,'menu_id' => $header_menu_name,'theme_location' => $header_menu_name, 'depth' => 2,'fallback_cb'     => 'wp_page_menu',
        'container' => 'nav','container_class'  =>$header_menu_nav_class,'menu_class' => $header_menu_ul_class
    ));
}
?>
<!--メニューの呼び込み(ここまで）-->

<!--ウィジェットの呼び込み(ここから）-->
<?php $read_widget_name = 'ウィジェット名';//要変更 ?>
<?php if ( is_active_sidebar( $read_widget_name ) ): dynamic_sidebar($read_widget_name);  endif; ?>
<!--ウィジェットの呼び込み(ここまで）-->

<header>
    
</header>