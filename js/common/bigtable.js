$(document).ready(function(){
    var bigtable = new BigTable();
    bigtable.init();
});

function BigTable(){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){
        $(".J_addBigRow").live("click", function(){
            var html = $("#J_bigRowTemplate").html();
            $(this).closest(".J_bigRow").after(html);
        });

        $(".J_delBigRow").live("click", function(){
            $(this).closest(".J_bigRow").remove();
        });

        $(".J_addSmallRow").live("click", function(){
            var data_id = $(this).attr("data-id");
            var next_id = $(this).attr("next-id");
            $(".J_countTable tr[data-id="+data_id+"]").after("<tr data-id='"+next_id+"'><td><input type='text'></input><td></tr>");
            $(".J_sizeTable tr[data-id="+data_id+"]").after("<tr data-id='"+next_id+"'><td><input type='text'></input><td></tr>");
        });

        $(".J_delSmallRow").live("click", function(){
        });
    }
}
