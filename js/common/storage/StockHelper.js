$(document).ready(function(){
    stockHelper = new StockHelper($("#J_baseUrl").val());
    stockHelper.init();
});

function StockHelper(baseUrl){
    this.init = function(){
        bindEvent();
        $("a[href='/storage/"+$("#J_sort").val()+"']").closest("li").addClass("active");
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

        $("#J_saveRecord").live('click', function(){
            clickSaveRecord($(this));
        });
    }

    function clickSaveRecord(actionItem){
        if(!stockHelper.inputAvailable()){
            return false;
        }

        var data = stockHelper.getPostData();
		var sort = $('#J_sort').val();
		if(sort == 'instock'){
			var appendUrl = '/ajaxStorage/saveinstock';		
		}else if(sort == 'outstock'){
			var appendUrl = '/ajaxStorage/saveoutstock';		
		}

        $.post(baseUrl+appendUrl, {data:data}, function(result){
            if(result['success'] == "1"){
                //$.jGrowl("保存成功！", {
                //    header:"反馈",
                //    life:2000,
                //    beforeOpen:function(){
                //        $("#J_container").html(result["content"]);
                //    }
                //});
                window.location.href = baseUrl+"/storage/printRecordList/type/"+result["type"]+"/id/"+result["id"];
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
		if(isNaN($('.J_colorNumber').val())){
            $.jGrowl("色号为数字！", {
                header:"提示",
                life:2000
            });
            result = false;
		}
		if(isNaN($('.J_goodsNumber').val())){
            $.jGrowl("货号为数字！", {
                header:"提示",
                life:2000
            });
            result = false;
		}
		if(isNaN($('.J_zhiCount').val())){
            $.jGrowl("支数为数字！", {
                header:"提示",
                life:2000
            });
            result = false;
		}
		if(isNaN($('.J_weight').val())){
            $.jGrowl("重量为数字！", {
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
