$(document).ready(function(){
    var bigtable = new BigTable($("#J_baseUrl").val());
    bigtable.init();
});

function BigTable(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){

        $(".record_error").live("click", function(){
            $(this).removeClass("record_error");
        });

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

        $(".J_addSecondRow").live("click", function(){
            var nextSec_id = $("#J_nextSecId").attr("nextSec-id");
            var secondRow = $(this).closest(".J_SecondRow");
            var count = $(".J_SmallSecondRow").html().toString();
            var smallsecRow = $("<tr data-id=\""+nextSec_id+"\" class=\"J_SmallSecondRow\"></tr>").html(count);           

            $(secondRow).append(smallsecRow);
            nextSec_id = parseInt(nextSec_id)+1;
            $("#J_nextSecId").attr("nextSec-id", nextSec_id);
        });


        $(".J_delSecondRow").live("click", function(){
            var secondRow = $(this).closest(".J_SecondRow");
            var length = secondRow.children("tr").length;

            if (length > 1) {
                $(this).closest(".J_SmallSecondRow").remove();
                }
        
        });

        $("#J_saveData").bind("click", function(){
            var productData = getPlanData();
            var partData = getPartitionData();
            var data = {
                partData:partData,
                productData:productData,
                goods_number:$("#J_goodsNumber").val(),
                client_id:$("#J_selectProvider").attr("provider"),
                deadline:$("#J_deadLine").val()
            };

            if(productData != false){
                $.post(baseUrl+"/ajaxPlan/savePlanList", {data:data}, function(result){
                    //}else if(result == 2){
                    //    $.jGrowl("该产品对应的毛纱尚未入库。", {header:"错误"})
                    if(result == 0){
                        $.jGrowl("数据库中已存在相同的货号，请修改新的货号。", {header:"错误"})
                    }else{
                        window.location.href = baseUrl+"/plan";
                    }
                }, 'json');
            }
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

    function getPartitionData(){
        var data = [];
        $(".J_SmallSecondRow").each(function(index, value){
            var $value = $(value);
            if(!$value.hasClass("J_template")){
                var item = {};
                item.needleType = $value.find(".J_needleType").val();
                item.partName = $value.find(".J_partName").val();
                data.push(item);
            }
        });
        return data;
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

                $.each($value.find(".J_diaoxian"), function(idx, val){
                    item.spec[idx].diaoxian = $(val).find("input").val();
                });

                data.push(item);
            }
        });
        return data;
    }
}
