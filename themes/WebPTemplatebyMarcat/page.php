<?php get_header(); ?>
<?php remove_filter ('the_content', 'wpautop'); ?>
<?php if(get_amp_cheack()): // AMP対応ページの場合 ?>
    <?php get_template_part('include_files/page/amp_page'); ?>
<?php else: ?>
    <!--パンくず使用時-->
    <aside class="breadcrumb_list"><?php if(function_exists('bcn_display')) { bcn_display(); }?></aside>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); $custom_page_data = marcatgia($post->ID);  $catdata = get_the_single($post->ID);  $cat_name = strtoupper($catdata[0]->slug); ?>
    <main class="single_<?php echo $post->post_name; ?>_main_contents ">
        <?php the_content(); ?>
    </main>
    <?php endwhile; // end of the loop. ?>
<?php endif; ?>
<?php get_footer(); ?>