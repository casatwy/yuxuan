$(document).ready(function(){
    var page = new CreateInStock($("#J_baseUrl").val());
    page.init();
});

function CreateInStock(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        $("#J_saveRecord").bind('click', function(){
            clickSaveRecord($(this));
        });
        
        $("#J_addRecord").bind('click', function(){
            clickAddRecord($(this));
        });

        $(".J_deleteRecord").live('click', function(){
            clickDeleteRecord($(this));
        });

        $(".J_type").live('change', function(){
            changeType($(this));
        });
    }

    function clickSaveRecord(actionItem){
        //emptyElements = $("input:empty");
        //if(emptyElements.length > 0){
        //    $.jGrowl("请填写空白处！", {
        //        header:"提示",
        //        life:2000
        //    });
        //    //emptyElements.addClass("error");
        //    return 0;
        //}
        var data = new Array();

        $(".J_row").each(function(index, value){
            var item = new Object();
            item["provider_id"] = $("#J_selectProvider").attr("privider");
            item["type"] = $(value).find(".J_type").val();
            item["goods_number"] =$(value).find(".J_goodsNumber").val();
            item["color_number"] =$(value).find(".J_colorNumber").val();
            item["color_name"] =$(value).find(".J_colorName").val();
            item["zhi_count"] =$(value).find(".J_zhiCount").val();
            item["gang_number"] =$(value).find(".J_gangNumber").val();
            item["weight"] =$(value).find(".J_weight").val();
            if(item["type"] !== "1"){
                item["needle_type"] =$(value).find(".J_needleType").val();
                item["size"] =$(value).find(".J_size").val();
                item["quantity"] =$(value).find(".J_quentity").val();
            }
            data.push(item);
        });

        data = $.toJSON(data);
        $.post(baseUrl+'/ajaxStorage/saveinstock', {data:data}, function(result){
            if(result['success'] == "1"){
                $.jGrowl("保存成功！", {
                    header:"反馈",
                    life:2000,
                    beforeOpen:function(){
                        $("#J_container").html(result["content"]);
                    }
                });
            }else{
                $.jGrowl("保存失败，请检查数据。", {header:"反馈"});
            }
        }, 'json');
    }

    function clickAddRecord(actionItem){
        var html = $(".J_row:last").html();
        $(".J_row:last").after("<div class=\"J_row\"></div>");
        $(".J_row:last").html(html);
        html = $("#J_maosha").html();
        $(".J_row:last .J_content").html(html);
    }

    function clickDeleteRecord(actionItem){
        if(parseInt($(".J_row").length) == 1){
            $.jGrowl("至少要保留一行。", {header:"提示"});
        }else{
            actionItem.closest(".J_row").remove();
        }
    }

    function changeType(actionItem){
        var html = "";
        if(parseInt(actionItem.val()) == 1){
            html = $("#J_maosha").html();
        }else{
            html = $("#J_other").html();
        }
        actionItem.siblings(".J_content").html(html);
    }
}
