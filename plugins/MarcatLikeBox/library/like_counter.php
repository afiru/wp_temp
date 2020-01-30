<?php

function like_counter($post_id=0,$category=0) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_post_count';    
    $likecount = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `post_id` = $post_id AND `like_count_category` = '$category'");
    if($likecount) {
        if(!empty($likecount[0]->like_count)) {
            return $likecount[0]->like_count;
        }else {
            return 0;
        }    
    }else {
        return 0;
    }
}

?>