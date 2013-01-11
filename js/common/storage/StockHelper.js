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

    //@todo
    this.checkEmptyInput = function(){
        return true;
    };

    this.clickLocation = function(actionItem){
        var providerLocation = actionItem.text();
        $(".J_providerList[location!="+providerLocation+"]").hide();
        $(".J_providerList[location="+providerLocation+"]").show();
    };

    this.selectProvider = function(actionItem){
        $("#J_selectProvider").attr("provider", actionItem.attr("provider-id"));
        $("#J_selectProvider").text(actionItem.text());
        $.fancybox.close();
    };

    this.submitProvider = function(actionItem){
        var providerName = $("#J_providerName").val();
        var data = {
            "providerName":providerName,
            "providerLocation":$("#J_providerLocation").val(),
        };
        $.post(baseUrl+"/ajaxStorage/saveprovider", {data:data}, function(result){
            $("#J_selectProvider").attr("provider", result["id"]);
            $("#J_selectProvider").text(result["name"]);
            var addr = $(".J_providerList[location="+result["location"]+"]");
            if(addr.length == 0){
                $(".J_location:last").after("<a href=\"javascript:void(0);\" class=\"J_location\">"+result["location"]+"</a>");
                $(".J_providerList:last").after("<div class=\"J_providerList\" location=\""+
                    result["location"]+"\" style=\"display: none;\"><span provider-id=\""+
                    result["id"]+"\" class=\"J_provider\">"+
                    result["name"]+"</span></div>");
            }else{
                addr.append("<span provider-id=\""+result["id"]+"\" class=\"J_provider\">"+result["name"]+"</span>");
            }
            $.fancybox.close();
        },'json');
    };
}
