<header class="pc_only pc_header_setting">
    <h1 class="t_center padding_top_5_bottom_5 back_000 color_fff header_h1"><?php echo get_the_h1_name(get_php_customzer('h1_text')); ?></h1>
    <div class="wapper padding_wapper_top_10_bottom_10 display_flex_stretch pc_header_wap">
        <a class="main_logo" href="<?php echo home_url('/'); ?>"><?php echo get_logo_img(); ?></a>
        <nav class="share_search_weather_join_login_contents">
            <?php 
                $header_menu_name = 'header_pc_nav_02';//要変更
                $header_menu_nav_class = '';//要変更
                $header_menu_ul_class = 'weather_join_login_content_ul';//要変更
                if( has_nav_menu( $header_menu_name ) ){ 
                    wp_nav_menu ( array (
                        'menu' => $header_menu_name,'menu_id' => $header_menu_name,'theme_location' => $header_menu_name, 'depth' => 2,'fallback_cb'     => 'wp_page_menu',
                        'container' => false,'container_class'  =>$header_menu_nav_class,'menu_class' => $header_menu_ul_class
                    ));
                }
            ?>
            <div class="share_search_contents">
                <div class="search_contents">
                    <form action="<?php echo home_url('/'); ?>">
                        <input type="search" name="s" value="" placeholder="">
                        <input type="hidden" name="cat" value="21">
                        <input type="image" src="<?php echo get_bloginfo('template_url'); ?>/img/header/button_submit.svg" value="" name="submit" width="20" height="20" />
                    </form>
                </div>
                <div class="share_contents">
                    <?php echo wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>
                </div>
            </div>
            
        </nav>
    </div>
</header>