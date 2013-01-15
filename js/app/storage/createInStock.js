$(document).ready(function(){
    var page = new CreateInStock($("#J_baseUrl").val());
    page.init();
});

function CreateInStock(baseUrl){
    stockHelper = new StockHelper(baseUrl);

    this.init = function(){
        stockHelper.init();
        $("a[href='/storage/instock']").closest("li").addClass("active");
        bindEvent();
    };

    function bindEvent(){
        $("#J_saveRecord").live('click', function(){
            clickSaveRecord($(this));
        });
    }

    function clickSaveRecord(actionItem){
        if(!stockHelper.inputAvailable()){
            return false;
        }

        var data = stockHelper.getPostData();
		var sort = $('#sort').val();
		if(sort == 'instock'){
			var appendUrl = '/ajaxStorage/saveinstock';		
		}else if(sort == 'outstock'){
			var appendUrl = '/ajaxStorage/saveoutstock';		
		}

        $.post(baseUrl+appendUrl, {data:data}, function(result){
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
