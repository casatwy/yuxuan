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
        $("#J_fetchedRecords").html("<img src=\""+baseUrl+"/images/bigloading.gif"+"\"></img>");

        var data = {
            goodsNumber:$("#J_goodsNumber").val(),
            recordId:$("#J_recordId").val(),
            providerId:$("#J_selectProvider").attr("provider"),
            start_time:$("#J_startTime").val(),
            end_time:$("#J_endTime").val()
        };

        $.get(baseUrl+"/ajaxStorage/searchRecord",{data:data, type:actionItem.attr("data-type")},function(html){
            $("#J_fetchedRecords").html(html);
            setAccordion(true);
        });
    }

    function getRecordContent(event, ui){
        $.get(baseUrl+"/ajaxStorage/getRecordContent"
			, {record_id:ui.newHeader.attr("data-record-id"), record_type:ui.newHeader.attr("data-record-type")}
			, function(html){
            ui.newPanel.html(html);
        });
    }
}
