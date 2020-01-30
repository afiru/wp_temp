<?php if(get_amp_cheack()): // AMP対応ページの場合 ?>
    <?php get_template_part('include_files/header/amp_header'); ?>
<?php else: ?>
    <?php get_template_part('include_files/header/def_header'); ?>
<?php endif; ?>
