$(document).ready(function(){
    recordHelper = new RecordHelper($("#J_baseUrl").val());
    recordHelper.init();
});
function RecordHelper(baseUrl){
    var type = $("#J_recordType").val();
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        $(".J_selectTime").datepicker({
            autoSize:true,
            dateFormat:"yy-mm-dd",
            dayNamesMin:["日","一","二","三","四","五","六"],
            monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
            changeMonth:true,
            changeYear:true,
            showAnim:"fadeIn",
            showMonthAfterYear:true,
        });

        setAccordion(false);

        $("#J_searchButton").bind("click", function(){
            searchRecords($(this));
        })

        $("#J_ajaxPageItem li a").live("click", function(){
            ajaxGetRecords($(this));
            return false;
        });

        $("#J_selectProvider").nyroModal({
            closeOnEscape:false,
            closeOnClick:false
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

    function setAccordion(rebuild){
        if(rebuild){
            $("#J_fetchedRecords").accordion("destroy");
        }
        $("#J_fetchedRecords").accordion({
            active:false,
            collapsible:true,
            header:"J_HEADER",
            heightStyle:"content",
            icons:{"header":"ui-icon-plus", "headerSelected":"ui-icon-minus"},
            activate:function(event, ui){getRecordContent(event, ui)},
        });
    }

    function searchRecords(actionItem){
        $("#J_fetchedRecords").html("<img class=\"ass_hole\" src=\""+baseUrl+"/images/bigloading.gif"+"\"></img>");
        var data = getSearchCondition();
        if(actionItem.attr("data-type") == undefined){
            $.get(baseUrl+actionItem.attr("href"),{data:data},function(html){
                $("#J_fetchedRecords").html(html);
                setAccordion(true);
            });
        }else{
            $.get(baseUrl+"/ajaxStorage/searchRecord",{data:data, type:actionItem.attr("data-type")},function(html){
                $("#J_fetchedRecords").html(html);
                setAccordion(true);
            });
        }
        return false;
    }

    function getRecordContent(event, ui){
        var count = ui.newPanel.find("img").length;
        var record_type = ui.newHeader.attr("data-record-type");
        var appendUrl;
        if(record_type == '1' || record_type == '2'){
            appendUrl = "/ajaxStorage/getRecordContent";
        }else if(record_type == '3'){
            appendUrl = "/ajaxPlan/showPlanContent"; 
        }
        if(count == 1){
            $.get(baseUrl+appendUrl
		    	, {record_id:ui.newHeader.attr("data-record-id"), record_type:record_type}
		    	, function(html){
                ui.newPanel.html(html);
                $(".J_listPrinter").printPreview();
            });
        }
    }

    function getSearchCondition(){
        return {
            goodsNumber:$("#J_goodsNumber").val(),
            recordId:$("#J_recordId").val(),
            providerId:$("#J_selectProvider").attr("provider"),
            start_time:$("#J_startTime").val(),
            end_time:$("#J_endTime").val(),
        };
    }

    function ajaxGetRecords(actionItem){
        $("#J_fetchedRecords").html("<img src=\""+baseUrl+"/images/bigloading.gif"+"\"></img>");
        var data = getSearchCondition();
        $.get(
            baseUrl+actionItem.attr("href"),
            function(html){
                $("#J_fetchedRecords").html(html);
                setAccordion(true);
            }
        );
    }
}
