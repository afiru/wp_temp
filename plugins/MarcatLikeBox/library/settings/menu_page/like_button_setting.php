<?php

add_action( 'admin_init', 'custom_like_setting' );
function custom_like_setting() {
    register_setting( 'custom_like_setting', 'custom_like_img_nomal' );
    register_setting( 'custom_like_setting', 'custom_like_img_close' );
    register_setting( 'custom_like_setting', 'custom_like_img_login' );
    register_setting( 'custom_like_setting', 'custom_like_text_redirect' );
}
function custom_like_count_box_setting_page() {
    ?>

    <div class="wrap_like_count">
        <form method="post" action="options.php">
            <?php settings_fields( 'custom_like_setting' ); ?>
            <?php do_settings_sections( 'custom_like_setting' ); ?>
            <div class="wappers">
                <section class="custom_field_GPS_input_api_setting">
                    <h3>MarcatLikeボタン画像の設定</h3>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">通常時のMarcatLike画像URL</th>
                            <td><input type="text" name="custom_like_img_nomal" value="<?php echo esc_attr( get_option('custom_like_img_nomal') ); ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">押し込み時のMarcatLike画像URL</th>
                            <td><input type="text" name="custom_like_img_close" value="<?php echo esc_attr( get_option('custom_like_img_close') ); ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">ログインボタンのURL</th>
                            <td><input type="text" name="custom_like_img_login" value="<?php echo esc_attr( get_option('custom_like_img_login') ); ?>" /></td>
                        </tr>
                         <tr valign="top">
                            <th scope="row">ログイン後リダイレクト先URL</th>
                            <td><input type="text" name="custom_like_text_redirect" value="<?php echo esc_attr( get_option('custom_like_text_redirect') ); ?>" /></td>
                        </tr>
                    </table>
                </section>
            </div>
        <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

?>