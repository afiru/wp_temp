<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■画像+文章+画像+文章のコンテンツ作成用アイテム■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemSlider02 extends WP_Widget {
    public function __construct() {
        parent::__construct(
            '', // Base ID
            __( '【ウェブチ　コンテンツ No.001】', 'text_domain' ), // Name
            array( 'description' => __( '【ウェブチ　コンテンツ No.001】で使用する、スライダーの設定を行います。' ), ) // Args
        );
    }
    public function widget($args, $instance) {
        extract( $args );
        $wiget_data_slaider_02_mode = apply_filters( 'wiget_data_slaider_02_mode', $instance['wiget_data_slaider_02_mode'] );
        $wiget_data_slaider_02_auto = apply_filters( 'wiget_data_slaider_02_auto', $instance['wiget_data_slaider_02_auto'] );
        $wiget_data_slaider_02_speed = apply_filters( 'wiget_data_slaider_02_speed', $instance['wiget_data_slaider_02_speed'] );
        $wiget_data_slaider_02_pause = apply_filters( 'wiget_data_slaider_02_pause', $instance['wiget_data_slaider_02_pause'] );
        $wiget_data_slaider_02_infiniteLoop = apply_filters( 'wiget_data_slaider_02_infiniteLoop', $instance['wiget_data_slaider_02_infiniteLoop'] );
        $wiget_data_slaider_02_captions = apply_filters( 'wiget_data_slaider_02_captions', $instance['wiget_data_slaider_02_captions'] );
        $wiget_data_slaider_02_responsive = apply_filters( 'wiget_data_slaider_02_responsive', $instance['wiget_data_slaider_02_responsive'] );
        $wiget_data_slaider_02_touchEnabled = apply_filters( 'wiget_data_slaider_02_touchEnabled', $instance['wiget_data_slaider_02_touchEnabled'] );
        $wiget_data_slaider_02_pager = apply_filters( 'wiget_data_slaider_02_pager', $instance['wiget_data_slaider_02_pager'] );
        $wiget_data_slaider_02_controls = apply_filters( 'wiget_data_slaider_02_controls', $instance['wiget_data_slaider_02_controls'] );
        $wiget_data_slaider_02_nextText = apply_filters( 'wiget_data_slaider_02_nextText', $instance['wiget_data_slaider_02_nextText'] );
        $wiget_data_slaider_02_prevText = apply_filters( 'wiget_data_slaider_02_prevText', $instance['wiget_data_slaider_02_prevText'] );
        $wiget_data_slaider_02_prevSelector = apply_filters( 'wiget_data_slaider_02_prevSelector', $instance['wiget_data_slaider_02_prevSelector'] );
        $wiget_data_slaider_02_useCSS = apply_filters( 'wiget_data_slaider_02_useCSS', $instance['wiget_data_slaider_02_useCSS'] );
        $wiget_data_slaider_02_easing = apply_filters( 'wiget_data_slaider_02_easing', $instance['wiget_data_slaider_02_easing'] );
        $wiget_data_slaider_02_autoDirection = apply_filters( 'wiget_data_slaider_02_autoDirection', $instance['wiget_data_slaider_02_autoDirection'] );
        $wiget_data_slaider_02_autoHover= apply_filters( 'wiget_data_slaider_02_autoHover', $instance['wiget_data_slaider_02_autoHover'] );
        $wiget_data_slaider_02_minSlides= apply_filters( 'wiget_data_slaider_02_minSlides', $instance['wiget_data_slaider_02_minSlides'] );
        $wiget_data_slaider_02_maxSlides= apply_filters( 'wiget_data_slaider_02_maxSlides', $instance['wiget_data_slaider_02_maxSlides'] );
        $wiget_data_slaider_02_moveSlides= apply_filters( 'wiget_data_slaider_02_moveSlides', $instance['wiget_data_slaider_02_moveSlides'] );
        $wiget_data_slaider_02_slideWidth= apply_filters( 'wiget_data_slaider_02_slideWidth', $instance['wiget_data_slaider_02_slideWidth'] );
        $wiget_data_slaider_02_oput_put_category = apply_filters( 'wiget_data_slaider_02_oput_put_category', $instance['wiget_data_slaider_02_oput_put_category'] );
        $wiget_data_slaider_02_outputposts= apply_filters( 'wiget_data_slaider_02_outputposts', $instance['wiget_data_slaider_02_outputposts'] );
        $wiget_data_slaider_02_slideMargin= apply_filters( 'wiget_data_slaider_02_slideMargin', $instance['wiget_data_slaider_02_slideMargin'] );
        
        //投稿一覧作成
        if(empty($wiget_data_slaider_02_oput_put_category) or $wiget_data_slaider_02_oput_put_category === "null") {
            $args = array(
                'post_type' => array('slider'), /* 投稿タイプを指定 */
                'posts_per_page' => $wiget_data_slaider_02_outputposts,
                'order' => 'DESC',
                'orderby' => 'date'
            );
        }else {
            $type = get_query_var( $wiget_data_slaider_02_oput_put_category ); //指定したいタクソノミーを指定
            $args = array(
                'post_type' => 'slider',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'slider_category',
                        'field'    => 'slug',
                        'terms'    => $wiget_data_slaider_02_oput_put_category,
                    ),
                ),
                'posts_per_page' => $wiget_data_slaider_02_outputposts,
                'order' => 'DESC',
                'orderby' => 'date'
            );
        }
        
        ?>
        <?php query_posts( $args ); ?>
        <?php if (have_posts()) : ?>
            <article id="slaid_<?php echo $this->get_field_id('wiget_data'); ?>_wapper" class="slaid_<?php echo $this->get_field_id('wiget_data'); ?>_wapper">
                <ul class="<?php echo $this->get_field_id('wiget_data'); ?>">
                    <?php while (have_posts()) : the_post(); /* ループ開始 */ ?>
                        <?php
                        $image_id = get_post_thumbnail_id();
                        $image_url = wp_get_attachment_image_src($image_id, true);
                        ?>
                        <?php if(!empty($image_url[0])): ?>
                            <li><img src="<?php echo $image_url[0]; ?>" class="thumb"></li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            </article>
        <?php endif; ?>
    <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['wiget_data_slaider_02_mode'] = strip_tags($new_instance['wiget_data_slaider_02_mode']);
        $instance['wiget_data_slaider_02_auto'] = strip_tags($new_instance['wiget_data_slaider_02_auto']);
        $instance['wiget_data_slaider_02_speed'] = strip_tags($new_instance['wiget_data_slaider_02_speed']);
        $instance['wiget_data_slaider_02_pause'] = strip_tags($new_instance['wiget_data_slaider_02_pause']);
        $instance['wiget_data_slaider_02_infiniteLoop'] = strip_tags($new_instance['wiget_data_slaider_02_infiniteLoop']);
        $instance['wiget_data_slaider_02_captions'] = strip_tags($new_instance['wiget_data_slaider_02_captions']);
        $instance['wiget_data_slaider_02_responsive'] = strip_tags($new_instance['wiget_data_slaider_02_responsive']);
        $instance['wiget_data_slaider_02_touchEnabled'] = strip_tags($new_instance['wiget_data_slaider_02_touchEnabled']);
        $instance['wiget_data_slaider_02_pager'] = strip_tags($new_instance['wiget_data_slaider_02_pager']);
        $instance['wiget_data_slaider_02_controls'] = strip_tags($new_instance['wiget_data_slaider_02_controls']);
        $instance['wiget_data_slaider_02_nextText'] = strip_tags($new_instance['wiget_data_slaider_02_nextText']);
        $instance['wiget_data_slaider_02_prevText'] = strip_tags($new_instance['wiget_data_slaider_02_prevText']);
        $instance['wiget_data_slaider_02_prevSelector'] = strip_tags($new_instance['wiget_data_slaider_02_prevSelector']);
        $instance['wiget_data_slaider_02_useCSS'] = strip_tags($new_instance['wiget_data_slaider_02_useCSS']);
        $instance['wiget_data_slaider_02_easing'] = strip_tags($new_instance['wiget_data_slaider_02_easing']);
        $instance['wiget_data_slaider_02_autoDirection'] = strip_tags($new_instance['wiget_data_slaider_02_autoDirection']);
        $instance['wiget_data_slaider_02_autoHover'] = strip_tags($new_instance['wiget_data_slaider_02_autoHover']);
        $instance['wiget_data_slaider_02_minSlides'] = strip_tags($new_instance['wiget_data_slaider_02_minSlides']);
        $instance['wiget_data_slaider_02_maxSlides'] = strip_tags($new_instance['wiget_data_slaider_02_maxSlides']);
        $instance['wiget_data_slaider_02_moveSlides'] = strip_tags($new_instance['wiget_data_slaider_02_moveSlides']);
        $instance['wiget_data_slaider_02_slideWidth'] = strip_tags($new_instance['wiget_data_slaider_02_slideWidth']);
        $instance['wiget_data_slaider_02_oput_put_category'] = strip_tags($new_instance['wiget_data_slaider_02_oput_put_category']);
        $instance['wiget_data_slaider_02_outputposts'] = strip_tags($new_instance['wiget_data_slaider_02_outputposts']);
        $instance['wiget_data_slaider_02_slideMargin'] = strip_tags($new_instance['wiget_data_slaider_02_slideMargin']);
        return $instance;
    }
    public function form($instance) {
        if(!empty($instance['wiget_data_slaider_02_mode'])){ 
            $wiget_data_slaider_02_mode = esc_attr($instance['wiget_data_slaider_02_mode']);            
        }else {
            $wiget_data_slaider_02_mode = "";
        }
        if(!empty($instance['wiget_data_slaider_02_auto'])){ 
            $wiget_data_slaider_02_auto = esc_attr($instance['wiget_data_slaider_02_auto']);            
        }else {
            $wiget_data_slaider_02_auto = "";
        }
        if(!empty($instance['wiget_data_slaider_02_speed'])){ 
            $wiget_data_slaider_02_speed = esc_attr($instance['wiget_data_slaider_02_speed']);            
        }else {
            $wiget_data_slaider_02_speed = "";
        }
        if(!empty($instance['wiget_data_slaider_02_pause'])){ 
            $wiget_data_slaider_02_pause = esc_attr($instance['wiget_data_slaider_02_pause']);            
        }else {
            $wiget_data_slaider_02_pause = "";
        }
        if(!empty($instance['wiget_data_slaider_02_infiniteLoop'])){ 
            $wiget_data_slaider_02_infiniteLoop = esc_attr($instance['wiget_data_slaider_02_infiniteLoop']);            
        }else {
            $wiget_data_slaider_02_infiniteLoop = "";
        }
        if(!empty($instance['wiget_data_slaider_02_captions'])){ 
            $wiget_data_slaider_02_captions = esc_attr($instance['wiget_data_slaider_02_captions']);            
        }else {
            $wiget_data_slaider_02_captions = "";
        }
        if(!empty($instance['wiget_data_slaider_02_responsive'])){ 
            $wiget_data_slaider_02_responsive = esc_attr($instance['wiget_data_slaider_02_responsive']);            
        }else {
            $wiget_data_slaider_02_responsive = "";
        }
        if(!empty($instance['wiget_data_slaider_02_touchEnabled'])){ 
            $wiget_data_slaider_02_touchEnabled = esc_attr($instance['wiget_data_slaider_02_touchEnabled']);            
        }else {
            $wiget_data_slaider_02_touchEnabled = "";
        }
        if(!empty($instance['wiget_data_slaider_02_pager'])){ 
            $wiget_data_slaider_02_pager = esc_attr($instance['wiget_data_slaider_02_pager']);            
        }else {
            $wiget_data_slaider_02_pager = "";
        }
        if(!empty($instance['wiget_data_slaider_02_controls'])){ 
            $wiget_data_slaider_02_controls = esc_attr($instance['wiget_data_slaider_02_controls']);            
        }else {
            $wiget_data_slaider_02_controls = "";
        }
        if(!empty($instance['wiget_data_slaider_02_nextText'])){ 
            $wiget_data_slaider_02_nextText = esc_attr($instance['wiget_data_slaider_02_nextText']);            
        }else {
            $wiget_data_slaider_02_nextText = "";
        }
        if(!empty($instance['wiget_data_slaider_02_prevText'])){ 
            $wiget_data_slaider_02_prevText = esc_attr($instance['wiget_data_slaider_02_prevText']);            
        }else {
            $wiget_data_slaider_02_prevText = "";
        }
        if(!empty($instance['wiget_data_slaider_02_prevSelector'])){ 
            $wiget_data_slaider_02_prevSelector = esc_attr($instance['wiget_data_slaider_02_prevSelector']);            
        }else {
            $wiget_data_slaider_02_prevSelector = "";
        }
        if(!empty($instance['wiget_data_slaider_02_useCSS'])){ 
            $wiget_data_slaider_02_useCSS = esc_attr($instance['wiget_data_slaider_02_useCSS']);            
        }else {
            $wiget_data_slaider_02_useCSS = "";
        }
        if(!empty($instance['wiget_data_slaider_02_easing'])){ 
            $wiget_data_slaider_02_easing = esc_attr($instance['wiget_data_slaider_02_easing']);            
        }else {
            $wiget_data_slaider_02_easing = "";
        }
        if(!empty($instance['wiget_data_slaider_02_autoDirection'])){ 
            $wiget_data_slaider_02_autoDirection = esc_attr($instance['wiget_data_slaider_02_autoDirection']);            
        }else {
            $wiget_data_slaider_02_autoDirection = "";
        }
        if(!empty($instance['wiget_data_slaider_02_autoHover'])){ 
            $wiget_data_slaider_02_autoHover = esc_attr($instance['wiget_data_slaider_02_autoHover']);            
        }else {
            $wiget_data_slaider_02_autoHover = "";
        }
        if(!empty($instance['wiget_data_slaider_02_minSlides'])){ 
            $wiget_data_slaider_02_minSlides = esc_attr($instance['wiget_data_slaider_02_minSlides']);            
        }else {
            $wiget_data_slaider_02_minSlides = "";
        }
        if(!empty($instance['wiget_data_slaider_02_maxSlides'])){ 
            $wiget_data_slaider_02_maxSlides = esc_attr($instance['wiget_data_slaider_02_maxSlides']);            
        }else {
            $wiget_data_slaider_02_maxSlides = "";
        }
        if(!empty($instance['wiget_data_slaider_02_moveSlides'])){ 
            $wiget_data_slaider_02_moveSlides = esc_attr($instance['wiget_data_slaider_02_moveSlides']);            
        }else {
            $wiget_data_slaider_02_moveSlides = "";
        }
        if(!empty($instance['wiget_data_slaider_02_slideWidth'])){ 
            $wiget_data_slaider_02_slideWidth = esc_attr($instance['wiget_data_slaider_02_slideWidth']);            
        }else {
            $wiget_data_slaider_02_slideWidth = "";
        }
        if(!empty($instance['wiget_data_slaider_02_oput_put_category'])){ 
            $wiget_data_slaider_02_oput_put_category = esc_attr($instance['wiget_data_slaider_02_oput_put_category']);            
        }else {
            $wiget_data_slaider_02_oput_put_category = "";
        }
        if(!empty($instance['wiget_data_slaider_02_outputposts'])){ 
            $wiget_data_slaider_02_outputposts = esc_attr($instance['wiget_data_slaider_02_outputposts']);            
        }else {
            $wiget_data_slaider_02_outputposts = "";
        }
        if(!empty($instance['wiget_data_slaider_02_slideMargin'])){ 
            $wiget_data_slaider_02_slideMargin = esc_attr($instance['wiget_data_slaider_02_slideMargin']);            
        }else {
            $wiget_data_slaider_02_slideMargin = "";
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_oput_put_category'); ?>">
                <?php _e('出力カテゴリー分類'); ?>
            </label>
            <?php $terms = get_terms('slider_category'); ?>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_oput_put_category'); ?>" style="width: 100%">
                <option value="null" <?php if($wiget_data_slaider_02_oput_put_category === "null") { echo 'selected'; } ?>>-指定なし-</option>
                <?php foreach ( $terms as $term ): ?>
                    <option value="<?php echo $term->slug; ?>" <?php if($term->slug == $wiget_data_slaider_02_oput_put_category){ echo 'selected'; } ?>><?php echo $term->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_outputposts'); ?>">
                <?php _e('出力件数'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_outputposts'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_02_outputposts){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_mode'); ?>">
                <?php _e('スライド方法を設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_mode'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('horizontal'=>'横方向のスライド','vertical'=>'縦方向のスライド','fade'=>'フェードでの切り替え'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_mode){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_auto'); ?>">
                <?php _e('自動スライドの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_auto'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'自動スライドする','false'=>'自動スライドしない'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_auto){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>        
        
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_speed'); ?>">
                <?php _e('スライドの速さ'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_speed'); ?>" style="width: 100%">
                <?php for($count = 500; $count <= 2000;): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_02_speed){ echo 'selected'; } ?>><?php echo $count; ?></option>
                <?php  $count = $count + 50; endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_pause'); ?>">
                <?php _e('スライドしてから次のスライドまでの待ち時間の設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_pause'); ?>" style="width: 100%">
                <?php for($count = 1000; $count <= 20000;): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_02_pause){ echo 'selected'; } ?>><?php echo $count; ?></option>
                <?php  $count = $count + 100; endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_infiniteLoop'); ?>">
                <?php _e('スライドをループさせるかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_infiniteLoop'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'スライドをループさせる','false'=>'スライドをループしない'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_infiniteLoop){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_captions'); ?>">
                <?php _e('画像にキャプションを表示する事ができます。タグのtitleプロパティ内に記述したものが表示されます。'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_captions'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'スライドをループさせる','false'=>'スライドをループしない'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_captions){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_responsive'); ?>">
                <?php _e('レスポンシブに対応するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_responsive'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'レスポンシブに対応する','false'=>'レスポンシブに対応しない'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_responsive){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_touchEnabled'); ?>">
                <?php _e('タッチスワイプを許可するかを設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_touchEnabled'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'タッチスワイプを許可する','false'=>'タッチスワイプを許可しない'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_touchEnabled){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_pager'); ?>">
                <?php _e('ページ送りを追加するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_pager'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'ページャーを追加する','false'=>'ページャーを削除'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_pager){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_controls'); ?>">
                <?php _e('前後のコントロールを追加するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_controls'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'前後のコントロールを追加','false'=>'前後のコントロールを削除'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_controls){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_useCSS'); ?>">
                <?php _e('スライドにCSSアニメーションを使用するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_useCSS'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true '=>'CSSアニメーションを使用する','false'=>'CSSアニメーションを使用しない'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_useCSS){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_autoDirection'); ?>">
                <?php _e('スライドの方向'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_autoDirection'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('next'=>'右へ移動で切り替え','prev'=>'左へ移動で切り替え'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_autoDirection){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_autoHover'); ?>">
                <?php _e('スライドをホバーした時に、スライドを一時的に止めるかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_autoHover'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_02_mode_array = array('true'=>'一時停止','false'=>'一時停止無し'); ?>
                <?php foreach($wiget_data_slaider_02_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_02_autoHover){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_minSlides'); ?>">
                <?php _e('（カルーセル設定）一度に表示させる最小数を設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_minSlides'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_02_minSlides){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_maxSlides'); ?>">
                <?php _e('（カルーセル設定）一度に表示させる最大数を設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_maxSlides'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_02_maxSlides){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_moveSlides'); ?>">
                <?php _e('（カルーセル設定）一度のスライド時に移動するスライド数'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_02_moveSlides'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_02_moveSlides){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_slideWidth'); ?>">
                <?php _e('各スライドの幅を指定'); ?>
            </label>
            <input type="text" name="<?php echo $this->get_field_name('wiget_data_slaider_02_slideWidth'); ?>" value="<?php if(!empty($wiget_data_slaider_02_slideWidth)){ echo $wiget_data_slaider_02_slideWidth;} ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_02_slideMargin'); ?>">
                <?php _e('スライドの横の空間（px入力）'); ?>
            </label>
            <input type="text" name="<?php echo $this->get_field_name('wiget_data_slaider_02_slideMargin'); ?>" value="<?php if(!empty($wiget_data_slaider_02_slideMargin)){ echo $wiget_data_slaider_02_slideMargin;} ?>">
        </p>
    <?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("MarcatWidgetTriggerItemSlider02");'));



?>