//■全チェック機能
jQuery(function($){
  $('#cheack_all').click(function(){
    if($("input:checkbox[name='post_id']").prop('checked') == false){
      $("input:checkbox[name='post_id']").prop({'checked':true});
    }else{
      $("input:checkbox[name='post_id']").prop({'checked':false});
    }
  });
});

//テキスト変更～修正まで
jQuery(function($){
    $(document).on("click", '[id=text_cheange]', function () {
        if(!$(this).hasClass('on')){
            $(this).addClass('on');
            var txt = $(this).text();
            $(this).html('<input name="text_cheange_input" id="text_cheange_input" data-id="'+ $(this).data('id') +'" type="text" value="'+txt+'" />');
            $('[id=text_cheange_input]').change(function() {
                var select_users = new Array();
                select_users["post_id"] = $(this).data('id');
                select_users["like_count"] = $(this).val();
                var select_users_obj = {};
                for(key in select_users){
                  select_users_obj[key] = select_users[key];
                }
                $.ajax({
                    type: "POST",
                    url: like_post_history_cheange,
                    data: {'like_date': select_users_obj},
                    dataType: 'json',                    
                    success: function(res){
                        $("#output_like_user").empty();
                        output_liek_post_history(res);
                        location.reload();
                    }
                });
            });
        }
    });

    function output_liek_post_history(res) {
        $.each(res, function(i, item) {
            $("#output_like_user").append('<tr><td class="chack_box"><input class="post_id" type="checkbox" name="post_id" value="'+ item.post_id +'"></td><td class="chack_box">'+ item.ranking +'位</td><td class="user_push_title">'+ item.post_title +'</td><td class="chack_box" id="text_cheange" data-id="'+ item.post_id +'">'+ item.like_count +'</td><td class="date">'+ item.last_count_date +'</td></tr>');
        });
    }
});

//検索実行
jQuery(function($){
    var Format = "yy-mm-dd 23:59:59";
    $("#user_date_2").datepicker({
        dateFormat: Format
    });
    $(document).on("click", "#user_date_posts", function () {
        $("#output_like_user").empty();
        var select_users = new Array();
        select_users["user_date"] = $("#user_date_2").val();
        var select_users_obj = {};
        for(key in select_users){
          select_users_obj[key] = select_users[key];
        }
        $.ajax({
            type: "POST",
            url: like_post_history_search,
            data: {like_date: select_users_obj},
            dataType: "json",                    
            success: function(res){
                console.log(res);
                output_liek_post_history(res); 
            }
        });
    });
    function output_liek_post_history(res) {
        $.each(res, function(i, item) {
            $("#output_like_user").append('<tr><td class="chack_box"><input class="post_id" type="checkbox" name="post_id" value="'+ item.post_id +'"></td><td class="chack_box">'+ item.ranking +'位</td><td class="user_push_title">'+ item.post_title +'</td><td class="chack_box" id="text_cheange" data-id="'+ item.post_id +'">'+ item.like_count +'</td><td class="date">'+ item.last_count_date +'</td></tr>');
        });
    }
});

//削除処理
jQuery(function($){
    $(document).on("click", "#sakujo_button_posts", function () {                
        var checkedSeasons = [];
        $("[name='post_id']:checked").each(function(){
            checkedSeasons.push($(this).val());                    
        });
        $.ajax({
            type: "POST",
            url: like_post_history_delete,
            data: {'like_ids': checkedSeasons},
            dataType: "json",                    
            success: function(res){
                $("#output_like_user").empty();
                output_liek_post_history(res);
                location.reload();
            }
        });
    });
    function output_liek_post_history(res) {
        $.each(res, function(i, item) {
            $("#output_like_user").append('<tr><td class="chack_box"><input class="post_id" type="checkbox" name="post_id" value="'+ item.post_id +'"></td><td class="chack_box">'+ item.ranking +'位</td><td class="user_push_title">'+ item.post_title +'</td><td class="chack_box" id="text_cheange" data-id="'+ item.post_id +'">'+ item.like_count +'</td><td class="date">'+ item.last_count_date +'</td></tr>');
        });
    }
});