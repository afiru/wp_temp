<?php get_header(); ?>
<?php if(get_amp_cheack()): // AMP対応ページの場合 ?>
    <?php get_template_part('include_files/category/single_amp'); ?>
<?php else: ?>
    <?php //カテゴリーテンプレート選別
        $category_template = array('スラッグ名');
        foreach($category_template as $key => $val):
            $template_name = 'include_files/category/category_' . $val;
            if ( in_category($val) ||post_is_in_descendant_category( get_term_by( 'slug', $val, 'category' ) )):
                get_template_part($template_name);
            endif;
        endforeach;
    ?>
<?php endif; ?>
<?php get_footer(); ?>
