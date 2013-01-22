$(document).ready(function(){
    var createDeliveredPlan = new CreateDeliveredPlan($("#J_baseUrl").val());
    createDeliveredPlan.init();
});

function CreateDeliveredPlan(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){

        $("#J_addRecord").bind("click", function(){
            addRecord($(this));
        });

        $(".J_deleteRecord").live("click", function(){
            deleteRecord($(this));
        });

        $("#J_saveRecord").bind("click", function(){
            saveRecord($(this));
        });
    }

    function saveRecord(actionItem){
        var data = getPostData();
        console.log(data);
    }

    function getPostData(){
        var data = new Array();
        $(".J_row").each(function(index, value){
            var item = {
                provider_id     :   $("#J_selectProvider").attr("provider"),
                goods_number    :   $(value).find(".J_goodsNumber").val(),
                color_number    :   $(value).find(".J_colorNumber").val(),
                color_name      :   $(value).find(".J_colorName").val(),
                needle_type     :   $(value).find(".J_needleType").val(),
                size            :   $(value).find(".J_size").val(),
                quantity        :   $(value).find(".J_quentity").val(),
            };
            data.push(item);
        });
        return data;
    }

    function deleteRecord(actionItem){
        if(parseInt($(".J_row").length) == 1){
            $.jGrowl("至少要保留一行。", {header:"提示"});
        }else{
            actionItem.closest(".J_row").remove();
        }
    }

    function addRecord(actionItem){
        var html = $(".J_row:last").html();
        $(".J_row:last").after("<div class=\"J_row\"></div>");
        $(".J_row:last").html(html);
    }
}
