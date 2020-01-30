<?php
function like_wp_users_style(){
    wp_enqueue_style( 'my_admin_style', plugins_url().'/custom_like_count_new/css/like_wp_users.css');
    wp_enqueue_style( 'date_picker', '//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css');
}
add_action( 'admin_enqueue_scripts', 'like_wp_users_style' );

function like_wp_users_script(){
    echo "<script>var like_wp_users_search = '". plugins_url() ."/custom_like_count_new/library/ajax/ajax_like_wp_users_search.php'; </script>";
    echo "<script>var like_wp_users_csv = '". plugins_url() ."/custom_like_count_new/library/ajax/ajax_like_wp_users_csv.php'; </script>";
    echo "<script>var like_wp_users_delete = '". plugins_url() ."/custom_like_count_new/library/ajax/ajax_like_wp_users_delete.php'; </script>";
    wp_enqueue_script( 'my_admin_script', '//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', array('jquery') );
    wp_enqueue_script( 'my_admin_scripts', '//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js', array('jquery') );
    wp_enqueue_script( 'like_wp_users_script', plugins_url().'/custom_like_count_new/js/like_wp_users.js', array('jquery') );
    wp_enqueue_script( 'like_wp_users_csv_script', plugins_url().'/custom_like_count_new/js/jquery.csv.min.js', array('jquery') );
}
add_action( 'admin_enqueue_scripts', 'like_wp_users_script' );


function like_wp_users() {
    ?>
    <div class="wrap_like_count">
        <h2>MarcatLikeユーザー管理</h2>
        <section class="setumei">
            <p>MarcatLikeのユーザーを管理するためのフィールドです。</p>
        </section>
        <div class="kenksaku">
            <div class="input_wapper">
                <form action="<?php echo home_url('/wp-admin/admin.php'); ?>?page=like_wp_users&">
                <input type="hidden" name="page" value="like_wp_users_csv">
                <input type="text" name="username" id="user_date_2" placeholder="指定した日付以前の登録者を検索します。">
                <input type="text" name="freewords" id="freewords" placeholder="名前や住所などから検索を行います。">
            </div>
            <div class="button_like">
                <button id="user_csv" href="#" download="test.csv">CSV書き出し</button>
                </form>
                <button id="user_date_search">検索する</button>                
            </div>
        </div>
        <div class="table_wapper">
            <table>
                <tr>
                    <th class="chack_box" id=""><span id="cheack_all" style="cursor: pointer">チェック</span></th>
                    <th class="chack_box" id="order_cheange">ユーザーid</th>
                    <th class="user_push_title">メールアドレス</th> 
                    <th class="chack_box">登録日</th>
                </tr>
            </table>
            <table id="output_like_user">
                <?php $user_data = get_all_user(); ?>
                <?php foreach ($user_data as $key => $val): ?>
                <tr>
                    <td class="chack_box" id="">
                        <input id="all_cheack" class="post_id" type="checkbox" name="user_id" value="<?php echo $user_data[$key]['ID']; ?>">                        
                    </td>
                    <td class="chack_box" id="order_cheange"><?php echo $user_data[$key]['user_id']; ?></td>
                    <td class="user_push_title"><?php echo $user_data[$key]['user_email']; ?></td> 
                    <td class="chack_box"><?php echo $user_data[$key]['user_registered']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php
}


//■全ユーザー出力
function get_all_user() {
    global $wpdb;
    $table_name = $wpdb->users;
    $likecount = $wpdb->get_results("SELECT * FROM `$table_name` ORDER BY user_registered DESC");
    $i=1;
    $output = array();
    foreach ($likecount as $like) {
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
    return $output;
}
