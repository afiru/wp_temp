<?php get_header(); ?>
<?php remove_filter ('the_content', 'wpautop'); ?>
<aside class="breadcrumb_list"><?php if(function_exists('bcn_display')) { bcn_display(); }?></aside>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); $custom_page_data = marcatgia($post->ID);   ?>
<main class="single_<?php echo $post->post_name; ?>_main_contents ">
    <?php the_content(); ?>
</main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>