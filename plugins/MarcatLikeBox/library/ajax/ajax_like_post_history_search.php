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




class ajax_like_post_history_search {
    public $like_date;
    //■like_post_count update
    public function like_post_count_search() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `last_count_date` <= '$this->like_date' ORDER BY like_count DESC");
        $i=1;
        foreach ($like_row as $like) {
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
    if (isset($_POST['like_date'])) {
        $user_date  = $_POST['like_date']['user_date'];
    }
    $post_history = new ajax_like_post_history_search();
    $post_history->like_date = $user_date;
    $post_history->like_post_count_search();
}
