<?php get_template_part('include_files/footer/footer'); ?>
</div>
<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script async src="//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/lodash@4.17.5/lodash.min.js"></script>
<script async src="<?php echo get_bloginfo('template_url'); ?>/js/lightbox.min.js"></script>
<script async src="<?php echo get_bloginfo('template_url'); ?>/js/lazyload.min.js"></script>
<script async src="<?php echo get_bloginfo('template_url'); ?>/js/inview.min.js"></script>
<?php wp_footer(); ?>
<script async type="text/javascript" src='<?php echo get_bloginfo('template_url'); ?>/js/config.js'> </script>
<script async type="text/javascript" src='<?php echo get_bloginfo('template_url'); ?>/js/inview_setting.js'> </script>
<script type="text/javascript" src='<?php echo get_bloginfo('template_url'); ?>/js/bxslider_setting.js'> </script>
<script>
    window.WebFontConfig = {
      google: { families: ['Noto+Sans+JP:100,300,400,500,700,900','Noto+Serif+JP:200,300,400,500,600,700,900','Oswald:200,300,400,500,600,700'] },
      active: function() {
        sessionStorage.fonts = true;
      }
    };

    (function() {
      var wf = document.createElement('script');
      wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.type = 'text/javascript';
      wf.async = 'true';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(wf, s);
    })();
  
    requestAnimationFrame(function(e) {
      e = document.createElement('link');
      e.rel = 'stylesheet';
      e.href = '<?php echo get_bloginfo('template_url'); ?>/css/basestyle.css';
      document.head.appendChild(e);
    });
    requestAnimationFrame(function(e) {
      e = document.createElement('link');
      e.rel = 'stylesheet';
      e.href = '<?php echo get_bloginfo('template_url'); ?>/css/lightbox.min.css';
      document.head.appendChild(e);
    });

</script>
</body>
</html>
