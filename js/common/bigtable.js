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
            var html = $("#J_bigRowTemplate").html().toString();
            var next_id = $(this).attr("next-id");

            html = html.replace(/ J_template/,"");
            html = html.replace(/data-id/g, "data-id=\""+next_id+"\"");
            $(this).closest(".J_bigRow").after(html);

            next_id = parseInt(next_id)+1;
            $("button").each(function(index, value){
                console.log(value);
                $(value).attr("next-id", next_id.toString());
            });
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

        $("#J_test").bind("click", function(){
            getPlanData();
        });
    }

    function getPlanData(){
        var data = [];
        $.each($(".J_bigRow"), function(index, value){
            var $value = $(value);
            if(!$value.hasClass("J_template")){

                var item = {};

                item.color_name = $(value).find(".J_colorName").val();
                item.color_number = $(value).find(".J_colorNumber").val();
                item.gang_number = $(value).find(".J_gangNumber").val();
                item.spec = [];

                $.each($value.find(".J_sizeTable tr"), function(idx, val){
                    item.spec.push({size:$(val).find("input").val(), count:null});
                });

                $.each($value.find(".J_countTable tr"), function(idx, val){
                    item.spec[idx].count = $(val).find("input").val();
                });

                data.push(item);
            }
        });

        console.log(data);
    }
}
