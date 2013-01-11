function StockHelper(baseUrl){
    this.clickAddRecord = function(actionItem){
        var html = $(".J_row:last").html();
        $(".J_row:last").after("<div class=\"J_row\"></div>");
        $(".J_row:last").html(html);
        html = $("#J_maosha").html();
        $(".J_row:last .J_content").html(html);
    };
    
    this.clickDeleteRecord = function(actionItem){
        if(parseInt($(".J_row").length) == 1){
            $.jGrowl("至少要保留一行。", {header:"提示"});
        }else{
            actionItem.closest(".J_row").remove();
        }
    };
    
    this.changeType = function(actionItem){
        var html = "";
        if(parseInt(actionItem.val()) == 1){
            html = $("#J_maosha").html();
        }else{
            html = $("#J_other").html();
        }
        actionItem.siblings(".J_content").html(html);
    };

    this.checkEmptyInput = function(){
        return true;
    };
}
