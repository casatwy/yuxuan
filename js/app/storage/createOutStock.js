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
