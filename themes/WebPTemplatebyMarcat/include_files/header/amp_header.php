<?php
    //ロゴチェック
    list($width, $height, $type, $attr) = getimagesize(get_php_customzer('header_logo_amp_pc_image'));
    $date = '';
    if(is_single() or is_page()){
        $date = get_the_date('Y-m-d',get_the_ID()) . 'T00:00:00+00:00';    
        $thumbs_ulr = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
        $discription = get_post_meta($post->ID, _aioseop_description, true);
        if(!empty($thumbs_ulr)) {
            $thumbs_ulr = $thumbs_ulr;
            list($now_width, $now_height, $now_type, $now_attr) = getimagesize($thumbs_ulr);
        }else{
            $thumbs_ulr = get_php_customzer('header_logo_pc_image');
            list($now_width, $now_height, $now_type, $now_attr) = getimagesize(get_php_customzer('header_logo_pc_image'));
        }        
    }else{
        $discription = get_php_customzer('description');
        $thumbs_ulr = get_php_customzer('header_logo_amp_pc_image');
        list($now_width, $now_height, $now_type, $now_attr) = getimagesize(get_php_customzer('header_logo_amp_pc_image'));
        $date = '2018-12-07T00:00:00+00:00';
    }
?>
<!doctype html>
<html AMP lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php 
if(is_page() or is_single()){
    $canonical_url = get_permalink(); 
}else {
    $canonical_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}
?>
<link rel="canonical" href="<?php echo $canonical_url; ?>" />
<link rel="amphtml" href="<?php echo $canonical_url.'?amp=1'; ?>">
<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "url": "<?php echo home_url('/'); ?>",
        "headline": "<?php echo get_the_site_title(get_php_customzer('seo_title')); ?>",
        "datePublished": "<?php echo $date; ?>",
        "dateModified": "<?php echo $date; ?>",
        "description": "<?php echo $discription; ?>",
        "itemListElement": [
            <?php echo amp_breadcrumblist();?>
        ]
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo home_url('/'); ?>search?q={search_term}",
            "query-input": "required name=search_term"
        }
        "publisher": {
            "@type": "Organization",
            "name": "<?php bloginfo('name'); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo get_php_customzer('header_logo_amp_pc_image'); ?>",
                "width": "<?php echo $width; ?>",
                "height": "<?php echo $height; ?>"
            }
        },
        "author": {
            "@type": "Person",
            "name": "Marcatcube"
        },
        "image": {
            "@type": "ImageObject",
            "url": "<?php echo $thumbs_ulr; ?>",
            "height": "<?php echo $now_width; ?>",
            "width": "<?php echo $now_height; ?>"
        }
    }
</script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
<style amp-boilerplate>
    body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}
</style>
<style amp-custom>
    <?php echo file_get_contents(get_bloginfo('template_url').'/css/amp.css'); ?>
</style>
<noscript>
    <style amp-boilerplate>
        body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}
    </style>
</noscript>
</head>
<body>
<?php list($logo_width, $logo_height, $logo_type, $logo_attr) = getimagesize(get_php_customzer('header_logo_amp_pc_image')); ?>
<?php list($button_sp_menu_close_width, $button_sp_menu_close_height, $logo_type, $logo_attr) = getimagesize(get_php_customzer('button_sp_menu_close_image')); ?>
<amp-sidebar id="sidebar" class="slaid_menu_contens" layout="nodisplay" side="right">
    <div class="display_flex_center header_amp_box">
        <h1>
            <a href="<?php echo home_url('/?amp=1'); ?>">
                <amp-img
                        src="<?php echo get_php_customzer('header_logo_amp_pc_image'); ?>"
                        width="<?php echo $logo_width; ?>"
                        height="<?php echo $logo_height; ?>"
                        layout="responsive">
                </amp-img>
            </a>
        </h1>
        <figure  class="header_sp_button">
            <amp-img class="amp-open-image"
                src="<?php echo get_php_customzer('button_sp_menu_close_image'); ?>"
                width="<?php echo $button_sp_menu_close_width; ?>"
                height="<?php echo $button_sp_menu_close_height; ?>"
                alt="スマホメニューを開く"
                on="tap:sidebar.close"
                role="button"
                tabindex="0"
                layout="responsive"
            ></amp-img>
        </figure>
    </div>
    <nav class="pc_header_setting amp_global_menu ">
        
    </nav>
</amp-sidebar>
<header class="display_flex_center header_amp_box">
    <h1>
        <a href="<?php echo home_url('/?amp=1'); ?>">
            
            <amp-img
                    src="<?php echo get_php_customzer('header_logo_amp_pc_image'); ?>"
                    width="<?php echo $logo_width; ?>"
                    height="<?php echo $logo_height; ?>"
                    layout="responsive">
            </amp-img>
        </a>
    </h1>
    <figure  class="header_sp_button">
        
        <amp-img class="amp-open-image"
            src="<?php echo get_php_customzer('button_sp_menu_close_image'); ?>"
            width="<?php echo $button_sp_menu_close_width; ?>"
            height="<?php echo $button_sp_menu_close_height; ?>"
            alt="スマホメニューを開く"
            on="tap:sidebar.close"
            role="button"
            tabindex="0"
            layout="responsive"
        ></amp-img>
    </figure>
</header>
