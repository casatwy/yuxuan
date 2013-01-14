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
            $("#J_fetchedRecords").html("<img src=\""+baseUrl+"/images/bigloading.gif"+"\"></img>");
            $("#J_fetchedRecords").html("<J_HEADER>a</J_HEADER><div>aaa</div><J_HEADER>b</J_HEADER><div>bbb</div><J_HEADER>c</J_HEADER><div>ccc</div>");
            setAccordion(true);
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
            icons:{"header":"ui-icon-plus", "headerSelected":"ui-icon-minus"}
        });
    }
}
