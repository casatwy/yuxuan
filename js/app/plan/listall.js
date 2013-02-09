$(document).ready(function(){
    var listall = new ListAll($("#J_baseUrl").val());
    listall.init();
});

function ListAll(baseUrl){
    this.init = function(){
        $("#J_tabs").tabs({
            activate:function(event, ui){
                var state = ui.newPanel.selector.charAt(6);
                if(state == "3"){
                    getFinishedPlan();
                }
            }
        });
        bindEvent();
    };

    function bindEvent(){
        $(".J_shangji").bind("click", function(){
            var goods_number = $(this).attr("data-goods-number");
            $.post(baseUrl+"/ajaxPlan/setShangji", {goods_number:goods_number}, function(){
                window.location.reload();
            });
        });
        $(".J_delete").bind("click", function(){
            var goods_number = $(this).attr("data-goods-number");
            $.post(baseUrl+"/ajaxPlan/deleteByGoodsNumber", {goods_number:goods_number}, function(){
                $("tr[data-goods-number="+goods_number+"]").remove();
            });
        });
    }

    function getFinishedPlan(){
    }
}
