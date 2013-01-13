function StockHelper(baseUrl){
    this.init = function(){
        bindEvent();
        setAutoSuggest();
    };

    function bindEvent(){
        $("#J_selectProvider").nyroModal({
            closeOnEscape:false,
            closeOnClick:false
        });

        $("#J_addRecord").live('click', function(){
            clickAddRecord($(this));
        });

        $(".J_deleteRecord").live('click', function(){
            clickDeleteRecord($(this));
        });

        $(".J_type").live('change', function(){
            changeType($(this));
        });

        $(".J_location").live('click', function(){
            clickLocation($(this));
        });

        $(".J_provider").live('click', function(){
            selectProvider($(this));
        });

        $("#J_submitProvider").live('click', function(){
            submitProvider($(this));
        });

        $(".J_createProvider").live('keypress', function(){
            validateProvider($(this));
        });
    }

    function setAutoSuggest(){
    }

    function clickAddRecord(actionItem){
        var html = $(".J_row:last").html();
        $(".J_row:last").after("<div class=\"J_row\"></div>");
        $(".J_row:last").html(html);
        html = $("#J_maosha").html();
        $(".J_row:last .J_content").html(html);
    };
    
    function clickDeleteRecord(actionItem){
        if(parseInt($(".J_row").length) == 1){
            $.jGrowl("至少要保留一行。", {header:"提示"});
        }else{
            actionItem.closest(".J_row").remove();
        }
    };
    
    function changeType(actionItem){
        var html = "";
        if(parseInt(actionItem.val()) == 1){
            html = $("#J_maosha").html();
        }else{
            html = $("#J_other").html();
        }
        actionItem.siblings(".J_content").html(html);
    };

    function clickLocation(actionItem){
        var providerLocation = actionItem.text();
        $(".J_providerList[location!="+providerLocation+"]").hide();
        $(".J_providerList[location="+providerLocation+"]").show();
    };

    function selectProvider(actionItem){
        $("#J_selectProvider").attr("provider", actionItem.attr("provider-id"));
        $("#J_selectProvider").text(actionItem.text());
        $.nmTop().close();
    };

    function submitProvider(actionItem){
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
            $.nmTop().close();
        },'json');
    };

    function validateProvider(actionItem){
        var buttonAvailable = true;
        $(".J_createProvider").each(function(index, value){
            if($(value).val().length == 0){
                buttonAvailable = false;
                return false;
            }
        });
        if(buttonAvailable){
            $("#J_submitProvider").removeAttr("disabled");
        }
    }

    this.inputAvailable = function(){
        var result = true;
        $(".J_content input").each(function(index, value){
            if($(value).val().length == 0){
                $.jGrowl("请填写空白处！", {
                    header:"提示",
                    life:2000
                });
                result = false;
                return false;
            }
        });
        if($("#J_selectProvider").attr("provider") === "none"){
            $.jGrowl("请选择客户！", {
                header:"提示",
                life:2000
            });
            result = false;
        }
        return result;
    };

    this.getPostData = function(){
        var data = new Array();
        $(".J_row").each(function(index, value){
            var item = {
                provider_id    :   $("#J_selectProvider").attr("provider"),
                type           :   $(value).find(".J_type").val(),
                goods_number   :   $(value).find(".J_goodsNumber").val(),
                color_number   :   $(value).find(".J_colorNumber").val(),
                color_name     :   $(value).find(".J_colorName").val(),
                zhi_count      :   $(value).find(".J_zhiCount").val(),
                gang_number    :   $(value).find(".J_gangNumber").val(),
                weight         :   $(value).find(".J_weight").val()
            };
            if(item.type !== "1"){
                item.needle_type =$(value).find(".J_needleType").val();
                item.size =$(value).find(".J_size").val();
                item.quantity =$(value).find(".J_quentity").val();
            }
            data.push(item);
        });
        return data;
    };
}
