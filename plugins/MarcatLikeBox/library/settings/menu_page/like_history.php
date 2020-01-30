<?php
function like_history_style(){
    wp_enqueue_style( 'my_admin_style', plugins_url().'/MarcatLikeBox/css/like_post_history.css');
    wp_enqueue_style( 'date_picker', '//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css');
}
add_action( 'admin_enqueue_scripts', 'like_history_style' );

function like_history_script(){
    wp_enqueue_script( 'my_admin_script', '//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', array('jquery') );
    wp_enqueue_script( 'my_admin_scripts', '//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js', array('jquery') );
    wp_enqueue_script( 'like_count_user_output_script', plugins_url().'/MarcatLikeBox/js/like_count_user_output.js', array('jquery') );
}
add_action( 'admin_enqueue_scripts', 'like_history_script' );

function my_admin_script() {
  echo '<script>
        jQuery(function($) {
            //全チェック

            //検索
            $(document).on("click", "#kensaku_button", function () {
                $("#output_like_user").empty();
                var select_users = new Array();
                select_users["user_name"] = $("#username").val();
                select_users["user_date"] = $("#user_date").val();
                var select_users_obj = {};
                for(key in select_users){
                  select_users_obj[key] = select_users[key];
                }
                $.ajax({
                    type: "POST",
                    url: "'. plugins_url() .'/custom_like_count_new/library/ajax/ajax_select_like_count_user.php",
                    data: {'.'like_date'.': select_users_obj},
                    dataType: '.'"json"'.',                    
                    success: function(res){                        
                        out_put_like_count_user_table(res); 
                    }
                });
            });
            //削除
            $(document).on("click", "#sakujo_button", function () {
                
                var checkedSeasons = [];
                $("[name='.'like_id'.']:checked").each(function(){
                    checkedSeasons.push($(this).val());                    
                });
                $.ajax({
                    type: "POST",
                    url: "'. plugins_url() .'/custom_like_count_new/library/ajax/ajax_delete_like_count_user.php",
                    data: {'.'like_ids'.': checkedSeasons},
                    dataType: '.'"json"'.',                    
                    success: function(res){
                        console.log(res);
                        $("#output_like_user").empty();
                        out_put_like_count_user_table(res);
                        location.reload();
                    }
                });
            });
        });
  </script>'.PHP_EOL;
}
add_action('admin_print_footer_scripts', 'my_admin_script');

function like_history() {
    ?>
    <div class="wrap_like_count">
        <h2>MarcatLike履歴管理</h2>
        <section class="setumei">
            <p>MarcatLikeを押し間違えた人を解除するためのフォームです。</p>
        </section>
        <div class="kenksaku">
            <div class="input_wapper">
                <input type="text" name="username" id="username" placeholder="ユーザー名を入力">
                <input type="text" name="username" id="user_date" placeholder="日付を入力">
            </div>
            <div class="button_like">
                <button id="kensaku_button">検索する</button>
            </div>
        </div>
        <form id="like_history_date">
            <div class="table_wapper">
                <table>
                    <tr>
                        <th class="chack_box" id="allcheack"><span id="cheack_all" style="cursor: pointer">チェック</span></th>
                        <th class="user_name">ユーザー名</th>
                        <th class="user_push_title">MarcatLikeを押した名前</th>
                        <th class="date">MarcatLikeを押した日</th>
                    </tr>
                </table>
                <table id="output_like_user">
                    <?php $like_users = like_counter_read(); ?>
                        <?php foreach($like_users as $like_user): ?>
                        <tr>
                            <td class="chack_box"><input class="like_id" type="checkbox" name="like_id" value="<?php echo $like_user->like_id; ?>"></td>
                            <td class="user_name"><?php echo $like_user->like_count_user_login_neme; ?></td>
                            <td class="user_push_title"><?php echo get_the_title($like_user->post_id); ?></td>
                            <td class="date"><?php echo $like_user->last_count_date; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                
            </div>
        </form>

        <div class="kenksaku">
            <div class="button_like">
                <button id="sakujo_button">削除する</button>
            </div>
        </div>
    </div>    
    <?php
}

function like_counter_read() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_count_user';    
    $likecount = $wpdb->get_results("SELECT * FROM `$table_name`");
    return $likecount;
}