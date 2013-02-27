$(document).ready(function(){
    stockHelper = new StockHelper($("#J_baseUrl").val());
    stockHelper.init();
    //var helper = new ContentHelper();
    //helper.setContent("casa", "casacasa");
    //var fetchedContent = helper.getContent("casacasa");
    //alert(fetchedContent);
});

function StockHelper(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){

        $(".J_deleteRecord").live('click', function(){            
            $(this).closest(".J_item").remove();
        });

        $("#J_creatNewRecord").live('click', function(){
            var html = $("#J_template").html();
            var next_id = $("#J_next").attr("next-id");
                
            html = html.replace(/data-id=\"\"/g,"data-id=\""+next_id+"\"");
            html = html.replace(/J_recordTemplate/,"J_record");
            $(".J_record:last").after(html);
            next_id = parseInt(next_id)+1;
            $("#J_next").attr("next-id", next_id);          
        });

        $("#J_saveRecord").live('click', function(){
            saveRecord($(this));
        });

        $(".J_continue").live("click", function(){
            var record = $(this).closest(".J_record");

            var data_type = record.find(".active").attr("data-type");
            var goods_number = record.find(".J_goodsNumber").val()

            $.get(baseUrl+"/ajaxStorage/getStockTable",
                {data_type:data_type, goods_number:goods_number},
                function(html){
                    record.find(".J_recordContent").append(html);
                }
            );
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
        var saveData = getDataForSave();
        var url = getSaveUrl();
        $.post(url, {
            client_id:$("#J_selectProvider").attr("provider"),
            itemType:itemType,
            data:saveData
        }, function(result){
            location.href = getRedirectUrl();
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
                itemType : $(value).parents(".J_record").find(".J_selector.active").attr('data-type'),
                goods_number : $(value).parents(".J_record").find(".J_goodsNumber").val(),
                color_number : item.find(".J_colorNumber").val(),
                color_name : item.find(".J_colorName").val(),
                gang_number : item.find(".J_gangNumber").val(),
                weight : item.find(".J_weight").val(),
                size : item.find(".J_size").val(),
                needle_type : item.find(".J_needleType").val(),
                count : item.find(".J_count").val()
            };
            result.push(itemData);
        });
        console.log(result);
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
