$(document).ready(function(){
    var page = new CreateInStock($("#J_baseUrl").val());
    page.init();
});

function CreateInStock(baseUrl){

    this.init = function(){
        $("a[href='/storage/outstock']").closest("li").addClass("active");
        bindEvent();
    }

    function bindEvent(){
        $("#J_saveRecord").live('click', function(){
            clickSaveRecord($(this));
        });

        $(".J_goodsNumber").live('change', function(){
            checkGoodsNumber($(this));
        });

        $(".J_type").live('change', function(){
            checkGoodsNumber($(this));
        });
    }

    function checkGoodsNumber(actionItem){
        $.get(baseUrl+'/ajaxStorage/getRecordContent?type='
                +actionItem.closest('tr').find(".J_type").val()
                +'&goodsNumber='+actionItem.val(),
            function(html){
        });
    }

    function clickSaveRecord(actionItem){
        if(!this.stockHelper.inputAvailable()){
            return false;
        }

        var data = stock.getPostData();

        $.post(baseUrl+'/ajaxStorage/saveoutstock', {data:data}, function(result){
            if(result['success'] == "1"){
                $.jGrowl("保存成功！", {
                    header:"反馈",
                    life:2000,
                    beforeOpen:function(){
                        $("#J_container").html(result["content"]);
                    }
                });
            }else{
                $.jGrowl("保存失败，请检查数据。", {header:"反馈"});
            }
        }, 'json');
    }
}
