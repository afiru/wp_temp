<?php if(get_amp_cheack()): // AMP対応ページの場合 ?>
<?php get_template_part('include_files/footer/footer_amp'); ?>
<?php else: ?>
<?php get_template_part('include_files/footer/footer_defo'); ?>
<?php endif; ?>
