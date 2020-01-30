<?php get_header(); ?>

<section class="margin_100 test_config">
    <p>test</p>
</section>
<?php //ここから記載する ?>

    <?php //ウィジェットデータの呼び込み　 ?>
    <?php if ( is_active_sidebar( 'ウィジェットID' ) ) : ?>
        <?php dynamic_sidebar( 'ウィジェットID' ); ?>
    <?php endif; ?>

<?php //ここまで ?>
<?php get_footer(); ?>