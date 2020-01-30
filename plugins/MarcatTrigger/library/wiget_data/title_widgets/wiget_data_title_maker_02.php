<?php

//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');


/*■タイトル（日本語+英語で使用する）■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTitle02 extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
                '', // Base ID
                __( 'タイトルを作成するウィジェット（日本語+英語）', 'text_domain' ), // Name
                array( 'description' => __( 'h2とpタグで作るタイトルウィジェットです。', 'text_domain' ), ) // Args
        );
    }
    function widget($args, $instance)
    {
        extract( $args );
        $Marcat_wg_title_w_h2_title           = apply_filters( 'widget_link_pref', $instance['Marcat_wg_title_w_h2_title'] );
        $Marcat_wg_title_w_sub_title          = apply_filters( 'widget_link_pref', $instance['Marcat_wg_title_w_sub_title'] );
        ?>
        <dvi class="marcat_wg_title_<?php echo $this->get_field_id('wiget_data'); ?>_wapper">
            <div class="marcat_wg_title">
                <?php if(!empty($Marcat_wg_title_w_h2_title)): ?><span class="title_h2_span_box_title_box"><h2><?php echo $Marcat_wg_title_w_h2_title; ?></h2></span><?php endif; ?>
                <?php if(!empty($Marcat_wg_title_w_sub_title)): ?><p class="title_h2_pref"><?php echo $Marcat_wg_title_w_sub_title; ?></p><?php endif; ?>
            </div>
        </dvi>
        <?php
    }
    function update($new_instance, $old_instance)
    {
    	$instance = $old_instance;
        $instance['Marcat_wg_title_w_h2_title']       = strip_tags($new_instance['Marcat_wg_title_w_h2_title']);
        $instance['Marcat_wg_title_w_sub_title']      = strip_tags($new_instance['Marcat_wg_title_w_sub_title']);
        return $instance;
    }
    function form($instance) 
    {
        if(!empty($instance)) {
            $Marcat_wg_title_w_h2_title       = esc_attr($instance['Marcat_wg_title_w_h2_title']);
            $Marcat_wg_title_w_sub_title      = esc_attr($instance['Marcat_wg_title_w_sub_title']);
        }
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('Marcat_wg_title_w_h2_title'); ?>">
          <?php _e('タイトル名:（h2として使用します。）'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('Marcat_wg_title_w_h2_title'); ?>" value="<?php if(!empty($Marcat_wg_title_w_h2_title)){ echo $Marcat_wg_title_w_h2_title;} ?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('Marcat_wg_title_w_sub_title'); ?>">
          <?php _e('サブタイトル名:（spanとして使用します。）'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('Marcat_wg_title_w_sub_title'); ?>" value="<?php if(!empty($Marcat_wg_title_w_sub_title)){ echo $Marcat_wg_title_w_sub_title;} ?>">
        </p>
        <?php
    }
}
function ListMarcatWidgetTriggerItemTitle02() {
    register_widget( 'MarcatWidgetTriggerItemTitle02' );
}
add_action( 'widgets_init', 'ListMarcatWidgetTriggerItemTitle02' );


?>