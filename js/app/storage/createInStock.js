$(document).ready(function(){
    var page = new CreateInStock($("#J_baseUrl").val());
    page.init();
});

function CreateInStock(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        $("#J_saveRecord").bind('click', function(){
            clickSaveRecord($(this));
        });
        
        $("#J_addRecord").bind('click', function(){
            clickAddRecord($(this));
        });

        $(".J_deleteRecord").live('click', function(){
            clickDeleteRecord($(this));
        });

        $(".J_type").live('change', function(){
            changeType($(this));
        });
    }

    function clickSaveRecord(actionItem){
        alert("here i am");
    }

    function clickAddRecord(actionItem){
        var html = $(".J_row:last").html();
        $(".J_row:last").after("<div class=\"J_row\"></div>");
        $(".J_row:last").html(html);
        html = $("#J_maosha").html();
        $(".J_row:last .J_content").html(html);
    }

    function clickDeleteRecord(actionItem){
        if(parseInt($(".J_row").length) == 1){
            alert("至少要保留一行。");
        }else{
            actionItem.closest(".J_row").remove();
        }
    }

    function changeType(actionItem){
        var html = "";
        if(parseInt(actionItem.val()) == 1){
            html = $("#J_maosha").html();
        }else{
            html = $("#J_other").html();
        }
        actionItem.siblings(".J_content").html(html);
        //actionItem.siblings(".J_content").html(html);
    }
}
