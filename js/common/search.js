$(document).ready(function(){
    var search = new Search($("#J_baseUrl").val());
    search.init();
});

function Search(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){
        $("#J_searchButton").bind("click", function(){
            searchRecord($(this));
        });
    }

    function searchRecord(actionItem){
        //data_type = 1 outStock
        //data_type = 2 inStock
        var data_type = actionItem.attr("data-type");
        var searchData = getSearchCondition();
    }

    function getSearchCondition(){
        var client_id = $("#J_selectProvider").attr("provider");
        if(client_id == "none"){
            client_id = null;
        }

        return {
            providerId : client_id,
            goodsNumber : $("#J_goodsNumber").val(),
            recordId : $("#J_recordId").val(),
            start_time : $("#J_startTime").val(),
            end_time : $("#J_endTime").val()
        };
    }
}
