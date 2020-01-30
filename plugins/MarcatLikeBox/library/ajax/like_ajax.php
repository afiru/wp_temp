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


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    if(!empty($postid and cheack_like_count_user($category,$user_id))){
        //ライクカウント追加・更新処理
        like_post_conter_rest($postid,$category);
        //ライクユーザー管理（追加処理）
        insert_like_count_user($category,$user_id,$postid);    
        //ライクカウント取得処理
        $like_counts = like_post_conter($postid,$category);
        echo json_encode($like_counts, JSON_FORCE_OBJECT); 
        exit;
    }else {
        //ライクカウント取得処理
        $like_counts = like_post_conter($postid,$category);
        echo json_encode($like_counts, JSON_FORCE_OBJECT); 
        exit;
    }
}


//既にMarcatLikeをしているのかをチェック(like_count_userでの検証)
function cheack_like_count_user($category,$user_login_neme) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_count_user';    
    $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `like_count_user_login_neme` = '$user_login_neme'");
    $array_cheack = array_filter($like_row);
    if(empty($array_cheack)){
        return true;
    }else {
        return false;
    }
}

//wp_like_post_countの作業
    //現在のライクカウントデータを抽出
    function like_post_conter_rest($post_id=0,$category=0) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';    
        $likecount = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `post_id` = $post_id");
        $num = $wpdb->num_rows;
        //既に記事IDのライクカウントがあるかどうかをチェック
        if(empty($num) or $num===0){
            //カラムを1つ足すfunxtion(like_post_conter_insert)へ移動
            like_post_conter_insert($post_id,$category);
        }else {
            like_count_up_date($post_id,$category);
        }
    }
    //カラムを1つ追加する作業
    function like_post_conter_insert($post_id=0,$category=0) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';
        $insert =  $wpdb->insert( $table_name , array('post_id' =>$post_id ,'like_count'=>1,'like_count_category'=>$category,'last_count_date'=>date_i18n("Y-m-d H:i:s")) ,array('%d','%d','%s','%s'));
    }
    
    //現状のライクカウントに+1を行う
    function like_count_up_date($post_id=0,$category=0) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';    
        $likecount = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `post_id` = $post_id AND `like_count_category` = '$category'" );
        $nowlike_count = $likecount[0]->like_count;
        $nowlike_count = $nowlike_count +1;
        $update = $wpdb->update($table_name,array('like_count'=>$nowlike_count,'last_count_date'=>date_i18n("Y-m-d H:i:s")),array('post_id' =>$post_id,'like_count_category'=>$category),array('%d','%s'),array('%d','%s'));
        //$list = "UPDATE `wp_like_post_count` SET `last_count_date` = CURRENT_TIMESTAMP WHERE `wp_like_post_count`.`post_id` = 13;"
    }
    //単にカウントを取得
    function like_post_conter($post_id=0,$category=0) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'like_post_count';    
        $likecount = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `post_id` = $post_id AND `like_count_category` = '$category'");
        if(!empty($likecount[0]->like_count)) {
            return $likecount[0]->like_count;
        }else {
            return 0;
        }    
    }
    
    
//like_count_userの作業
function insert_like_count_user($category,$user_login_neme,$post_id=0) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_count_user';
    $insert = $wpdb->insert( $table_name , 
            array(
                    'like_count_category'=>$category,
                    'like_count_user_login_neme'=>$user_login_neme,
                    'post_id'=>$post_id,
                    'last_count_date' =>date_i18n("Y-m-d H:i:s")
                ),array('%s','%s','%d','%s'));
}

?>