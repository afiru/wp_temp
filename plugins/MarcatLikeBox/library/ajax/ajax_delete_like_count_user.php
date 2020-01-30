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

if (isset($_POST['like_count_obj'])) {
    $postid  = $_POST['like_count_obj']['postid'];
    $category = $_POST['like_count_obj']['category'];
    $user_id   = $_POST['like_count_obj']['user_id'];
    $databox = array($postid,$category,$user_id);
}

if (isset($_POST['like_ids'])) {
    $like_id  = $_POST['like_ids'];
}



class delete_like_count_user {
    //wp_like_count_user like_count_id
    public $like_id;
    
    //wp_like_count_user like_count_id
    public $post_id;
    
    //■likeidを元に投稿したpost_idを取得
    public function get_the_like_post_id() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_count_user';
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `like_id` = '$this->like_id'");
        $i =0;
        if(!empty($like_row[0]->post_id)){
            $this->post_id = $like_row[0]->post_id;
            return $this->post_id;
        }else {
            $this->post_id = "";
            return $this->post_id;
        }    
    }
    public function like_post_count_down() {
        //現状のlike_contを知る
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `post_id` = '$this->post_id'");
        if(!empty($like_row[0]->like_count)){
            $count = $like_row[0]->like_count;
        }else {
            $count=1;
        }
        //-1の処理
        $count = $count-1;
        $update = $wpdb->update($table_name,array('like_count'=>$count,'last_count_date'=>date_i18n("Y-m-d H:i:s")),array('post_id' =>$this->post_id),array('%d','%s'),array('%d'));
        
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `post_id` = '$this->post_id'");
        if(!empty($like_row[0]->like_count)){
            $count = $like_row[0]->like_count;
        }else {
            $count=1;
        }
        return $count;
    }
    
    //■like_count_userからの削除
    public function delete_like_count_user() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_count_user';
        $like_row = $wpdb->delete( $table_name, array( 'like_id' => esc_sql($this->like_id) ), array( '%d' ) );
    }
    
    public function return_ajax_json() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_count_user';
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name`");
        $i =0;
        foreach ($like_row as $like) {
            $output[$i]['like_id'] = $like->post_id;
            $output[$i]['like_count_category'] = $like->like_count_category;
            $output[$i]['like_count_user_login_neme'] = $like->like_count_user_login_neme;
            $output[$i]['post_name'] = get_the_title($like->post_id);
            $output[$i]['last_count_date'] = $like->last_count_date;
            $i++;
        }
        //jsonで出力
        echo json_encode($output, JSON_FORCE_OBJECT);
    }
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    if(!empty($like_id)) {    
        if(is_array($like_id)) {
            foreach($like_id as $key => $val) {
                $like_id[$key] = new delete_like_count_user();
                $like_id[$key]->like_id = $val;
                $like_id[$key]->get_the_like_post_id();
                $like_id[$key]->like_post_count_down();
                $like_id[$key]->delete_like_count_user();
            }
        }

        $last_contents = new delete_like_count_user();
        $last_contents->return_ajax_json();
    }
}
    


//            $like_id[$key] = new delete_like_count_user();
//            $like_id[$key]->like_id = $val;
//            $like_id[$key]->get_the_like_post_id();
//            $like_id[$key]->like_post_count_down();
//            $like_id[$key]->delete_like_count_user();
//            if($val !== end($like_id)){
//                $like_id[$key]->delete_like_count_user();
//            }






//echo json_encode($like_id, JSON_FORCE_OBJECT); 


