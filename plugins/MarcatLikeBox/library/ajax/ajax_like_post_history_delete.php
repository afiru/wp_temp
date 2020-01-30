<?php

header("Content-type: text/plain; charset=UTF-8");

$file_pass = dirname(__FILE__);
$file_pass=str_replace("wp-content\plugins\custom_like_count_new\library\ajax","",$file_pass);
$file_pass=str_replace("wp-content/plugins/custom_like_count_new/library/ajax","",$file_pass);

include $file_pass . 'wp-load.php';

//ドメイン名を取得
$domain = home_url();
$domain=str_replace("http://","",$domain);
$domain=str_replace("https://","",$domain);


if (isset($_POST['like_ids'])) {
    $like_id  = $_POST['like_ids'];
}



class ajax_like_post_history_delete {
    public $post_id;
    public function delete_like_count_user() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';
        $like_row = $wpdb->delete( $table_name, array( 'post_id' => esc_sql($this->post_id) ), array( '%d' ) );
    }
    public function return_ajax_json() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';    
        $likecount = $wpdb->get_results("SELECT * FROM `$table_name` ORDER BY like_count DESC");
        $i=1;
        foreach ($likecount as $like) {
            $output[$i]['ranking'] = $i;
            $output[$i]['post_id'] = $like->post_id;
            $output[$i]['post_title'] = get_the_title($like->post_id);
            $output[$i]['like_count'] = $like->like_count;        
            $output[$i]['like_count_category'] = $like->like_count_category;
            $output[$i]['last_count_date'] = $like->last_count_date;
            $i++;
        }       
        echo json_encode($output, JSON_FORCE_OBJECT);
    }
}
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    if(!empty($like_id)) { 
        foreach ($like_id as $key => $val) {
            $delete[$key] = new ajax_like_post_history_delete();
            $delete[$key]->post_id = $val;
            $delete[$key]->delete_like_count_user();
        }
        $output = new ajax_like_post_history_delete();
        $output->return_ajax_json(); 
    }
}

    
