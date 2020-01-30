<!--ロゴ出力時(ヘッダーと同じロゴを使用する場合)-->
<h1 class="footer_logo_box"><?php echo get_logo_img(); ?></h1>

<!--ロゴ出力時(ヘッダーと違うロゴを使用する場合)-->
<h1 class="footer_logo_box"><?php echo get_footer_logo_img(); ?></h1>

<?php 
//トップへ戻るボタン　カスタマイザーで登録必須。
//※登録時　通常を（画像ファイル名_off）ホバー時（画像ファイル名_on）として、同時にアップロード後
//通常時を選択。
?>
<a class="button_go_top" href="#page_top" title="ページトップへ戻る"><img src="<?php echo get_php_customzer('footer_go_top_button'); ?>" class="log" alt="<?php echo get_bloginfo('name'); ?>ページトップへ戻る"></a>

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
<?php //アドレス項目表示 カスタマイザーでアドレス項目を登録後表示  ?>
<p class="footer_pref"><?php echo get_php_customzer('footer_address_pref'); ?></p>