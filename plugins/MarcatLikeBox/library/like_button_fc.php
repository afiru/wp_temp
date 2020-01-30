<?php
function like_button_fc() {
    $category = get_the_category(get_the_ID());
    if (is_user_logged_in()) {
            $user = wp_get_current_user();
            $filepass = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 
        ?>
        <?php //Cookieの調査 ?>
        <?php if(in_array(get_the_ID(),$_COOKIE) or in_array($user->data->user_login, $_COOKIE)): ?>
            <div class="cont_like_button like_botton">
                <div class="like_button bacepush">                
                    <span id="like_button_off" class="off">
                        <span class="on"><img src="<?php echo esc_attr( get_option('custom_like_img_close') ); ?>"></span>
                    </span>
                </div>
                <div class="like_count count_data" id="like_count">
                    <?php echo like_counter(get_the_ID(),$category[0]->slug); ?>
                </div>
            </div>
        <?php else: ?>
                <div class="cont_like_button like_botton">
                    <div class="like_button bacepush" id="like_button_<?php echo get_the_ID(); ?>">                
                        <span id="like_button" class="off" data-postid="<?php echo get_the_ID(); ?>" data-categoryname="<?php echo $category[0]->slug; ?>">
                            <span class="off"><img src="<?php echo esc_attr( get_option('custom_like_img_nomal') ); ?>"></span>
                            <span class="on"><img src="<?php echo esc_attr( get_option('custom_like_img_close') ); ?>"></span>
                        </span>
                    </div>
                    <div class="like_count count_data" id="like_count_<?php echo get_the_ID(); ?>">
                        <?php echo like_counter(get_the_ID(),$category[0]->slug); ?>
                    </div>
                </div>
                <style>
                    #like_button { cursor : pointer;}#like_button.off .off { display: block;}#like_button.off .on { display: none;}#like_button.on .off { display: none;}#like_button.on .on { display: block;}
                </style>
                <script>
                    jQuery.noConflict();
                    jQuery(function($) {
                        $(document).on('click', '#like_button_<?php echo get_the_ID(); ?> #like_button', function () {
                            if($(this).hasClass('off')) {
                                 //クラスの変更全てのクラスを一気に変更
                                $('[id=like_button]').removeClass('off').addClass('on');
                                //Cookie保存
                                $.cookie('post_id', $(this).data('postid'), { expires: 7, path: '/' });
                                $.cookie('user_id', '<?php echo $user->data->user_login; ?>', { expires: 7, path: '/' });
                                $.cookie('category<?php echo $category[0]->slug; ?>', $(this).data('categoryname'), { expires: 7, path: '/' });
                                
                                
                                //ajax準備
                                var like_count_data = new Array();
                                    like_count_data["postid"] = $(this).data('postid');
                                    like_count_data["category"] = $(this).data('categoryname');
                                    like_count_data["user_id"] = '<?php echo $user->data->user_login; ?>';
                                //配列をオブジェクト変換
                                var like_count_obj = {};
                                for(key in like_count_data){
                                  like_count_obj[key] = like_count_data[key];
                                }
                                //ajax通信開始
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo $filepass; ?>ajax/like_ajax.php",
                                    data: {'like_count_obj': like_count_obj},
                                    dataType: 'json',                    
                                    success: function(res){
                                        console.log(res);
                                        $("#like_count_<?php echo get_the_ID(); ?>").html(res);
                                    }
                                });
                            }
                        });
                    });
                    //jsでCookieダブルチェック
                    jQuery(function($) {
                        if($.cookie("user_id") === undefined || $.cookie("category") === undefined) {
                        }else {
                            if($.cookie("user_id")==='<?php echo $user->data->user_login; ?>') {
                                $('[id=like_button]').removeClass('off').addClass('on');
                            }                        
                        }
                    });
                </script>
            <?php endif; ?>
        <?php
    }else {
        ?>
        <div class="cont_like_button like_botton">
            <div class="like_button bacepush">                
                <a href="<?php echo home_url('/watch_MarcatLike_login/') ?>"><img src="<?php echo esc_attr( get_option('custom_like_img_login') ); ?>"></a>
            </div>
            <div class="like_count count_data" id="like_count">
                <?php echo like_counter(get_the_ID(),$category[0]->slug); ?>
            </div>
        </div>
        <?php
    }
}



?>