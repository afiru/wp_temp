//■全チェック機能
jQuery(function($){
    $('#cheack_all').click(function(){
        if($("input:checkbox[name='user_id']").prop('checked') == false){
            $("input:checkbox[name='user_id']").prop({'checked':true});
        }else{
            $("input:checkbox[name='user_id']").prop({'checked':false});
        }
    });
});

//検索機能
jQuery(function($){
    var Format = "yy-mm-dd 23:59:59";
    $("#user_date_2").datepicker({
        dateFormat: Format
    });
    $(document).on("click", "#user_date_search", function () {
        var send_user_search_obj = {};
        send_user_search_obj['date_text']         = $("#user_date_2").val();
        send_user_search_obj['freewords_text']   = $("#freewords").val();
        
        $.ajax({
            type: "POST",
            url: like_wp_users_search,
            data: {'send_user_search': send_user_search_obj},
            dataType: 'json',                    
            success: function(res){
                $("#output_like_user").empty();
                output_tabale(res);
            }
        });
    });
    function output_tabale(res) {
        $.each(res, function(i, item) {            
            $("#output_like_user").append('<tr><td class="chack_box" id=""><input id="all_cheack" class="post_id" type="checkbox" name="user_id" value="'+ item['ID'] +'"></td><td class="chack_box" id="order_cheange">'+ item['user_id'] +'</td><td class="user_push_title">'+ item['user_email'] +'</td><td class="chack_box">'+ item['user_registered'] +'</td></tr>');
        });
    }
});

//csv書き出し機能
jQuery(function($){
    $(document).on("click", "#user_csv", function () {
        var send_user_search_obj = {};
        send_user_search_obj['date_text']         = $("#user_date_2").val();
        send_user_search_obj['freewords_text']   = $("#freewords").val();
        $.ajax({
            type: "POST",
            url: like_wp_users_csv,
            data: {'send_user_search': send_user_search_obj},
            dataType: 'json',
            success: function(res){
                console.log(arr);
                //downloadCsv(res);
            }
        });
    });
    var downloadCsv = (function() {
        var tableToCsvString = function(table) {
            var str = '\uFEFF';
            for (var i = 0, imax = table.length - 1; i <= imax; ++i) {
                var row = table[i];
                for (var j = 0, jmax = row.length - 1; j <= jmax; ++j) {
                    str += '"' + row[j].replace('"', '""') + '"';
                    if (j !== jmax) {
                        str += ',';
                    }
                }
                str += '\n';
            }
            return str;
        };
        var createDataUriFromString = function(str) {
            return 'data:text/csv,' + encodeURIComponent(str);
        }
        var downloadDataUri = function(uri, filename) {
            var link = document.createElement('a');
            link.download = filename;
            link.href = uri;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };
        return function(table, filename) {
            if (!filename) {
                filename = 'output.csv';
            }
            var uri = createDataUriFromString(tableToCsvString(table));
            downloadDataUri(uri, filename);
        };
    })();
});