//■全チェック機能
jQuery(function($){
  $('#cheack_all').click(function(){
    if($("input:checkbox[name='like_id']").prop('checked') == false){
      $("input:checkbox[name='like_id']").prop({'checked':true});
    }else{
      $("input:checkbox[name='like_id']").prop({'checked':false});
    }
  });
            var Format = "yy-mm-dd 23:59:59";
            $("#user_date").datepicker({
                dateFormat: Format
            });
});


function out_put_like_count_user_table(res) {    
    jQuery(function($) {
        $("#output_like_user").empty();
        $.each(res, function(i, item) {
            $("#output_like_user").append('<tr><td class="chack_box"><input class="like_id" type="checkbox" name="like_id" value="'+ item.like_id +'"></td><td class="user_name">'+ item.like_count_user_login_neme +'</td><td class="user_push_title">'+ item.post_name +'</td><td class="date">'+ item.last_count_date +'</td></tr>');
        });        
    });
}

jQuery(function($) {
  $('#allcheack').on('click', function() {
    $('.like_id').prop('checked', this.checked);
  });

  $('.category').on('click', function() {
    if ($('#output_like_user :checked').length == $('#output_like_user :input').length){
      $('#allcheack').prop('checked', 'checked');
    }else{
      $('#allcheack').prop('checked', false);
    }
  });
});


