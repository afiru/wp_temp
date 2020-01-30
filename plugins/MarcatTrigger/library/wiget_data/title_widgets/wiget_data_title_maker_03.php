<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

//■画像+タイトル+サブタイトル+文章+一覧へのリンク作成用アイテム■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTitle03 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '画像+タイトル+サブタイトル+文章+一覧のコンテンツ作成', 'text_domain' ), // Name
            array( 'description' => __( '画像+タイトル+サブタイトル+文章+一覧のコンテンツボックスを作成します。' ), ) // Args
        );
    }
    function widget($args, $instance) {
        extract( $args );
        $MarcatWidgetTriggerItemTitle03_widget_main_span_img 		= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_span_img', $instance['MarcatWidgetTriggerItemTitle03_widget_main_span_img'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text 	= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text', $instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img		= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img', $instance['MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_caption 		= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_caption', $instance['MarcatWidgetTriggerItemTitle03_widget_main_caption'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_link 			= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_link', $instance['MarcatWidgetTriggerItemTitle03_widget_main_link'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_link_target	= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_link_target', $instance['MarcatWidgetTriggerItemTitle03_widget_main_link_target'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text	= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text', $instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text'] );
        $MarcatWidgetTriggerItemTitle03_widget_main_link_pref	= apply_filters( 'MarcatWidgetTriggerItemTitle03_widget_main_link_pref', $instance['MarcatWidgetTriggerItemTitle03_widget_main_link_pref'] );
    	?>
    <section class="marcat_wg_title_title_03">
        <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_link))://リンク有り ?>
            <div class="thumbs_list">
                <a href="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_link; ?>" target="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_link_target; ?>">
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_span_img)): ?>
                        <img src="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_span_img; ?>">
                    <?php endif; ?>
                </a>
            </div>
            <section class="marcat_wg_title_title_03_pref_box">
                <section class="marcat_wg_title_title_03_title_wapper">
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text)): ?>
                        <span class="marcat_wg_title_title_03_title_span">
                            <h2>
                                <?php echo $MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text; ?>
                            </h2>
                        </span>
                    <?php endif; ?>
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text)): ?>
                        <p><?php echo nl2br($MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text); ?></p>
                    <?php endif; ?>
                </section>
                <section class="marcat_wg_title_title_03_main_pref">
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_caption)): ?>
                        <p><?php echo nl2br($MarcatWidgetTriggerItemTitle03_widget_main_caption); ?></p>
                    <?php endif; ?>
                </section>
                <div class="marcat_wg_title_title_03_link_box">
                    <a href="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_link; ?>" target="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_link_target; ?>">
                        <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_link_pref)): ?>
                        <span class="link_icon"><?php echo $MarcatWidgetTriggerItemTitle03_widget_main_link_pref; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </section>
        <?php else://リンクなし ?>
            <div class="thumbs_list">
                <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_span_img)): ?>
                    <img src="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_span_img; ?>">
                <?php endif; ?>
            </div>
            <section class="marcat_wg_title_title_03_pref_box">
                <section class="marcat_wg_title_title_03_title_wapper">
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text)): ?>
                        <span class="marcat_wg_title_title_03_title_span">
                            <h2>
                                <?php echo $MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text; ?>
                            </h2>
                        </span>
                    <?php endif; ?>
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text)): ?>
                        <p><?php echo nl2br($MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text); ?></p>
                    <?php endif; ?>
                </section>
                <section class="marcat_wg_title_title_03_main_pref">
                    <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_caption)): ?>
                        <p><?php echo nl2br($MarcatWidgetTriggerItemTitle03_widget_main_caption); ?></p>
                    <?php endif; ?>
                </section>
            </section>
        <?php endif; ?>
    </section>
    <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_span_img'] 		= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_span_img']);
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text'] 	= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text']);
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img'] 	= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img']);
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_caption'] 		= $new_instance['MarcatWidgetTriggerItemTitle03_widget_main_caption'];
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_link'] 			= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_link']);
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_link_target'] 	= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_link_target']);
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text'] 	= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text']);
        $instance['MarcatWidgetTriggerItemTitle03_widget_main_link_pref']	= strip_tags($new_instance['MarcatWidgetTriggerItemTitle03_widget_main_link_pref']);
        return $instance;
    }
    function form($instance) {
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_span_img'])){ $MarcatWidgetTriggerItemTitle03_widget_main_span_img 	= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_span_img']);}
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text'])){ $MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text 	= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text']); }
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_caption'])){ $MarcatWidgetTriggerItemTitle03_widget_main_caption 	= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_caption']); }
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_link'])){ $MarcatWidgetTriggerItemTitle03_widget_main_link 		= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_link']); }
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_link_target'])){ $MarcatWidgetTriggerItemTitle03_widget_main_link_target 	= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_link_target']); }
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text'])){ 
            $MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text 	= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text']);             
        }
        if(!empty($instance['MarcatWidgetTriggerItemTitle03_widget_main_link_pref'])){ 
            $MarcatWidgetTriggerItemTitle03_widget_main_link_pref 	= esc_attr($instance['MarcatWidgetTriggerItemTitle03_widget_main_link_pref']);             
        }
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_span_img'); ?>">
            <?php _e('メインタイトル画像:'); ?>
            <br>
            <div class="thumbs_lists <?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img'); ?>_thumbs">
            <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_span_img)): ?>            
                <img src="<?php echo $MarcatWidgetTriggerItemTitle03_widget_main_span_img; ?>" style="max-width:100%;height: auto; ">            
            <?php endif; ?>
            </div>
            <input class="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_span_img'); ?>_input" id="img_list_MarcatWidgetTriggerItemTitle03_widget_mediaid" name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_span_img'); ?>" type="text" value="<?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_span_img)){ echo $MarcatWidgetTriggerItemTitle03_widget_main_span_img;} ?>"  style="display:block;width: 100%;"/>
            <span class="img_search_widget" data-inputid="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_span_img'); ?>_input" data-thumbs_class="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_thumbs_img'); ?>_thumbs" style="cursor:pointer;">画像のURLを調査する</span><br>
            <div id="media"></div>
        </p>        
        <p>
            <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text'); ?>">
              <?php _e('タイトルの記入(テキストで出力する項目)'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text'); ?>" name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text'); ?>" type="text" value="<?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text)){ echo $MarcatWidgetTriggerItemTitle03_widget_main_h2_title_text;} ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text'); ?>">
              <?php _e('サブタイトルの記入(テキストで出力する項目)'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text'); ?>" name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text'); ?>" type="text" value="<?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text)){ echo $MarcatWidgetTriggerItemTitle03_widget_main_h2_sub_title_text;} ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_caption'); ?>">
            <?php _e('文章:'); ?>
          </label>
          <textarea  class="widefat" rows="16" colls="20" id="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_caption'); ?>" name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_caption'); ?>"><?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_caption)): ?><?php echo $MarcatWidgetTriggerItemTitle03_widget_main_caption; ?><?php endif; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_link_pref'); ?>">
            <?php _e('リンクボックス文章:'); ?>
          </label>
            <input class="widefat" id="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_link_pref'); ?>" name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_link_pref'); ?>" type="text" value="<?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_link_pref)) {echo $MarcatWidgetTriggerItemTitle03_widget_main_link_pref;} ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_link'); ?>">
            <?php _e('リンク先のURL:'); ?>
          </label>
            <input class="widefat" id="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_link'); ?>" name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_link'); ?>" type="text" value="<?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_link)) {echo $MarcatWidgetTriggerItemTitle03_widget_main_link;} ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('MarcatWidgetTriggerItemTitle03_widget_main_link_target'); ?>">
            <?php _e('リンクターゲット:'); ?>
          </label>
          <?php $link_target = array('_self'=>'同一タブ','_blank'=>'新規タブ'); ?>
          <select name="<?php echo $this->get_field_name('MarcatWidgetTriggerItemTitle03_widget_main_link_target'); ?>" size="">
            <?php foreach($link_target as $key => $val): ?>
            <option value="<?php echo $key; ?>" <?php if(!empty($MarcatWidgetTriggerItemTitle03_widget_main_link_target)){ $MarcatWidgetTriggerItemTitle03_widget_main_link_target = (int)$MarcatWidgetTriggerItemTitle03_widget_main_link_target; if($MarcatWidgetTriggerItemTitle03_widget_main_link_target===$key){ echo 'selected'; } } ?>><?php echo $val; ?>で表示</option>
            <?php endforeach; ?>
          </select>
        </p>
<?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("MarcatWidgetTriggerItemTitle03");'));
?>