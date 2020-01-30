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

if (isset($_POST['like_date'])) {
    $post_id  = $_POST['like_date']['post_id'];
    $like_count  = $_POST['like_date']['like_count'];
}


class ajax_like_post_history_cheange {
    public $like_id;
    public $post_id;
    //■like_post_count update
    public function like_post_count_update() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';
        $update = $wpdb->update($table_name,array('like_count'=>$this->like_id,'last_count_date'=>date_i18n("Y-m-d H:i:s")),array('post_id' =>$this->post_id),array('%d','%s'),array('%d'));
    }
    //■like_post_count select
    public function like_post_count_select() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` ORDER BY like_count DESC");
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
    $post_history = new ajax_like_post_history_cheange();
    $post_history->like_id = $like_count;
    $post_history->post_id = $post_id;
    $post_history->like_post_count_update();
    $post_history->like_post_count_select();
}


?>