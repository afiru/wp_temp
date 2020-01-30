<?php

//jetpackで読まれているCSSを削除
add_filter('jetpack_implode_frontend_css','__return_false' );

/* インラインスタイル削除 */
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );
add_theme_support( 'post-thumbnails' ); //サムネイルをサポートさせる。


//勝手に読み込まれるJSを削除
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');

function dequeue_css_header() {
  wp_dequeue_style('wp-pagenavi');
  wp_dequeue_style('bodhi-svgs-attachment');
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('dashicons');
  wp_dequeue_style('addtoany');
  
}
add_action('wp_enqueue_scripts', 'dequeue_css_header');
//CSSファイルをフッターに出力
function enqueue_css_footer(){

  wp_enqueue_style('wp-block-library');

  wp_enqueue_style('addtoany');
}
add_action('wp_footer', 'enqueue_css_footer');

if(is_admin()) {    
}
else {

    function my_delete_local_jquery() {
        wp_deregister_script('jquery');
    }
    add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );
}

//レンダリングをブロックするのを止めましょう。
if (!(is_admin() )) {
function add_defer_to_enqueue_script( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.min.js' ) ) return $url;
    return "$url' defer charset='UTF-8";
}
add_filter( 'clean_url', 'add_defer_to_enqueue_script', 11, 1 );
}

remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');

//子カテゴリーも親カテゴリーと同様の設定を行う
add_filter( 'category_template', 'my_category_template' );
function my_category_template( $template ) {
    $category = get_queried_object();
    if ( $category->parent != 0 &&
        ( $template == "" || strpos( $template, "category.php" ) !== false ) ) {
        $templates = array();
        while ( $category->parent ) {
                $category = get_category( $category->parent );
                if ( !isset( $category->slug ) ) break;
                $templates[] = "category-{$category->slug}.php";
                $templates[] = "category-{$category->term_id}.php";
        }
        $templates[] = "category.php";
        $template = locate_template( $templates );
    }
    return $template;
}


//子カテゴリーで抽出を行う方法
function post_is_in_descendant_category( $cats, $_post = null ){
   foreach ( (array) $cats as $cat ) {
        $descendants = get_term_children( (int) $cat, 'category');
        if ( $descendants && in_category( $descendants, $_post ) )
        return true;
   }
   return false;
}

function get_amp_cheack() {
    $get_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $myAmp = false;
    $string = $post->post_content;
    // ampのパラメーターが1かつ記事の中に<script>タグが入っていない
    // かつsingleページのみ$myAmpをtrueにする
    
    if(($_GET['amp'] === '1' or strpos($get_url,'/amp/') !== false) && strpos($string,'<script>') === false){
        $myAmp = true;
    }
    return $myAmp;
}

function honbuntagnasi_amp($postid, $length){
	$postsbu = backupposts();
	// 指定投稿情報の取得
	$post = get_post($postid);
	setup_postdata($post);
	// 投稿記事文章の抽出
	$output = get_the_content();
	$output = strip_tags($output);
	$output = stripslashes($output);
	$output = preg_replace('/(\s\s|　)/','',$output);
	$output = preg_replace( "/^\xC2\xA0/", "", $output );  
	$output = str_replace("&nbsp;", '', $output);	
	$output = mb_strimwidth($output, 0, $length, "...", "UTF-8");	
	backupposts($postsbu);	// 投稿情報(リスト含)の原状復帰
	return $output;
}
function backupposts($buposts = array()) {
    global $posts, $post;
    if(empty($buposts)) {
            $bu['posts'] = $posts;
            $bu['post'] = $post;
            return $bu;
    } else {
            $posts = $buposts['posts'];
            $post = $buposts['post'];
            setup_postdata($post);
    }
}


//アクセス数の取得
function get_post_views( $postID ) {
    $count_key = 'post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );

        return "0 views";
    }

    return $count . '';
}

//アクセス数の保存
function set_post_views( $postID ) {
    $count_key = 'post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } else {
        $count ++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function amp_breadcrumblist(){
    $home_url = home_url('/');
    $category_data = get_the_category();
    if(is_category()){
        $cat_url = get_category_link( $cat ).'?amp=1';
        $cat_name = $category_data[0]->cat_name;
    }elseif(is_single()){
        $category_info = get_the_category();
        $cat_url = get_category_link( $category_info[0]->cat_ID ).'?amp=1';
        $cat_name = $category_info[0]->cat_name;
    }

    
    $posttitle = get_the_title(get_the_ID());
    $posturl = get_the_permalink(get_the_ID()).'?amp=1';
    if(is_home()){        
$contents =  <<<EOD
    {
        "@type": "ListItem",
        "position": 1,
        "item": {
                    "@id": "{$home_url}",
                    "name": "TOP"
                }
    }
EOD;
    }elseif(is_category()){
$contents =  <<<EOD
    {
        "@type": "ListItem",
        "position": 1,
        "item": {
                    "@id": "{$home_url}",
                    "name": "TOP"
                }
    },{
        "@type": "ListItem",
        "position": 2,
        "item": {
                    "@id": "{$cat_url}",
                    "name": "{$cat_name}"
                }
    }
EOD;
    }elseif(is_single()){
$contents =  <<<EOD
    {
        "@type": "ListItem",
        "position": 1,
        "item": {
                    "@id": "{$home_url}",
                    "name": "TOP"
                }
    },{
        "@type": "ListItem",
        "position": 2,
        "item": {
                    "@id": "{$cat_url}",
                    "name": "{$cat_name}"
                }
    },{
        "@type": "ListItem",
        "position": 3,
        "item": {
                    "@id": "{$posturl}",
                    "name": "{$posttitle}"
                }
    }
EOD;
                    
    }elseif(is_page()) {
$contents =  <<<EOD
    {
        "@type": "ListItem",
        "position": 1,
        "item": {
                    "@id": "{$home_url}",
                    "name": "TOP"
                }
    },{
        "@type": "ListItem",
        "position": 2,
        "item": {
                    "@id": "{$posturl}",
                    "name": "{$posttitle}"
                }
    }
EOD;
    }
    
    return $contents;
}


add_filter( 'wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2 );
function my_wp_kses_allowed_html( $tags, $context ) {
	$tags['img']['srcset'] = true;
        $tags['source']['srcset'] = true;
        $tags['source']['data-srcset'] = true;
	return $tags;
}


