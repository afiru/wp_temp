<?php get_header(); ?>
<main class="index_main">
    <section class="index_fv">
        <h2 class="back_000 color_fff">釣り場を地図から探す</h2>
        <div class="back_ground">
            <div class="mask"></div>
            <div class="wapper index_fv_wap">
                <?php 
                    $header_menu_name = 'index_pc_nav_01';//要変更
                    $header_menu_nav_class = 'index_fv_nav';//要変更
                    $header_menu_ul_class = 'index_fv_nav_ul';//要変更
                    if( has_nav_menu( $header_menu_name ) ){ 
                        wp_nav_menu ( array (
                            'menu' => $header_menu_name,'menu_id' => $header_menu_name,'theme_location' => $header_menu_name, 'depth' => 2,'fallback_cb'     => 'wp_page_menu',
                            'container' => 'nav','container_class'  =>$header_menu_nav_class,'menu_class' => $header_menu_ul_class
                        ));
                    }
                ?>
                <div class="text_justify color_fff index_fv_text">
                    <?php if ( is_active_sidebar( 'index_fv_text' ) ) : ?>
                        <?php dynamic_sidebar( 'index_fv_text' ); ?>
                    <?php endif; ?>
                </div>
                <div class="pc_only index_fv_map">
                    <img class="lazy" data-src="<?php echo get_bloginfo('template_url'); ?>/img/index/bg_pic_index_fv_map.svg" alt="日本地図">
                    <ul class="index_fv_map_ul">
                        <li class="index_fv_li">
                            <img class="lazy" data-src="<?php echo get_bloginfo('template_url'); ?>/img/index/pic_index_fv_li_01.svg" alt="北海道">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<section class="margin_100 test_config">
    <p>test</p>
</section>
<?php //ここから記載する ?>

    <?php //ウィジェットデータの呼び込み　 ?>


<?php //ここまで ?>
<?php get_footer(); ?>