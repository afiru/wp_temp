<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■本日の投稿を出す■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTopix05 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '本日の投稿【サムネイル/タイトル/コンテンツ】', 'text_domain' ), // Name
            array( 'description' => __( '本日の投稿【サムネイル/タイトル/コンテンツ】', 'text_domain' ), )
        );
    }
    function widget($args, $instance) {
        extract( $args );
        $post_type_hira          = apply_filters( 'widget_post_type', $instance['post_type_hira'] );
        $cat_id_hira             = apply_filters( 'widget_cat_id', $instance['cat_id_hira'] );
        $postnum_hira            = apply_filters( 'widget_postnum', $instance['postnum_hira'] );
        $link_pref_hira          = apply_filters( 'widget_link_pref', $instance['link_pref_hira'] );
        $h2_title_hira           = apply_filters( 'widget_link_pref', $instance['h2_title_hira'] );
        $sub_title_hira          = apply_filters( 'widget_link_pref', $instance['sub_title_hira'] );
        
        $week = date( 'W' );
        $year = date( 'Y' );
        $day  = date( 'd' );
        $args = array(
                'post_type' => 'post',
                'cat'=> $cat_id_hira,
                'date_query' => array(
                                array(
                                        'year' => date( 'Y' ),
                                        'week' => date( 'W' ),
                                        'day' => date( 'd' ),
                                ),
                        ),
                );
        $the_query = new WP_Query( $args );
        
        if ( $the_query->have_posts()):
            while ( $the_query->have_posts() ):
                ?>
                <div class="wiget_data_topix_maker_05_wapper">
                    <div class="thumbs">
                        <a href="<?php echo get_the_permalink($post->ID); ?>">
                            <?php echo get_the_post_thumbnail( $post->ID, 'medium', 'wiget_data_topix_maker_05_thumbs_img' ); ?>
                        </a>
                    </div>
                    <section class="wiget_data_topix_maker_05_pref">
                        <h3><?php echo get_the_title($post->ID); ?></h3>
                        <p><?php echo the_content(); ?></p>
                    </section>
                </div>
                <?php
            endwhile;
        endif;
    }
    
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
        $instance['h2_title_hira']       = strip_tags($new_instance['h2_title_hira']);
        $instance['sub_title_hira']      = strip_tags($new_instance['sub_title_hira']);
    	$instance['post_type_hira']      = strip_tags($new_instance['post_type_hira']);
    	$instance['cat_id_hira']         = strip_tags($new_instance['cat_id_hira']);
    	$instance['postnum_hira']        = strip_tags($new_instance['postnum_hira']);
        $instance['link_pref_hira']      = strip_tags($new_instance['link_pref_hira']);
        return $instance;
    }
    function form($instance) {
        if(!empty($instance)) {
            $h2_title_hira       = esc_attr($instance['h2_title_hira']);
            $sub_title_hira      = esc_attr($instance['sub_title_hira']);
            $set_post_type_hira  = esc_attr($instance['post_type_hira']);
            $postnum_hira       = esc_attr($instance['postnum_hira']);
            $link_pref_hira      = esc_attr($instance['link_pref_hira']);
            $cat_id_hira         = esc_attr($instance['cat_id_hira']);
        }
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('postnum_hira'); ?>">
          <?php _e('出力件数設定:'); ?>
          </label>
          <select name="<?php echo $this->get_field_name('postnum_hira'); ?>" size="">
              <?php for($i=1;$i<=30;$i++): ?>
              <option value="<?php echo $i; ?>" <?php if(!empty($postnum_hira)){ $postnum_hira = (int)$postnum_hira; if($postnum_hira===$i){ echo 'selected'; } } ?>><?php echo $i; ?>件だけ表示</option>
              <?php endfor; ?>          	  
          </select>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('cat_id_hira'); ?>">
           <?php _e('抽出カテゴリー選択:'); ?>
           </label>
            <select name="<?php echo $this->get_field_name('cat_id_hira'); ?>" size="" style="width: 100%;">
            <?php
                $args = array('orderby' => 'order','order' => 'ASC');
                $cat_all = get_categories($args);
            ?>
            <option value="null" <?php if(!empty($cat_id_hira)){ if($cat_id_hira=="null"){ echo 'selected'; } } ?>>--選択なし--</option>
            <?php foreach($cat_all as $value): ?>
              <option value="<?php echo esc_html($value->cat_ID); ?>" <?php if(!empty($cat_id_hira)){ $cat_id_hira = (int)$cat_id_hira; if($cat_id_hira==$value->cat_ID){ echo 'selected'; } } ?>>
                  <?php echo esc_html($value->name); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </p>
        <?php
    }
}
function ListMarcatWidgetTriggerItemTopix05() {
    register_widget( 'MarcatWidgetTriggerItemTopix05' );
}
add_action( 'widgets_init', 'ListMarcatWidgetTriggerItemTopix05' );
?>