<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■新着情報【Newアイコン・日付（年月日）・タイトル】■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTopix03 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '新着情報【Newアイコン・日付（年月日）・タイトル】', 'text_domain' ), // Name
            array( 'description' => __( '新着情報【Newアイコン・日付（年月日）・タイトル】の新着情報を作成します。これには、タイトルとサブタイトルに加えて、一覧へのリンクも作成できるようになっています。', 'text_domain' ), )
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
        if($cat_id_hira === "null") {
            $posts = get_posts("numberposts=$postnum_hira&post_type=$post_type_hira&orderby=post_date&order=DESC");             
        }else {
            $posts = get_posts("numberposts=$postnum_hira&post_type=$post_type_hira&category=$cat_id_hira&orderby=post_date&order=DESC");
        }
        $posts_bu = backupposts();
        ?>
        <section class="wiget_data_topix_maker_03">
            <section class="wiget_data_topix_maker_03_title_wapper">
                <div class="wiget_data_topix_maker_03_title_section">
                    <h2><?php echo $h2_title_hira; ?><span class="wiget_data_topix_maker_03_sub_title"><?php echo $sub_title_hira; ?></span></h2>
                </div>
                <div class="wiget_data_topix_maker_03_title_link_box">
                    <?php if(!$post_type_hira==='post'): ?>
                        <a href="<?php echo home_url('/'); ?><?php echo $post_type_hira; ?>/">
                            <span class="wiget_data_topix_maker_03_title_link_arrow"><?php echo $link_pref_hira; ?></span>
                        </a>
                    <?php else: ?>
                        <?php if($cat_id_hira == "null" or $cat_id_hira == ""): ?>
                        <?php else: ?>
                        <a href="<?php echo get_category_link($cat_id_hira); ?>">
                            <span class="wiget_data_topix_maker_03_title_link_arrow"><?php echo $link_pref_hira; ?></span>
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </section>
            <?php if(!empty($posts)): ?>
                <ul class="wiget_data_topix_maker_03_topics_loop">
                    <?php foreach($posts as $post): ?>
                        <?php
                            $posttime = new DateTime(get_the_date('Y-m-d',$post->ID));
                            $week = array("日", "月", "火", "水", "木", "金", "土");
                            $psotw = (int)$posttime->format('w');
                            $postweek = "(". $week[$psotw]. ")";
                            $categories_datas = get_the_category($post->ID);
                            foreach($categories_datas as $category_data) {
                                if($category_data->name == "最新情報") {
                                    
                                }else {
                                    $cat_id = $category_data->cat_ID;
                                    $cat_slug = $category_data->category_nicename;
                                    $cat_link = get_category_link($category_data->cat_ID);
                                }
                            }
                            
                        ?>
                        <li>
                            <a href="<?php echo get_the_permalink($post->ID); ?>">
                                <div class="wiget_data_topix_maker_03_date_box">
                                    <span class="new_wapper"><?php get_new_flug_2(get_the_date('Y.m.d',$post->ID)); ?></span>
                                    <span class="new_date"><?php echo get_the_date('Y年m月d日',$post->ID); ?></span>
                                </div>
                                <p><?php echo get_the_title($post->ID); ?></p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif;backupposts($posts_bu); ?>
        </section>
        <?php
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
          <label for="<?php echo $this->get_field_id('h2_title'); ?>">
          <?php _e('タイトル名:（h2として使用します。）'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('h2_title_hira'); ?>" value="<?php if(!empty($h2_title_hira)){ echo $h2_title_hira;} ?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('sub_title_hira'); ?>">
          <?php _e('サブタイトル名:（spanとして使用します。）'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('sub_title_hira'); ?>" value="<?php if(!empty($sub_title_hira)){ echo $sub_title_hira;} ?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('post_type_hira'); ?>">
          <?php _e('ポストタイプ設定:'); ?>
          </label>
            <select name="<?php echo $this->get_field_name('post_type_hira'); ?>" size="">
                <option value="post" <?php if(!empty($set_post_type_hira)){ if($set_post_type_hira==='post'){ echo 'selected'; } } ?>>
                    post
                </option>
                <?php
                    $args = array(
                       'public'   => true,
                       '_builtin' => false
                    );
                    $output = 'names'; // names or objects, note names is the default
                    $operator = 'and'; // 'and' or 'or'
                    $allpost_types = get_post_types( $args, $output, $operator ); 
                    foreach ( $allpost_types  as $allpost_type ) { ?>
                        <option value="<?php echo $allpost_type; ?>" <?php if(!empty($set_post_type_hira)){ if($set_post_type_hira===$allpost_type){ echo 'selected'; } } ?>>
                            <?php echo esc_html($allpost_type); ?>
                        </option>
                    <?php }
                ?>
            </select>
        </p>
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
            <label for="<?php echo $this->get_field_id('link_pref_hira'); ?>">
            <?php _e('一覧へのリンク文言:'); ?>
            </label>
            <input type="text" name="<?php echo $this->get_field_name('link_pref_hira'); ?>" value="<?php if(!empty($link_pref_hira)){ echo $link_pref_hira;} ?>">
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('cat_id_hira'); ?>">
           <?php _e('一覧へのカテゴリー設定:'); ?>
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
function ListMarcatWidgetTriggerItemTopix03() {
    register_widget( 'MarcatWidgetTriggerItemTopix03' );
}
add_action( 'widgets_init', 'ListMarcatWidgetTriggerItemTopix03' );
?>