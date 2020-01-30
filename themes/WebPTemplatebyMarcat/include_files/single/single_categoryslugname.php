<?php
    //※カテゴリーのスラッグを記入
    $cat_slug ="sulg_name";    
    //カテゴリーidを取得
    if(!empty($cat_slug)) {
        $cat_data = get_single_by_slug("sulg_name");
        $cat_id = $cat_data->cat_ID;
    }else {
        $cat_id = 0;
    }
    	
    //カテゴリー編集画面でカスタマイズしたデータの取得
    $catdate = get_cat_tax_img('single',$cat);
?>
<!--パンくず使用時-->
<aside class="breadcrumb_list"><?php if(function_exists('bcn_display')) { bcn_display(); }?></aside>

<main class="single_<?php echo $cat_slug; ?>_main_contents ">
<!--ループ内設定（ここから）-->
    <article class="single_<?php echo $cat_slug; ?>_archives_container">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); $custom_page_data = marcatgia($post->ID);  $catdata = get_the_single($post->ID);  $cat_name = strtoupper($catdata[0]->slug); ?>

            <!--カテゴリー名ごとに色が変わるアイコンの出力時-->
            <p class="single_<?php echo $cat_slug; ?>_icon topics_icon_clor_slug_<?php echo $catdata[0]->slug; ?>"><?php echo $cat_name; ?></p>

            <!--サムネイルを出力する場合-->
            <figure class="single_<?php echo $cat_slug; ?>_archives_thumbs">
                <?php if(!empty($custom_page_data['post_thumbs_list'])): echo $custom_page_data['post_thumbs_list']; endif; ?>
            </figure>

            <!--サムネイル内にnewアイコンを付ける場合-->
            <figure class="single_<?php echo $cat_slug; ?>_archives_thumbs_wapper position_relative">
                <?php if(!empty($custom_page_data['post_thumbs_list'])): echo $custom_page_data['post_thumbs_list']; endif; ?>
                <?php get_new_flug_3(get_the_date('Y.m.d',$post->ID)); ?>
            </figure>

            <!--NEWという文字だけを出力する場合-->
            <?php echo get_new_flug(get_the_date('Y.m.d',$post->ID)); ?>

            <!--日付を出力する場合 ('Y.m.d'を'Y年m月d日'とすれば、XXXX年X月X日と出力されます)-->
            <p class="single_<?php echo $cat_slug; ?>_archive_date"><?php echo get_the_date('Y.m.d',$post->ID); ?></p>

            <!--タイトルを出力する場合（文字数制限なし）-->
            <h2 class="single_<?php echo $cat_slug; ?>_archive_title"><?php echo get_the_title($post->ID); ?></h2>

            <!--タイトルを出力する場合（文字数制限あり ※数字部分を変更すると出力する文字が変わります。）-->
            <h2 class="single_<?php echo $cat_slug; ?>_archive_title"><?php echo titletagnasi($post->ID,100); ?></h2>

            <!--本文を出力する場合（文字数制限あり ※数字部分を変更すると出力する文字が変わります。）-->
            <p class="single_<?php echo $cat_slug; ?>_archive_pref"><?php echo honbuntagnasi($post->ID,100); ?></p>

        <?php endwhile; // end of the loop. ?>
    </article>
    <!--ループ内設定（ここまで）-->
    <aside class="single_pager_box">
        <?php
            $previous_button = '<img class="img_block" src="'.get_bloginfo('template_url').'/img/single/previous_button_off.svg">';
            $archives_button = '<img class="img_block" src="'.get_bloginfo('template_url').'/img/single/archives_button_off.svg">';
            $next_button = '<img class="img_block" src="'.get_bloginfo('template_url').'/img/single/next_button_off.svg">';
        ?>
        <ul class="pc_display_flex_center">
            <li><?php previous_post_link('%link',$previous_button, false, ''); ?></li>
            <li><a href="<?php echo get_category_link($catdata->cat_ID); ?>" class="to_archives_link_box"><?php echo $archives_button; ?></a></li>
            <li><?php next_post_link('%link', $next_button, false, ''); ?></li>
        </ul>
        <a href="<?php echo get_category_link($catdata->cat_ID); ?>" class="to_archives_link_box"><?php echo $archives_button; ?></a>
        <ul class="sp_flex_pager display_flex_center">
            <li><?php previous_post_link('%link',$previous_button, false, ''); ?></li>
            <li><?php next_post_link('%link', $next_button, false, ''); ?></li>                
        </ul>
    </aside>
</main>
<!--ページャー使用時-->
<aside class="page_nav_contents"><?php wp_pagenavi(); ?></aside>

