<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■画像+文章+画像+文章のコンテンツ作成用アイテム■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTitle06 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '【ウェブチ　コンテンツ No.015～017】', 'text_domain' ), // Name
            array( 'description' => __( '【ウェブチ　コンテンツ No.015～017】で使用する、画像とナビのコンテンツボックスです。' ), ) // Args
        );
    }
    function widget($args, $instance) {
        extract( $args );
        $widget_main_span_img 		= apply_filters( 'widget_main_span_img', $instance['widget_main_span_img'] );
        $widget_main_h2_title_text 	= apply_filters( 'widget_main_h2_title_text', $instance['widget_main_h2_title_text'] );
        $widget_main_thumbs_img		= apply_filters( 'widget_main_thumbs_img', $instance['widget_main_thumbs_img'] );
        $widget_main_caption 		= apply_filters( 'widget_main_caption', $instance['widget_main_caption'] );
        $widget_main_link 		= apply_filters( 'widget_main_link', $instance['widget_main_link'] );
        $widget_main_link_target	= apply_filters( 'widget_main_link_target', $instance['widget_main_link_target'] );
    	?>
        <div class="marcat_title_06_wapper">
            <div class="marcat_title_inner_wapper">
                <?php if(!empty($widget_main_link_target)): ?><a href="<?php echo $widget_main_link_target; ?>"><?php endif; ?>
                    <?php if(!empty($widget_main_thumbs_img)): ?>
                        <div class="marcatwidgettriggeritemtitle_06_pc_box pc_only">
                            <img class="pc_only" src="<?php echo $widget_main_thumbs_img; ?>" alt="<?php echo $widget_main_h2_title_text ; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($widget_main_span_img)): ?>
                        <div class="marcatwidgettriggeritemtitle_06_pc_box sp_only">
                            <img class="sp_only" src="<?php echo $widget_main_span_img; ?>" alt="<?php echo $widget_main_h2_title_text ; ?>">
                        </div>
                    <?php endif; ?>
                <?php if(!empty($widget_main_link_target)): ?></a><?php endif; ?>
            </div>
            <?php if(!empty($widget_main_link)): ?>
            <menu class="marcat_title_06_menu_wapper">
                <?php 
                    if( has_nav_menu( $widget_main_link ) ){ 
                        wp_nav_menu ( array (
                            'menu' => $widget_main_link,
                            'menu_id' => $widget_main_link,
                            'theme_location' => $widget_main_link,
                            'depth' => 2,
                            'fallback_cb'     => 'wp_page_menu',
                            'container' => 'nav',
                            'container_class'  => $widget_main_link,
                            'menu_class' => $widget_main_link
                        ));
                    }
                ?>  
            </menu>
            <?php endif; ?>
        </div>
        <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['widget_main_span_img'] 	= strip_tags($new_instance['widget_main_span_img']);
        $instance['widget_main_h2_title_text'] 	= strip_tags($new_instance['widget_main_h2_title_text']);
        $instance['widget_main_thumbs_img'] 	= strip_tags($new_instance['widget_main_thumbs_img']);
        $instance['widget_main_caption'] 	= $new_instance['widget_main_caption'];
        $instance['widget_main_link'] 		= strip_tags($new_instance['widget_main_link']);
        $instance['widget_main_link_target'] 	= strip_tags($new_instance['widget_main_link_target']);
        return $instance;
    }
    function form($instance) {
        global $nav_list_new;
        if(!empty($instance['widget_main_span_img'])){      $widget_main_span_img 	= esc_attr($instance['widget_main_span_img']);}
        if(!empty($instance['widget_main_h2_title_text'])){ $widget_main_h2_title_text = esc_attr($instance['widget_main_h2_title_text']); }
        if(!empty($instance['widget_main_thumbs_img'])){    $widget_main_thumbs_img 	= esc_attr($instance['widget_main_thumbs_img']); }
        if(!empty($instance['widget_main_caption'])){       $widget_main_caption 	= esc_attr($instance['widget_main_caption']); }
        if(!empty($instance['widget_main_link'])){          $widget_main_link 		= esc_attr($instance['widget_main_link']); }
        if(!empty($instance['widget_main_link_target'])){   $widget_main_link_target 	= esc_attr($instance['widget_main_link_target']); }        
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('widget_main_thumbs_img'); ?>">
                <?php _e('PC画像:'); ?>
            <br>
            <div class="thumbs_lists <?php echo $this->get_field_id('widget_main_thumbs_img'); ?>_thumbs_02">
                <?php if(!empty($widget_main_thumbs_img)): ?>
                    <img src="<?php echo $widget_main_thumbs_img; ?>" style="max-width:100%;height: auto; ">
                <?php endif; ?>                
            </div>
            <input class="<?php echo $this->get_field_id('widget_main_thumbs_img'); ?>_input_02" id="img_list_widget_mediaid_02" name="<?php echo $this->get_field_name('widget_main_thumbs_img'); ?>" type="text" value="<?php if(!empty($widget_main_thumbs_img)){ echo $widget_main_thumbs_img;} ?>" style="display:block;width: 100%;" />
            <span class="img_search_widget_02" data-inputid="<?php echo $this->get_field_id('widget_main_thumbs_img'); ?>_input_02" data-thumbs_class="<?php echo $this->get_field_id('widget_main_thumbs_img'); ?>_thumbs_02" style="cursor:pointer;">画像のURLを調査する</span><br>
            <div id="media"></div>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('widget_main_span_img'); ?>">
            <?php _e('SP画像:'); ?>
            <br>
            <div class="thumbs_lists <?php echo $this->get_field_id('widget_main_thumbs_img'); ?>_thumbs">
            <?php if(!empty($widget_main_span_img)): ?>            
                <img src="<?php echo $widget_main_span_img; ?>" style="max-width:100%;height: auto; ">            
            <?php endif; ?>
            </div>
            <input class="<?php echo $this->get_field_id('widget_main_span_img'); ?>_input" id="img_list_widget_mediaid" name="<?php echo $this->get_field_name('widget_main_span_img'); ?>" type="text" value="<?php if(!empty($widget_main_span_img)){ echo $widget_main_span_img;} ?>"  style="display:block;width: 100%;"/>
            <span class="img_search_widget" data-inputid="<?php echo $this->get_field_id('widget_main_span_img'); ?>_input" data-thumbs_class="<?php echo $this->get_field_id('widget_main_thumbs_img'); ?>_thumbs" style="cursor:pointer;">画像のURLを調査する</span><br>
            <div id="media"></div>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('widget_main_link_target'); ?>">
          <?php _e('リンク先設定'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('widget_main_link_target'); ?>" value="<?php if(!empty($widget_main_link_target)){ echo $widget_main_link_target;} ?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('widget_main_h2_title_text'); ?>">
            <?php _e('画像のalt部分※入れるようにしてください。'); ?>
          </label>
            <input class="widefat" id="<?php echo $this->get_field_id('widget_main_h2_title_text'); ?>" name="<?php echo $this->get_field_name('widget_main_h2_title_text'); ?>" type="text" value="<?php if(!empty($widget_main_h2_title_text)){ echo $widget_main_h2_title_text;} ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('widget_main_link'); ?>">
                <?php _e('出力するメニューのリストを選んでください。事前にメニューでチェックを入れておいてください。'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('widget_main_link'); ?>" size="" style="width: 100%;">
                <?php foreach($nav_list_new as $key=>$val): ?>
                <option value="<?php echo $val; ?>" <?php if(!empty($widget_main_link)){  if($widget_main_link===$val){ echo 'selected'; } } ?>>
                    <?php echo esc_html($val); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </p>
<?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("MarcatWidgetTriggerItemTitle06");'));
?>