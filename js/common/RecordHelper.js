$(document).ready(function(){
    recordHelper = new RecordHelper($("#J_baseUrl").val());
    recordHelper.init();
});

//functions : search, setAccordian, datePicker
function RecordHelper(baseUrl){
    var type = $("#J_recordType").val();
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        setAccordion(false);

        $("#J_searchButton").bind("click", function(){
            searchRecords($(this));
        })

        $("#J_ajaxPageItem li a").live("click", function(){
            ajaxGetRecords($(this));
            return false;
        });

        $(".J_deleteRecord").live("click", function(){
            deleteRecord($(this));
            return false;
        });
    }

    function deleteRecord(actionItem){
        var record_id = actionItem.attr("data-record-id");
        var type = actionItem.attr("data-record-type");
        if(confirm("确定删除这条记录吗？")){
            $.post(baseUrl+"/ajaxStorage/deleteRecordById", {record_id:record_id, type:type}, function(){
                $("J_HEADER[data-record-id="+record_id+"]").remove();
                $("div[data-record-id="+record_id+"]").remove();
            });
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
        if(record_type == '0' || record_type == '1'){
            appendUrl = "/ajaxStorage/getRecordContent";
        }else if(record_type == '3'){
            appendUrl = "/ajaxPlan/showPlanContent"; 
        }
        if(count == 1){
            $.get(baseUrl+appendUrl
		    	, {record_id:ui.newHeader.attr("data-record-id"), record_type:record_type}
		    	, function(html){
                ui.newPanel.html(html);
                //$(".J_listPrinter").printPreview();
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
