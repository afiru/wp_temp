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
    $dateobj = $_POST['like_date']['user_date'];
    $user_nameobj = $_POST['like_date']['user_name'];
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    //チェック用
    search_like_count_user($user_nameobj,$dateobj);
}
//■検索用
function search_like_count_user($user_nameobj=0,$dateobj=0) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_count_user';
    $like_row = "";
    if($user_nameobj==="" and $dateobj==="") {
        //全出力用
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name`");
    }
    elseif(!$user_nameobj==="" or $dateobj===""){
        //ユーザー名がからではなく、日付がからの時→ユーザー名で検索
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `like_count_user_login_neme` = '$user_nameobj'");
    }
    elseif($user_nameobj==="" or !$dateobj===""){
        //ユーザー名で、日付がからではないとき→日付で検索
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `last_count_date` <= '$dateobj'");        
    }
    else {
        $like_row = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `like_count_user_login_neme` = '$user_nameobj' AND `last_count_date` <= '$dateobj'");
    }
    
    //投稿に整理する→タイトルを設定したものを作る。
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

//echo json_encode($like_id, JSON_FORCE_OBJECT); 
?>