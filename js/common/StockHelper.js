$(document).ready(function(){
    stockHelper = new StockHelper($("#J_baseUrl").val());
    stockHelper.init();
});

function StockHelper(baseUrl){
    this.init = function(){
        bindEvent();
    };
    this.judgeRecord = function(){
        var success = true;
        $(".J_record").each(function(indContent, valContent){
            if($(valContent).find(".J_item").length == 0){
                $.jGrowl("请先填写货号.", { header:"提示", life: 5000 });
                success = false; 
                return false;
            }else{
                $(valContent).find(".J_item").each(function(index, value){
                    $(value).find("input").each(function(ind, val){
                        if($(val).val().length == 0){
                            $.jGrowl("请将数据填写完整.", { header:"错误", life: 5000 });
                            success = false; 
                            return  false;
                        }else{
                            return true;
                        }
                    });
                });
            }
        });
        return success ; 
     };
    function bindEvent(){

        $(".J_deleteRecord").live('click', function(){
            $(this).closest(".J_item").remove();
        });

        $("#J_creatNewRecord").live('click', function(){
            $.post(baseUrl+"/ajaxStorage/createNewRecord", {}, function(result){
                var next_id = $("#J_next").attr("next-id");

                result = result.replace(/data-id=\"\"/g,"data-id=\""+next_id+"\"");
                result = result.replace(/J_recordTemplate/,"J_record");
                $(".J_record:last").after(result);

                next_id = parseInt(next_id)+1;
                $("#J_next").attr("next-id", next_id);
            });
        });

        $("#J_saveRecord").live('click', function(){
            var judge = new Judge($("#J_baseUrl").val());
            if(!judge.checkAvailable()){
                return;
            }
            if(!stockHelper.judgeRecord()){
                return;
            }

            saveRecord($(this));
        });

        $(".J_continue").live("click", function(){
            var record = $(this).closest(".J_record");

            var data_type = record.find(".active").attr("data-type");
            var goods_number = record.find(".J_goodsNumber").val();

            $.get(baseUrl+"/ajaxStorage/getStockTable",{data_type:data_type, goods_number:goods_number},function(html){
                    if(html == 0){
                        $.jGrowl("请确保输入正确的货号。", {header:"错误", life: 5000});
                    }else{
                        record.find(".J_recordContent").append(html);
                    }
                }
            );  
        });

        $(".J_del").live("click", function(){
            if($(".J_record").length > 1)
                $(this).closest(".J_record").remove();
            else
                $.jGrowl("至少保留一条！", {header:"错误", life: 5000});
        });

        $("select").live("change", function(){
            changeToInput($(this));
        });

        $(".J_return").live("click",function(){
            returnToSelect($(this));
        });

        $(".J_selector").live("click", function(){
            selectorClicked($(this));
        });
    }

    function changeToInput(actionItem){
        var content = actionItem.html();
        var value = actionItem.val();
        var classes = actionItem.attr("class");

        var next_id = $("#J_tableNextId").attr("next-id");
        var inputDom = "<input type=\"text\" id=\"J_input"+next_id+"\"></input>";
        var returnDom = "<a class=\"J_return\" id=\"J_"+next_id+"\" data-id=\""+next_id+"\">返回</a>";

        var selector = "J_"+next_id;
        $("#J_tableNextId").attr("next-id", parseInt(next_id)+1);

        inputDom = $(inputDom).addClass(classes);
        inputDom = $(inputDom).after(returnDom);
        if (value == "input"){
            actionItem.before($("<span class=\"bottom_none\"></span>").html(inputDom));
            $("#"+selector).data("content", content);
            actionItem.remove();
        }
    }

    function returnToSelect(actionItem){
        var inputFrame = actionItem.closest("span");
        var content = actionItem.data("content");
        var classes = actionItem.prev().attr("class");
        var selectDom = "<select></select>";

        inputFrame.before($(selectDom).addClass(classes));
        $("select."+classes).html(content);
        inputFrame.remove();
    }

    function selectorClicked(actionItem){
        if (actionItem.hasClass("active")){return 0;}
        var data_id = actionItem.attr("data-id");
        $(".J_selector[data-id="+data_id+"]").removeClass("active");
        actionItem.addClass("active");
        $(".J_recordContent[data-id="+data_id+"]").html("");
    }

    function saveRecord(actionItem){
        var itemType = $(".J_selector.active").attr("data-type");
        var client_id = $("#J_selectProvider").attr("provider");
        var saveData = getDataForSave();
        var url = getSaveUrl();

        var postData = {
            client_id:client_id,
            itemType:itemType,
            data:saveData
        };

        $.post(url, {
            data:postData
        }, function(result){
            if(result == 0){
                alert("此记录没有对应的生产计划，请检查填写是否正确。");
            }else{
                //location.href = getRedirectUrl();
            }
        }, "json");
    }

    function getRedirectUrl(){
        var url = baseUrl+"/storage/";
        if($("#J_recordType").attr("data-type") == "入"){
            url+="instock";
        }
        if($("#J_recordType").attr("data-type") == "出"){
            url+="outstock";
        }
        return url;
    }

    function getSaveUrl(){
        var url = baseUrl+"/ajaxStorage/";
        if($("#J_recordType").attr("data-type") == "入"){
            url+="saveinstock";
        }
        if($("#J_recordType").attr("data-type") == "出"){
            url+="saveoutstock";
        }
        return url;
    }

    function getDataForSave(){
        var result = [];
        $(".J_item").each(function(index, value){
            var item = $(value);
            var data_id = $(value).parents(".J_recordContent");
            var itemData = {
                itemType : item.parents(".J_record").find(".J_selector.active").attr('data-type'),
                goods_number : item.parents(".J_record").find(".J_goodsNumber").val(),
                color_number : item.find(".J_colorNumber").val(),
                color_name : item.find(".J_colorName").val(),
                gang_number : item.find(".J_gangNumber").val(),
                weight : item.find(".J_weight").val(),
                actural_weight : item.find(".J_acturalWeight").val(),
                size : item.find(".J_size").val(),
                needle_type : item.find(".J_needleType").val(),
                count : item.find(".J_count").val(),
                product_type : item.find(".J_productType").val(),
                gang_number : item.find(".J_gangNumber").val(),
                diaoxian : item.find(".J_diaoxian").val(),
                client_id : $("#J_selectProvider").attr("provider")
            };
            result.push(itemData);
        });
        return result;
    }
}

function ContentHelper(){
    this.setContent = function(content, key){
        this.contentArray[key] = content;
    };

    this.getContent = function(key){
        return this.contentArray[key];
    };
}
