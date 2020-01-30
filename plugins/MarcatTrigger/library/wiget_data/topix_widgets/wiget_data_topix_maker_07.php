<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■新着情報【サムネイル・文章・カテゴリー部分】■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemTopix07 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '【ウェブチ　コンテンツ No.006】', 'text_domain' ), // Name
            array( 'description' => __( '【ウェブチ　コンテンツ No.006】で使用する、2段リストでの表示上部にサムネイル、下にテキストが来る新着情報一覧フィード', 'text_domain' ), )
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
        if($cat_id_hira == "null") {
            $posts = get_posts("numberposts=$postnum_hira&post_type=$post_type_hira&orderby=post_date&order=DESC");             
        }else {
            $posts = get_posts("numberposts=$postnum_hira&post_type=$post_type_hira&category=$cat_id_hira&orderby=post_date&order=DESC");
        }
        $posts_bu = backupposts();
        ?>
        <section class="wiget_data_topix_maker_07">
            <?php if(!empty($posts)): ?>
                <ul class="wiget_data_topix_maker_07_topics_loop wapper_column_<?php echo $postnum_hira; ?>">
                    <?php $i=1; foreach($posts as $post): $customdata = marcatgia($post->ID); ?>
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
                        <?php if($i%2===1): ?><div class="wiget_data_topix_maker_07_list_wapper"><?php endif; ?>
                        <li>
                            <?php if(empty($customdata['webchi_google_map_code'])): ?>
                                <div class="wiget_data_topix_maker_07_thumbs">
                                    <?php if(!empty($customdata['webchi_sp_imglinks'])): ?>
                                        <img class="pc_only" src="<?php print_r(wp_get_attachment_url(get_post_thumbnail_id( $post->ID ))); ?>">
                                        <img class="sp_only" src="<?php echo $customdata['webchi_sp_imglinks']; ?>">
                                    <?php else: ?>
                                        <img src="<?php print_r(wp_get_attachment_url(get_post_thumbnail_id( $post->ID ))); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="wiget_data_topix_maker_07_google_code" style="padding:<?php if(!empty($customdata['webchi_google_paddings'])){ echo $customdata['webchi_google_paddings'] ;} else{ echo 0; } ?>% 0;">
                                    <?php echo $customdata['webchi_google_map_code']; ?>
                                </div>
                            <?php endif; ?>
                            <p class="wiget_data_topix_maker_07_post_pref">
                                <?php echo nl2br(honbuntagnasi_rest_cheanges($post->ID,'200')); ?>
                            </p>
                        </li>
                        <?php if($i%2===0): ?></div><?php endif; ?>
                    <?php $i++; endforeach; ?>
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
              <?php for($i=4;$i<=8;$i++): ?>
              <option value="<?php echo $i; ?>" <?php if(!empty($postnum_hira)){ $postnum_hira = (int)$postnum_hira; if($postnum_hira===$i){ echo 'selected'; } } ?>><?php echo $i; ?>件だけ表示</option>
              <?php endfor; ?>          	  
          </select>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('cat_id_hira'); ?>">
           <?php _e('フィード選択:'); ?>
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
function ListMarcatWidgetTriggerItemTopix07() {
    register_widget( 'MarcatWidgetTriggerItemTopix07' );
}
add_action( 'widgets_init', 'ListMarcatWidgetTriggerItemTopix07' );
?>