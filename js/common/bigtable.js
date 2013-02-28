$(document).ready(function(){
    var bigtable = new BigTable($("#J_baseUrl").val());
    bigtable.init();
});

function BigTable(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){
        $(".J_addBigRow").live("click", function(){
            var html = $("#J_bigRowTemplate").html().toString();
            var next_id = $("#J_nextId").attr("next-id");

            html = html.replace(/ J_template/,"");
            for(var i = 0 ;i < 3 ;i++){
                html = html.replace(/data-id=\"\"/, "data-id=\""+next_id+"\"");
                next_id = parseInt(next_id)+1;
            }
            $(html).css("display","none").fadeIn(500).appendTo($(this).closest("#J_bigTable"));
            $("#J_nextId").attr("next-id", next_id);
        
        });

        $(".J_delBigRow").live("click", function(){
            var length = $("#J_bigTable tbody").length;

            if (length != 2 )
                $(this).closest(".J_bigRow").fadeOut(500,function(){
                    $(this).remove();
                    });

        });

        $(".J_addSmallRow").live("click", function(){
            var next_id = $("#J_nextId").attr("next-id");
            var bigRow = $(this).closest(".J_bigRow");
            var length = bigRow.children("tr").length;
            var count = $(".J_smallTable").html().toString();
            var smallTable = $("<tr data-id=\""+next_id+"\" class=\"J_smallTable\"></tr>").html(count);

            //$(this).closest(".J_bigRow").append(smallTable);
            $(smallTable).css("display","none").fadeIn(500).appendTo($(this).closest(".J_bigRow"));
            next_id = parseInt(next_id)+1;
            $("#J_nextId").attr("next-id", next_id);
            bigRow.find(".J_rowspan").attr("rowspan",length+1);

        });

        $(".J_delSmallRow").live("click", function(){
            var bigRow = $(this).closest(".J_bigRow");
            var length = bigRow.children("tr").length;

            if (length > 2) {
                $(this).closest(".J_smallTable").fadeOut(500,function(){
                    $(this).remove();
                    bigRow.find(".J_rowspan").attr("rowspan",length-1);
                    });
                }
        
        });

        $("#J_saveData").bind("click", function(){
            var data = getPlanData();
            console.log(data);
            if(data != false){
                $.post(baseUrl+"/ajaxPlan/savePlanList", {
                    data:data,
                    goods_number:$("#J_goodsNumber").val(),
                    needle_type:$("#J_needleType").val(),
                    client_id:$("#J_selectProvider").attr("provider")
                }, function(result){
                    if(result == 0){
                        $.jGrowl("提交失败。", {header:"错误"})
                    }else{
                        window.location.href = baseUrl+"/plan";
                    }
                }, 'json');
            }
        });

        $(".record_error").live("click", function(){
            $(this).removeClass("record_error");
        });
    }

    function checkAvailable(){
        var result = true;
        $("input").each(function(index, value){
            if($(value).val() == ''){
                $(value).addClass("record_error");
                result = false;
            }
        });
        return true;
    }

    function getPlanData(){
        if(!checkAvailable()){
            $.jGrowl("请将表格填写完整。", {header:"提示"});
            return false;
        }
        var data = [];
        $.each($(".J_bigRow"), function(index, value){
            var $value = $(value);
            if(!$value.hasClass("J_template")){
                var item = {};

                item.color_name = $(value).find(".J_colorName").val();
                item.color_number = $(value).find(".J_colorNumber").val();
                item.gang_number = $(value).find(".J_gangNumber").val();
                item.spec = [];

                $.each($value.find(".J_sizeTable"), function(idx, val){
                    item.spec.push({size:$(val).find("input").val(), count:null});
                });

                $.each($value.find(".J_countTable"), function(idx, val){
                    item.spec[idx].count = $(val).find("input").val();
                });
                console.log(item);
                data.push(item);
            }
        });
        return data;
    }
}
