<?php
//■ベース呼び込み
$directory = dirname(__FILE__);
$directory_up = dirname($directory);
$directory_up2 = dirname($directory_up);
require_once( $directory_up2.'/base_lists_data.php');
require_once( $directory_up2.'/widget_base.php');

/*■画像+文章+画像+文章のコンテンツ作成用アイテム■■■■■■■■■■■■■■■■■■■■■■■■■*/
class MarcatWidgetTriggerItemSlider01 extends WP_Widget {
    public function __construct() {
        parent::__construct(
            '', // Base ID
            __( '■bxSliderを使用したスライダー', 'text_domain' ), // Name
            array( 'description' => __( 'bxSliderを使用したスライダーエリアを作成します。' ), ) // Args
        );
    }
    public function widget($args, $instance) {
        extract( $args );
        $wiget_data_slaider_01_mode = apply_filters( 'wiget_data_slaider_01_mode', $instance['wiget_data_slaider_01_mode'] );
        $wiget_data_slaider_01_auto = apply_filters( 'wiget_data_slaider_01_auto', $instance['wiget_data_slaider_01_auto'] );
        $wiget_data_slaider_01_speed = apply_filters( 'wiget_data_slaider_01_speed', $instance['wiget_data_slaider_01_speed'] );
        $wiget_data_slaider_01_pause = apply_filters( 'wiget_data_slaider_01_pause', $instance['wiget_data_slaider_01_pause'] );
        $wiget_data_slaider_01_infiniteLoop = apply_filters( 'wiget_data_slaider_01_infiniteLoop', $instance['wiget_data_slaider_01_infiniteLoop'] );
        $wiget_data_slaider_01_captions = apply_filters( 'wiget_data_slaider_01_captions', $instance['wiget_data_slaider_01_captions'] );
        $wiget_data_slaider_01_responsive = apply_filters( 'wiget_data_slaider_01_responsive', $instance['wiget_data_slaider_01_responsive'] );
        $wiget_data_slaider_01_touchEnabled = apply_filters( 'wiget_data_slaider_01_touchEnabled', $instance['wiget_data_slaider_01_touchEnabled'] );
        $wiget_data_slaider_01_pager = apply_filters( 'wiget_data_slaider_01_pager', $instance['wiget_data_slaider_01_pager'] );
        $wiget_data_slaider_01_controls = apply_filters( 'wiget_data_slaider_01_controls', $instance['wiget_data_slaider_01_controls'] );
        $wiget_data_slaider_01_nextText = apply_filters( 'wiget_data_slaider_01_nextText', $instance['wiget_data_slaider_01_nextText'] );
        $wiget_data_slaider_01_prevText = apply_filters( 'wiget_data_slaider_01_prevText', $instance['wiget_data_slaider_01_prevText'] );
        $wiget_data_slaider_01_prevSelector = apply_filters( 'wiget_data_slaider_01_prevSelector', $instance['wiget_data_slaider_01_prevSelector'] );
        $wiget_data_slaider_01_useCSS = apply_filters( 'wiget_data_slaider_01_useCSS', $instance['wiget_data_slaider_01_useCSS'] );
        $wiget_data_slaider_01_easing = apply_filters( 'wiget_data_slaider_01_easing', $instance['wiget_data_slaider_01_easing'] );
        $wiget_data_slaider_01_autoDirection = apply_filters( 'wiget_data_slaider_01_autoDirection', $instance['wiget_data_slaider_01_autoDirection'] );
        $wiget_data_slaider_01_autoHover= apply_filters( 'wiget_data_slaider_01_autoHover', $instance['wiget_data_slaider_01_autoHover'] );
        $wiget_data_slaider_01_minSlides= apply_filters( 'wiget_data_slaider_01_minSlides', $instance['wiget_data_slaider_01_minSlides'] );
        $wiget_data_slaider_01_maxSlides= apply_filters( 'wiget_data_slaider_01_maxSlides', $instance['wiget_data_slaider_01_maxSlides'] );
        $wiget_data_slaider_01_moveSlides= apply_filters( 'wiget_data_slaider_01_moveSlides', $instance['wiget_data_slaider_01_moveSlides'] );
        $wiget_data_slaider_01_slideWidth= apply_filters( 'wiget_data_slaider_01_slideWidth', $instance['wiget_data_slaider_01_slideWidth'] );
        $wiget_data_slaider_01_oput_put_category = apply_filters( 'wiget_data_slaider_01_oput_put_category', $instance['wiget_data_slaider_01_oput_put_category'] );
        $wiget_data_slaider_01_outputposts= apply_filters( 'wiget_data_slaider_01_outputposts', $instance['wiget_data_slaider_01_outputposts'] );
        $wiget_data_slaider_01_slideMargin= apply_filters( 'wiget_data_slaider_01_slideMargin', $instance['wiget_data_slaider_01_slideMargin'] );
        
        //投稿一覧作成
        if(empty($wiget_data_slaider_01_oput_put_category) or $wiget_data_slaider_01_oput_put_category === "null") {
            $args = array(
                'post_type' => array('slider'), /* 投稿タイプを指定 */
                'posts_per_page' => $wiget_data_slaider_01_outputposts,
                'order' => 'DESC',
                'orderby' => 'date'
            );
        }else {
            $type = get_query_var( $wiget_data_slaider_01_oput_put_category ); //指定したいタクソノミーを指定
            $args = array(
                'post_type' => 'slider',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'slider_category',
                        'field'    => 'slug',
                        'terms'    => $wiget_data_slaider_01_oput_put_category,
                    ),
                ),
                'posts_per_page' => $wiget_data_slaider_01_outputposts,
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
                        $custom = marcatgia(get_the_ID());
                        //print_r($custom);
                        $image_id = get_post_thumbnail_id();
                        $image_url = wp_get_attachment_image_src($image_id, true);
                        ?>
                        <?php if(!empty($image_url[0])): ?>
                            <?php if(empty($custom['url_setting'])): ?>
                                <li><img src="<?php echo $image_url[0]; ?>" class="thumb"></li>
                            <?php else: ?>
                                <li>
                                    <a href="<?php echo $custom['url_setting']; ?>" target="<?php if(!empty($custom['tab_cheack'])){ echo $custom['tab_cheack']; } ?>">
                                        <img src="<?php echo $image_url[0]; ?>" class="thumb">
                                    </a>
                                    
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            </article>
        <?php endif; ?>
    <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['wiget_data_slaider_01_mode'] = strip_tags($new_instance['wiget_data_slaider_01_mode']);
        $instance['wiget_data_slaider_01_auto'] = strip_tags($new_instance['wiget_data_slaider_01_auto']);
        $instance['wiget_data_slaider_01_speed'] = strip_tags($new_instance['wiget_data_slaider_01_speed']);
        $instance['wiget_data_slaider_01_pause'] = strip_tags($new_instance['wiget_data_slaider_01_pause']);
        $instance['wiget_data_slaider_01_infiniteLoop'] = strip_tags($new_instance['wiget_data_slaider_01_infiniteLoop']);
        $instance['wiget_data_slaider_01_captions'] = strip_tags($new_instance['wiget_data_slaider_01_captions']);
        $instance['wiget_data_slaider_01_responsive'] = strip_tags($new_instance['wiget_data_slaider_01_responsive']);
        $instance['wiget_data_slaider_01_touchEnabled'] = strip_tags($new_instance['wiget_data_slaider_01_touchEnabled']);
        $instance['wiget_data_slaider_01_pager'] = strip_tags($new_instance['wiget_data_slaider_01_pager']);
        $instance['wiget_data_slaider_01_controls'] = strip_tags($new_instance['wiget_data_slaider_01_controls']);
        $instance['wiget_data_slaider_01_nextText'] = strip_tags($new_instance['wiget_data_slaider_01_nextText']);
        $instance['wiget_data_slaider_01_prevText'] = strip_tags($new_instance['wiget_data_slaider_01_prevText']);
        $instance['wiget_data_slaider_01_prevSelector'] = strip_tags($new_instance['wiget_data_slaider_01_prevSelector']);
        $instance['wiget_data_slaider_01_useCSS'] = strip_tags($new_instance['wiget_data_slaider_01_useCSS']);
        $instance['wiget_data_slaider_01_easing'] = strip_tags($new_instance['wiget_data_slaider_01_easing']);
        $instance['wiget_data_slaider_01_autoDirection'] = strip_tags($new_instance['wiget_data_slaider_01_autoDirection']);
        $instance['wiget_data_slaider_01_autoHover'] = strip_tags($new_instance['wiget_data_slaider_01_autoHover']);
        $instance['wiget_data_slaider_01_minSlides'] = strip_tags($new_instance['wiget_data_slaider_01_minSlides']);
        $instance['wiget_data_slaider_01_maxSlides'] = strip_tags($new_instance['wiget_data_slaider_01_maxSlides']);
        $instance['wiget_data_slaider_01_moveSlides'] = strip_tags($new_instance['wiget_data_slaider_01_moveSlides']);
        $instance['wiget_data_slaider_01_slideWidth'] = strip_tags($new_instance['wiget_data_slaider_01_slideWidth']);
        $instance['wiget_data_slaider_01_oput_put_category'] = strip_tags($new_instance['wiget_data_slaider_01_oput_put_category']);
        $instance['wiget_data_slaider_01_outputposts'] = strip_tags($new_instance['wiget_data_slaider_01_outputposts']);
        $instance['wiget_data_slaider_01_slideMargin'] = strip_tags($new_instance['wiget_data_slaider_01_slideMargin']);
        return $instance;
    }
    public function form($instance) {
        if(!empty($instance['wiget_data_slaider_01_mode'])){ 
            $wiget_data_slaider_01_mode = esc_attr($instance['wiget_data_slaider_01_mode']);            
        }else {
            $wiget_data_slaider_01_mode = "";
        }
        if(!empty($instance['wiget_data_slaider_01_auto'])){ 
            $wiget_data_slaider_01_auto = esc_attr($instance['wiget_data_slaider_01_auto']);            
        }else {
            $wiget_data_slaider_01_auto = "";
        }
        if(!empty($instance['wiget_data_slaider_01_speed'])){ 
            $wiget_data_slaider_01_speed = esc_attr($instance['wiget_data_slaider_01_speed']);            
        }else {
            $wiget_data_slaider_01_speed = "";
        }
        if(!empty($instance['wiget_data_slaider_01_pause'])){ 
            $wiget_data_slaider_01_pause = esc_attr($instance['wiget_data_slaider_01_pause']);            
        }else {
            $wiget_data_slaider_01_pause = "";
        }
        if(!empty($instance['wiget_data_slaider_01_infiniteLoop'])){ 
            $wiget_data_slaider_01_infiniteLoop = esc_attr($instance['wiget_data_slaider_01_infiniteLoop']);            
        }else {
            $wiget_data_slaider_01_infiniteLoop = "";
        }
        if(!empty($instance['wiget_data_slaider_01_captions'])){ 
            $wiget_data_slaider_01_captions = esc_attr($instance['wiget_data_slaider_01_captions']);            
        }else {
            $wiget_data_slaider_01_captions = "";
        }
        if(!empty($instance['wiget_data_slaider_01_responsive'])){ 
            $wiget_data_slaider_01_responsive = esc_attr($instance['wiget_data_slaider_01_responsive']);            
        }else {
            $wiget_data_slaider_01_responsive = "";
        }
        if(!empty($instance['wiget_data_slaider_01_touchEnabled'])){ 
            $wiget_data_slaider_01_touchEnabled = esc_attr($instance['wiget_data_slaider_01_touchEnabled']);            
        }else {
            $wiget_data_slaider_01_touchEnabled = "";
        }
        if(!empty($instance['wiget_data_slaider_01_pager'])){ 
            $wiget_data_slaider_01_pager = esc_attr($instance['wiget_data_slaider_01_pager']);            
        }else {
            $wiget_data_slaider_01_pager = "";
        }
        if(!empty($instance['wiget_data_slaider_01_controls'])){ 
            $wiget_data_slaider_01_controls = esc_attr($instance['wiget_data_slaider_01_controls']);            
        }else {
            $wiget_data_slaider_01_controls = "";
        }
        if(!empty($instance['wiget_data_slaider_01_nextText'])){ 
            $wiget_data_slaider_01_nextText = esc_attr($instance['wiget_data_slaider_01_nextText']);            
        }else {
            $wiget_data_slaider_01_nextText = "";
        }
        if(!empty($instance['wiget_data_slaider_01_prevText'])){ 
            $wiget_data_slaider_01_prevText = esc_attr($instance['wiget_data_slaider_01_prevText']);            
        }else {
            $wiget_data_slaider_01_prevText = "";
        }
        if(!empty($instance['wiget_data_slaider_01_prevSelector'])){ 
            $wiget_data_slaider_01_prevSelector = esc_attr($instance['wiget_data_slaider_01_prevSelector']);            
        }else {
            $wiget_data_slaider_01_prevSelector = "";
        }
        if(!empty($instance['wiget_data_slaider_01_useCSS'])){ 
            $wiget_data_slaider_01_useCSS = esc_attr($instance['wiget_data_slaider_01_useCSS']);            
        }else {
            $wiget_data_slaider_01_useCSS = "";
        }
        if(!empty($instance['wiget_data_slaider_01_easing'])){ 
            $wiget_data_slaider_01_easing = esc_attr($instance['wiget_data_slaider_01_easing']);            
        }else {
            $wiget_data_slaider_01_easing = "";
        }
        if(!empty($instance['wiget_data_slaider_01_autoDirection'])){ 
            $wiget_data_slaider_01_autoDirection = esc_attr($instance['wiget_data_slaider_01_autoDirection']);            
        }else {
            $wiget_data_slaider_01_autoDirection = "";
        }
        if(!empty($instance['wiget_data_slaider_01_autoHover'])){ 
            $wiget_data_slaider_01_autoHover = esc_attr($instance['wiget_data_slaider_01_autoHover']);            
        }else {
            $wiget_data_slaider_01_autoHover = "";
        }
        if(!empty($instance['wiget_data_slaider_01_minSlides'])){ 
            $wiget_data_slaider_01_minSlides = esc_attr($instance['wiget_data_slaider_01_minSlides']);            
        }else {
            $wiget_data_slaider_01_minSlides = "";
        }
        if(!empty($instance['wiget_data_slaider_01_maxSlides'])){ 
            $wiget_data_slaider_01_maxSlides = esc_attr($instance['wiget_data_slaider_01_maxSlides']);            
        }else {
            $wiget_data_slaider_01_maxSlides = "";
        }
        if(!empty($instance['wiget_data_slaider_01_moveSlides'])){ 
            $wiget_data_slaider_01_moveSlides = esc_attr($instance['wiget_data_slaider_01_moveSlides']);            
        }else {
            $wiget_data_slaider_01_moveSlides = "";
        }
        if(!empty($instance['wiget_data_slaider_01_slideWidth'])){ 
            $wiget_data_slaider_01_slideWidth = esc_attr($instance['wiget_data_slaider_01_slideWidth']);            
        }else {
            $wiget_data_slaider_01_slideWidth = "";
        }
        if(!empty($instance['wiget_data_slaider_01_oput_put_category'])){ 
            $wiget_data_slaider_01_oput_put_category = esc_attr($instance['wiget_data_slaider_01_oput_put_category']);            
        }else {
            $wiget_data_slaider_01_oput_put_category = "";
        }
        if(!empty($instance['wiget_data_slaider_01_outputposts'])){ 
            $wiget_data_slaider_01_outputposts = esc_attr($instance['wiget_data_slaider_01_outputposts']);            
        }else {
            $wiget_data_slaider_01_outputposts = "";
        }
        if(!empty($instance['wiget_data_slaider_01_slideMargin'])){ 
            $wiget_data_slaider_01_slideMargin = esc_attr($instance['wiget_data_slaider_01_slideMargin']);            
        }else {
            $wiget_data_slaider_01_slideMargin = "";
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_oput_put_category'); ?>">
                <?php _e('出力カテゴリー分類'); ?>
            </label>
            <?php $terms = get_terms('slider_category'); ?>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_oput_put_category'); ?>" style="width: 100%">
                <option value="null" <?php if($wiget_data_slaider_01_oput_put_category === "null") { echo 'selected'; } ?>>-指定なし-</option>
                <?php foreach ( $terms as $term ): ?>
                    <option value="<?php echo $term->slug; ?>" <?php if($term->slug == $wiget_data_slaider_01_oput_put_category){ echo 'selected'; } ?>><?php echo $term->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_outputposts'); ?>">
                <?php _e('出力件数'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_outputposts'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_01_outputposts){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_mode'); ?>">
                <?php _e('スライド方法を設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_mode'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('horizontal'=>'横方向のスライド','vertical'=>'縦方向のスライド','fade'=>'フェードでの切り替え'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_mode){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_auto'); ?>">
                <?php _e('自動スライドの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_auto'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'自動スライドする','false'=>'自動スライドしない'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_auto){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>        
        
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_speed'); ?>">
                <?php _e('スライドの速さ'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_speed'); ?>" style="width: 100%">
                <?php for($count = 500; $count <= 2000;): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_01_speed){ echo 'selected'; } ?>><?php echo $count; ?></option>
                <?php  $count = $count + 50; endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_pause'); ?>">
                <?php _e('スライドしてから次のスライドまでの待ち時間の設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_pause'); ?>" style="width: 100%">
                <?php for($count = 1000; $count <= 20000;): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_01_pause){ echo 'selected'; } ?>><?php echo $count; ?></option>
                <?php  $count = $count + 100; endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_infiniteLoop'); ?>">
                <?php _e('スライドをループさせるかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_infiniteLoop'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'スライドをループさせる','false'=>'スライドをループしない'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_infiniteLoop){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_captions'); ?>">
                <?php _e('画像にキャプションを表示する事ができます。タグのtitleプロパティ内に記述したものが表示されます。'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_captions'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'スライドをループさせる','false'=>'スライドをループしない'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_captions){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_responsive'); ?>">
                <?php _e('レスポンシブに対応するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_responsive'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'レスポンシブに対応する','false'=>'レスポンシブに対応しない'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_responsive){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_touchEnabled'); ?>">
                <?php _e('タッチスワイプを許可するかを設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_touchEnabled'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'タッチスワイプを許可する','false'=>'タッチスワイプを許可しない'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_touchEnabled){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_pager'); ?>">
                <?php _e('ページ送りを追加するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_pager'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'ページャーを追加する','false'=>'ページャーを削除'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_pager){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_controls'); ?>">
                <?php _e('前後のコントロールを追加するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_controls'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'前後のコントロールを追加','false'=>'前後のコントロールを削除'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_controls){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_useCSS'); ?>">
                <?php _e('スライドにCSSアニメーションを使用するかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_useCSS'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true '=>'CSSアニメーションを使用する','false'=>'CSSアニメーションを使用しない'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_useCSS){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_autoDirection'); ?>">
                <?php _e('スライドの方向'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_autoDirection'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('next'=>'右へ移動で切り替え','prev'=>'左へ移動で切り替え'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_autoDirection){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_autoHover'); ?>">
                <?php _e('スライドをホバーした時に、スライドを一時的に止めるかどうかの設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_autoHover'); ?>" style="width: 100%">
                <?php $wiget_data_slaider_01_mode_array = array('true'=>'一時停止','false'=>'一時停止無し'); ?>
                <?php foreach($wiget_data_slaider_01_mode_array as $key => $val): ?>
                    <option value="<?php echo $key; ?>" <?php if($key == $wiget_data_slaider_01_autoHover){ echo 'selected'; } ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_minSlides'); ?>">
                <?php _e('（カルーセル設定）一度に表示させる最小数を設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_minSlides'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_01_minSlides){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_maxSlides'); ?>">
                <?php _e('（カルーセル設定）一度に表示させる最大数を設定'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_maxSlides'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_01_maxSlides){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_moveSlides'); ?>">
                <?php _e('（カルーセル設定）一度のスライド時に移動するスライド数'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('wiget_data_slaider_01_moveSlides'); ?>" style="width: 100%">
                <?php for($count = 1; $count < 15; $count++): ?>
                    <option value="<?php echo $count; ?>" <?php if($count == $wiget_data_slaider_01_moveSlides){ echo 'selected'; } ?>><?php echo $count; ?>件</option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_slideWidth'); ?>">
                <?php _e('各スライドの幅を指定'); ?>
            </label>
            <input type="text" name="<?php echo $this->get_field_name('wiget_data_slaider_01_slideWidth'); ?>" value="<?php if(!empty($wiget_data_slaider_01_slideWidth)){ echo $wiget_data_slaider_01_slideWidth;} ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wiget_data_slaider_01_slideMargin'); ?>">
                <?php _e('スライドの横の空間（px入力）'); ?>
            </label>
            <input type="text" name="<?php echo $this->get_field_name('wiget_data_slaider_01_slideMargin'); ?>" value="<?php if(!empty($wiget_data_slaider_01_slideMargin)){ echo $wiget_data_slaider_01_slideMargin;} ?>">
        </p>
    <?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("MarcatWidgetTriggerItemSlider01");'));


?>