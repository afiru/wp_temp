<?php
function like_post_history_style(){
    wp_enqueue_style( 'my_admin_style', plugins_url().'/custom_like_count_new/css/like_post_history.css');
    wp_enqueue_style( 'date_picker', '//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css');
}
add_action( 'admin_enqueue_scripts', 'like_post_history_style' );

function like_post_history_script(){
    echo "<script>var like_post_history_search = '". plugins_url() ."/custom_like_count_new/library/ajax/ajax_like_post_history_search.php'; </script>";
    echo "<script>var like_post_history_cheange = '". plugins_url() ."/custom_like_count_new/library/ajax/ajax_like_post_history_cheange.php'; </script>";
    echo "<script>var like_post_history_delete = '". plugins_url() ."/custom_like_count_new/library/ajax/ajax_like_post_history_delete.php'; </script>";
    wp_enqueue_script( 'my_admin_script', '//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', array('jquery') );
    wp_enqueue_script( 'my_admin_scripts', '//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js', array('jquery') );
    wp_enqueue_script( 'like_post_history_script', plugins_url().'/custom_like_count_new/js/like_post_history.min.js', array('jquery') );
}
add_action( 'admin_enqueue_scripts', 'like_post_history_script' );


function like_post_history() {
    ?>
    <div class="wrap_like_count">
        <h2>MarcatLikeランキング管理</h2>
        <section class="setumei">
            <p>MarcatLikeのランキングを調査したり、現状の値の編集を行うためのページです。</p>
        </section>
        <div class="kenksaku">
            <div class="input_wapper">
                <input type="text" name="username" id="user_date_2" placeholder="日付を入力その日以前の投稿を検索します。">
            </div>
            <div class="button_like">
                <button id="user_date_posts">検索する</button>
            </div>
        </div>
            <div class="table_wapper">
                <table>
                    <tr>
                        <th class="chack_box" id="cheack"><span id="cheack_all" style="cursor: pointer">チェック</span></th>
                        <th class="chack_box" id="order_cheange">順位</th>
                        <th class="user_push_title">名前</th> 
                        <th class="chack_box">MarcatLikeカウント</th>                                               
                        <th class="date">最終MarcatLike日</th>
                    </tr>
                </table>
                <table id="output_like_user">
                    <?php $like_users = like_post_history_read(); ?>
                    <?php foreach($like_users as $key=> $val): ?>
                    <tr>
                        <td class="chack_box"><input class="post_id" type="checkbox" name="post_id" value="<?php echo $like_users[$key]['post_id']; ?>"></td>
                        <td class="chack_box"><?php echo $like_users[$key]['ranking']; ?>位</td>
                        <td class="user_push_title"><?php echo $like_users[$key]['post_title']; ?></td>
                        <td class="chack_box" id="text_cheange" data-id="<?php echo $like_users[$key]['post_id']; ?>"><?php echo $like_users[$key]['like_count']; ?></td>                        
                        <td class="date"><?php echo $like_users[$key]['last_count_date']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>                
            </div>
    <div class="kenksaku">
        <div class="button_like">
            <button id="sakujo_button_posts">削除する</button>
            
        </div>
    </div>
    </div>

    <?php
}


function like_post_history_read() {
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
    return $output;
}
?>