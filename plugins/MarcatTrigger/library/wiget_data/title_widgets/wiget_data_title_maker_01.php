<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■画像+文章+画像+文章のコンテンツ作成用アイテム■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTitle01 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '画像+文章+画像+文章のコンテンツ作成', 'text_domain' ), // Name
            array( 'description' => __( '画像+文章+画像+文章のコンテンツボックスを作成します。' ), ) // Args
        );
    }
    function widget($args, $instance) {
        extract( $args );
        $widget_main_span_img 		= apply_filters( 'widget_main_span_img', $instance['widget_main_span_img'] );
        $widget_main_h2_title_text 	= apply_filters( 'widget_main_h2_title_text', $instance['widget_main_h2_title_text'] );
        $widget_main_thumbs_img		= apply_filters( 'widget_main_thumbs_img', $instance['widget_main_thumbs_img'] );
        $widget_main_caption 		= apply_filters( 'widget_main_caption', $instance['widget_main_caption'] );
        $widget_main_link 			= apply_filters( 'widget_main_link', $instance['widget_main_link'] );
        $widget_main_link_target	= apply_filters( 'widget_main_link_target', $instance['widget_main_link_target'] );
    	?>
    <div class="bbpres_bike">
        <?php if(!empty($widget_main_link))://リンク有り ?>
        <a href="<?php echo $widget_main_link; ?>" target="<?php echo $widget_main_link_target; ?>">
          <div class="bbpres_bike_img_wapper">
            <?php if(!empty($widget_main_span_img)): ?>
              <div class="bbpres_bike_img_box"> <img src="<?php echo $widget_main_span_img; ?>"> </div>
            <?php endif; ?>
            <?php if(!empty($widget_main_h2_title_text)): ?>            
              <h2><span class="icon_title"><?php echo $widget_main_h2_title_text; ?></span></h2>
            <?php endif; ?>
          </div>
        <?php if(!empty($widget_main_thumbs_img)): ?>
          <div class="bbpres_bike_thumbs_wapper">
              <img src="<?php echo $widget_main_thumbs_img; ?>">
          </div>
        <?php endif; ?>
        <?php if(!empty($widget_main_caption)): ?>
          <div class="bbpres_bike_main_caption_wapper">
              <p><?php echo nl2br($widget_main_caption); ?></p>
          </div>
        <?php endif; ?>
        </a>
        <?php else://リンクなし ?>
          <div class="bbpres_bike_img_wapper">
            <?php if(!empty($widget_main_span_img)): ?>
              <div class="bbpres_bike_img_box">
                  <img src="<?php echo $widget_main_span_img; ?>">
              </div>
            <?php endif; ?>
            <?php if(!empty($widget_main_h2_title_text)): ?>
              <h2><span class="icon_title"><?php echo $widget_main_h2_title_text; ?></span></h2>
            <?php endif; ?>
          </div>
          <?php if(!empty($widget_main_thumbs_img)): ?>
              <div class="bbpres_bike_thumbs_wapper">
                  <img src="<?php echo $widget_main_thumbs_img; ?>">
              </div>
          <?php endif; ?>
          <?php if(!empty($widget_main_caption)): ?>
              <div class="bbpres_bike_main_caption_wapper">
                <p><?php echo nl2br($widget_main_caption); ?></p>
              </div>
          <?php endif; ?>
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
        if(!empty($instance['widget_main_span_img'])){      $widget_main_span_img 	= esc_attr($instance['widget_main_span_img']);}
        if(!empty($instance['widget_main_h2_title_text'])){ $widget_main_h2_title_text = esc_attr($instance['widget_main_h2_title_text']); }
        if(!empty($instance['widget_main_thumbs_img'])){    $widget_main_thumbs_img 	= esc_attr($instance['widget_main_thumbs_img']); }
        if(!empty($instance['widget_main_caption'])){       $widget_main_caption 	= esc_attr($instance['widget_main_caption']); }
        if(!empty($instance['widget_main_link'])){          $widget_main_link 		= esc_attr($instance['widget_main_link']); }
        if(!empty($instance['widget_main_link_target'])){   $widget_main_link_target 	= esc_attr($instance['widget_main_link_target']); }        
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('widget_main_span_img'); ?>">
            <?php _e('メインタイトル画像:'); ?>
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
          <label for="<?php echo $this->get_field_id('widget_main_h2_title_text'); ?>">
            <?php _e('タイトルの記入(テキストで出力する項目):'); ?>
          </label>
    <input class="widefat" id="<?php echo $this->get_field_id('widget_main_h2_title_text'); ?>" name="<?php echo $this->get_field_name('widget_main_h2_title_text'); ?>" type="text" value="<?php if(!empty($widget_main_h2_title_text)){ echo $widget_main_h2_title_text;} ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('widget_main_thumbs_img'); ?>">
                <?php _e('メインサムネイル画像:'); ?>
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
          <label for="<?php echo $this->get_field_id('widget_main_caption'); ?>">
            <?php _e('キャプション文章:'); ?>
          </label>
          <textarea  class="widefat" rows="16" colls="20" id="<?php echo $this->get_field_id('widget_main_caption'); ?>" name="<?php echo $this->get_field_name('widget_main_caption'); ?>">
                <?php if(!empty($widget_main_caption)): ?>
                    <?php echo $widget_main_caption; ?>
                <?php endif; ?>              
          </textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('widget_main_h2_title_text'); ?>">
            <?php _e('リンク先のURL:'); ?>
          </label>
            <input class="widefat" id="<?php echo $this->get_field_id('widget_main_link'); ?>" name="<?php echo $this->get_field_name('widget_main_link'); ?>" type="text" value="<?php if(!empty($widget_main_link)) {echo $widget_main_link;} ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('widget_main_link_target'); ?>">
            <?php _e('リンクターゲット:'); ?>
          </label>
          <?php $link_target = array('_self'=>'同一タブ','_blank'=>'新規タブ'); ?>
          <select name="<?php echo $this->get_field_name('widget_main_link_target'); ?>" size="">
            <?php foreach($link_target as $key => $val): ?>
            <option value="<?php echo $key; ?>" <?php if(!empty($widget_main_link_target)){ $widget_main_link_target = (int)$widget_main_link_target; if($widget_main_link_target===$key){ echo 'selected'; } } ?>><?php echo $val; ?>で表示</option>
            <?php endforeach; ?>
          </select>
        </p>
<?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("MarcatWidgetTriggerItemTitle01");'));
?>