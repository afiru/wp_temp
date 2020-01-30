<?php
list($logo_width, $logo_height, $logo_type, $logo_attr) = getimagesize(get_php_customzer('header_logo_amp_pc_image'));
?>
<footer>
    <aside class="footer_menu">
        <h2 class="index_site_about_h2"><?php echo get_bloginfo('name'); ?>について<ruby>About This Site</ruby></h2>
        <?php 
            $header_menu_name = 'index_pc_nav_02';//要変更
            $header_menu_nav_class = 'amp_index_site_about_menu';//要変更
            $header_menu_ul_class = 'flex_row amp_index_site_about_menu_ul';//要変更
            if( has_nav_menu( $header_menu_name ) ){ 
                wp_nav_menu ( array (
                    'nav' => $header_menu_name,'menu_id' => $header_menu_name,'theme_location' => $header_menu_name, 'depth' => 2,'fallback_cb'     => 'wp_page_menu',
                    'container' => 'menu','container_class'  =>$header_menu_nav_class,'menu_class' => $header_menu_ul_class
                ));
            }
        ?>
    </aside>
    
    <figure class="footer_logo">
        <a href="<?php echo home_url('/?amp=1'); ?>">
            <amp-img
                    src="<?php echo get_php_customzer('header_logo_amp_pc_image'); ?>"
                    width="<?php echo $logo_width; ?>"
                    height="<?php echo $logo_height; ?>"
                    layout="responsive">
            </amp-img>
        </a>
    </figure>
    
    <p class="address">Copyright© <?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?> , 2018 All Rights Reserved.</p>
</footer>