<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■新着情報【サムネイル・サムネイル内NEWアイコン・日付（年月日曜日）・投稿ユーザー名・本文】■■■■■■■■*/
class MarcatWidgetTriggerItemTopix01 extends WP_Widget {
    function __construct() {
        parent::__construct(
            '', // Base ID
            __( '新着情報【サムネイル・サムネイル内NEWアイコン・日付（年月日曜日）・投稿ユーザー名・本文】', 'text_domain' ), // Name
            array( 'description' => __( '新着情報【サムネイル・サムネイル内NEWアイコン・日付（年月日曜日）・投稿ユーザー名・本文】の新着情報を作成します。' ), ) // Args
        );
    }
    function widget($args, $instance) {
        extract( $args );
        $post_type          = apply_filters( 'widget_post_type', $instance['post_type'] );
        $cat_id             = apply_filters( 'widget_cat_id', $instance['cat_id'] );
        $postnum            = apply_filters( 'widget_postnum', $instance['postnum'] );
        $link_pref          = apply_filters( 'widget_link_pref', $instance['link_pref'] );
        $h2_title           = apply_filters( 'widget_link_pref', $instance['h2_title'] );
        $sub_title          = apply_filters( 'widget_link_pref', $instance['sub_title'] );
        if($cat_id == "null") {
             $posts = get_posts("numberposts=$postnum&post_type=$post_type&orderby=post_date&order=DESC");
        }else {
           $posts = get_posts("category=$cat_id&orderby=post_date&order=DESC&numberposts=$postnum");
        }
        $posts_bu = backupposts();
        global $wpdb;
        $table_name = $wpdb->prefix .'ai1ec_events';
        ?>
        <div class="topics_box_date_titles">
            <?php
            if(!empty($posts)):
                ?>
                <ul class="topics_loop" id="topics_loop">
                <?php
                foreach($posts as $post):
                    $custom = marcatgia($post->ID);//カスタムフィールド値取得
                    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                    if(is_plugin_active( 'all-in-one-event-calendar/all-in-one-event-calendar.php' )){
                        $eventdate = $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $post->ID", ARRAY_A);                        
                        $data = date('Y年m月d日', $eventdate['start']);
                        $datacheack = date_i18n('Y-m-d', $eventdate['start']);
                        $datetime = new DateTime($datacheack);
                        $posttime = new DateTime(get_the_date('Y-m-d',$post->ID));
                        $week = array("日","月","火","水","木", "金", "土");
                        $week2 = array("日","月","火","水","木", "金", "土"); 
                        $w = (int)$datetime->format('w');
                        $psotw = (int)$posttime->format('w');
                        $week = "(". $week[$w]. ")";
                        $postweek = "(".$week2[$psotw]. ")";
                        $time =  date_i18n('H:i～', $eventdate['start']);                        
                        $get_list['start_date'] = $data.$week.$time;
                        $get_list['end_date'] = date_i18n('Y年m月d H:i', $eventdate['end']);
                        $get_list['place'] = $eventdate['venue'];
                    }
                    else {
                        $get_list['start_date'] = '';
                        $get_list['end_date'] = '';
                        $get_list['place'] = '';
                    }
                    ?>
                     <li>
                        <a href="<?php echo get_the_permalink( $post->ID); ?>">                            

                            <div class="table_links">
                                <div class="data_shop">
                                    <p class="date">
                                        <?php get_new_flug_3(get_the_date('Y.m.d',$post->ID)); ?>
                                        <span class="datebox"><?php echo get_the_date('Y.m.d',$post->ID); ?></span>
                                    </p>
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                </div>
                            </div>
                            <div class="pref">
                                <p><?php echo honbuntagnasi($post->ID,150); ?></p>
                            </div>
                            <div class="thumbs">                                
                                <?php echo get_the_post_thumbnail( $post->ID, array(300,300) ); ?>
                            </div>
                        </a>                
                    </li>
                    <?php
                endforeach;
                ?></ul><?php
            endif;
            backupposts($posts_bu);
            ?>
        </div>
        <?php
    }
    
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
        $instance['h2_title']       = strip_tags($new_instance['h2_title']);
        $instance['sub_title']      = strip_tags($new_instance['sub_title']);
    	$instance['post_type']      = strip_tags($new_instance['post_type']);
    	$instance['cat_id']         = strip_tags($new_instance['cat_id']);
    	$instance['postnum']        = strip_tags($new_instance['postnum']);
        $instance['link_pref']      = strip_tags($new_instance['link_pref']);
        return $instance;
    }
    
    function form($instance) {
        if(!empty($instance)) {
            $h2_title       = esc_attr($instance['h2_title']);
            $sub_title      = esc_attr($instance['sub_title']);
            $set_post_type  = esc_attr($instance['post_type']);
            $postnum        = esc_attr($instance['postnum']);
            $link_pref      = esc_attr($instance['link_pref']);
            $cat_id         = esc_attr($instance['cat_id']);
        }
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('h2_title'); ?>">
            <?php _e('タイトル名:（h2として使用します。）'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('h2_title'); ?>" value="<?php if(!empty($h2_title)){ echo $h2_title;} ?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('sub_title'); ?>">
            <?php _e('サブタイトル名:（spanとして使用します。）'); ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('sub_title'); ?>" value="<?php if(!empty($sub_title)){ echo $sub_title;} ?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('post_type'); ?>">
          <?php _e('ポストタイプ設定:'); ?>
          </label>
            <select name="<?php echo $this->get_field_name('post_type'); ?>" size="">
                <option value="post" <?php if(!empty($set_post_type)){ if($set_post_type==='post'){ echo 'selected'; } } ?>>
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
                        <option value="<?php echo $allpost_type; ?>" <?php if(!empty($set_post_type)){ if($set_post_type===$allpost_type){ echo 'selected'; } } ?>>
                            <?php echo esc_html($allpost_type); ?>
                        </option>
                    <?php }
                ?>
            </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('postnum'); ?>">
            <?php _e('出力件数設定:'); ?>
          </label>
          <select name="<?php echo $this->get_field_name('postnum'); ?>" size="">
              <?php for($i=1;$i<=30;$i++): ?>
                <option value="<?php echo $i; ?>" <?php if(!empty($postnum)){ $postnum = (int)$postnum; if($postnum===$i){ echo 'selected'; } } ?>>
                    <?php echo $i; ?>件だけ表示
                </option>
              <?php endfor; ?>          	  
          </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_pref'); ?>">
            <?php _e('一覧へのリンク文言:'); ?>
            </label>
            <input type="text" name="<?php echo $this->get_field_name('link_pref'); ?>" value="<?php if(!empty($link_pref)){ echo $link_pref;} ?>">
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('cat_id'); ?>">
           <?php _e('一覧へのカテゴリー設定:'); ?>
           </label>
          <select name="<?php echo $this->get_field_name('cat_id'); ?>" size="">
            <?php
                $args = array('orderby' => 'order','order' => 'ASC');
                $cat_all = get_categories($args);
            ?>
            <option value="null" <?php if(!empty($cat_id)){ if($cat_id=="null"){ echo 'selected'; } } ?>>--選択なし--
                </option>
            <?php foreach($cat_all as $value): ?>
              <option value="<?php echo esc_html($value->cat_ID); ?>" <?php if(!empty($cat_id)){ $cat_id = (int)$cat_id; if($cat_id==$value->cat_ID){ echo 'selected'; } } ?>>
                  <?php echo esc_html($value->name); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </p>
        <?php
    }
}
function ListMarcatWidgetTriggerItemTopix01() {
    register_widget( 'MarcatWidgetTriggerItemTopix01' );
}
add_action( 'widgets_init', 'ListMarcatWidgetTriggerItemTopix01' );
?>