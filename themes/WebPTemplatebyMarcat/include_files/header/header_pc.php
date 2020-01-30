<header class="pc_display_flex_center wapper logo_etc_head">
    <a class="logo_etc_head_logo" href="<?php echo home_url('/'); ?>">
        <?php echo get_logo_img(); ?>
        <h1 class="logo_etc_head_logo_h1">株式会社コウキ</h1>
    </a>
    <div class="display_flex_center logo_etc_head_another" >
        <div class="string_chenge_nav">
            <div class="display_flex_center string_chenge">
                <p>文字サイズ</p>
                <div class="botton_wapper">
                    <button class="small current" onclick="s()">小</button>
                    <button class="middle" onclick="m()">中</button>
                    <button class="large" onclick="l()">大</button>
                </div>
            </div>
            <?php 
                $header_menu_name = 'header_pc_nav_01';//要変更
                $header_menu_nav_class = 'pc_main_nav';//要変更
                $header_menu_ul_class = 'display_flex_stretch pc_main_nav_ul';//要変更
                if( has_nav_menu( $header_menu_name ) ){ 
                    wp_nav_menu ( array (
                        'menu' => $header_menu_name,'menu_id' => $header_menu_name,'theme_location' => $header_menu_name, 'depth' => 2,'fallback_cb'     => 'wp_page_menu',
                        'container' => 'nav','container_class'  =>$header_menu_nav_class,'menu_class' => $header_menu_ul_class
                    ));
                }
            ?>
        </div>    
        <?php 
            $header_menu_name = 'header_pc_nav_03';//要変更
            $header_menu_nav_class = 'link_button_another_nav';//要変更
            $header_menu_ul_class = 'display_flex_stretch link_button_another_nav_ul';//要変更
            if( has_nav_menu( $header_menu_name ) ){ 
                wp_nav_menu ( array (
                    'menu' => $header_menu_name,'menu_id' => $header_menu_name,'theme_location' => $header_menu_name, 'depth' => 2,'fallback_cb'     => 'wp_page_menu',
                    'container' => 'nav','container_class'  =>$header_menu_nav_class,'menu_class' => $header_menu_ul_class
                ));
            }
        ?>
    </div>
</header>