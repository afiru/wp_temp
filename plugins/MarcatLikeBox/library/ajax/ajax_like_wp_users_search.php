<?php
header("Content-type: text/plain; charset=UTF-8");
 


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    $file_pass = dirname(__FILE__);
    $file_pass=str_replace("wp-content\plugins\custom_like_count_new\library\ajax","",$file_pass);
    $file_pass=str_replace("wp-content/plugins/custom_like_count_new/library/ajax","",$file_pass);
    include $file_pass . 'wp-load.php';
    //ドメイン名を取得
    $domain = home_url();
    $domain=str_replace("http://","",$domain);
    $domain=str_replace("https://","",$domain);

    if (isset($_POST['send_user_search'])) {
        $user_date          = $_POST['send_user_search']['date_text'];
        $freewords_text     = $_POST['send_user_search']['freewords_text'];
    }
    //■テスト実施用
    $surch_obj = new ajax_like_wp_users_search();
    $surch_obj->user_date = $user_date;
    $surch_obj->freewords_text = $freewords_text;
    $surch_obj->like_wp_users_search();   
}

    
class ajax_like_wp_users_search {
    public $user_date;
    public $freewords_text;
    
    public function like_wp_users_search() {
        global $wpdb;
        //全検索
        if($this->user_date === "" and $this->freewords_text === "") {
            $likeusers = $wpdb->get_results("SELECT * FROM `$wpdb->users` ORDER BY user_registered DESC");
        }
        //結合検索（重複削除）　メタ情報で検索
        elseif($this->user_date === "") {
            $likeusers = $wpdb->get_results("SELECT DISTINCT ID ID,user_login,user_email,user_registered FROM $wpdb->users INNER JOIN $wpdb->usermeta on $wpdb->users.ID = $wpdb->usermeta.user_id WHERE meta_value LIKE '%$this->freewords_text%'");
        }
        //結合検索（重複削除）　日付で検索
        elseif($this->freewords_text === "") {
            $likeusers = $wpdb->get_results("SELECT DISTINCT ID ID,user_login,user_email,user_registered FROM $wpdb->users INNER JOIN $wpdb->usermeta on $wpdb->users.ID = $wpdb->usermeta.user_id WHERE user_registered <= '$this->user_date'");
        }
        //双方で検索
        else {
            $likeusers = $wpdb->get_results("SELECT DISTINCT ID ID,user_login,user_email,user_registered FROM $wpdb->users INNER JOIN $wpdb->usermeta on $wpdb->users.ID = $wpdb->usermeta.user_id WHERE meta_value LIKE '%".$this->freewords_text."%' AND user_registered <= '".$this->user_date."'");
        }
        $i=1;
        $output = array();
        foreach ($likeusers as $like) {
            //調査
            $user_info = get_userdata( $like->ID );
            if($user_info->roles[0] ==="subscriber") {
                $output[$i]['ID'] = $like->ID;
                $output[$i]['user_id'] = $like->user_login;
                $output[$i]['user_email'] = $like->user_email;
                $output[$i]['user_registered'] = $like->user_registered;
                $i++;
            }        
        }
        echo json_encode($output, JSON_FORCE_OBJECT);
    }
}
?>