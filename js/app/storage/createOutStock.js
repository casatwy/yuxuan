$(document).ready(function(){
    var page = new CreateInStock($("#J_baseUrl").val());
    page.init();
    $("#J_selectProvider").fancybox({
        //centerOnScroll      :   true,
        //hideOnOverlayClick  :   false,
        //showNavArrows       :   false,
        //enableEscapeButton  :   false,
        //showCloseButton     :   false,
        //onCleanup           :   function(){alert("here i am");},
        //onStart             :   function(){alert("here i am");},
    });
});

function CreateInStock(baseUrl){
    stockHelper = new StockHelper(baseUrl);

    this.init = function(){
        $("a[href='/storage/outstock']").closest("li").addClass("active");
        bindEvent();
    }

    function bindEvent(){
        $("#J_saveRecord").live('click', function(){
            clickSaveRecord($(this));
        });
        
        $("#J_addRecord").live('click', function(){
            stockHelper.clickAddRecord($(this));
        });

        $(".J_deleteRecord").live('click', function(){
            stockHelper.clickDeleteRecord($(this));
        });

        $(".J_type").live('change', function(){
            stockHelper.changeType($(this));
        });

        $(".J_location").live('click', function(){
            stockHelper.clickLocation($(this));
        });

        $(".J_provider").live('click', function(){
            stockHelper.selectProvider($(this));
        });

        $("#J_submitProvider").live('click', function(){
            stockHelper.submitProvider($(this));
        });
    }

    function clickSaveRecord(actionItem){
        //emptyElements = $("input");
        //console.log(emptyElements);
        //if(emptyElements.length > 0){
        //    $.jGrowl("请填写空白处！", {
        //        header:"提示",
        //        life:2000
        //    });
        //    //emptyElements.addClass("error");
        //    return 0;
        //}
        //return 0;
        if(!this.stockHelper.checkEmptyInput()){
            return false;
        }

        var data = new Array();

        $(".J_row").each(function(index, value){
            var item = new Object();
            item["provider_id"] = $("#J_selectProvider").attr("privider");
            item["type"] = $(value).find(".J_type").val();
            item["goods_number"] =$(value).find(".J_goodsNumber").val();
            item["color_number"] =$(value).find(".J_colorNumber").val();
            item["color_name"] =$(value).find(".J_colorName").val();
            item["zhi_count"] =$(value).find(".J_zhiCount").val();
            item["gang_number"] =$(value).find(".J_gangNumber").val();
            item["weight"] =$(value).find(".J_weight").val();
            if(item["type"] !== "1"){
                item["needle_type"] =$(value).find(".J_needleType").val();
                item["size"] =$(value).find(".J_size").val();
                item["quantity"] =$(value).find(".J_quentity").val();
            }
            data.push(item);
        });

        data = $.toJSON(data);
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
