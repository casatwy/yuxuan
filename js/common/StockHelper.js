$(document).ready(function(){
    stockHelper = new StockHelper($("#J_baseUrl").val());
    stockHelper.init();
});

function StockHelper(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){

        $("#J_addRecord").live('click', function(){
            alert();
            //clickAddRecord($(this));
        });

        $(".J_deleteRecord").live('click', function(){
            alert();
            //clickDeleteRecord($(this));
        });

        $("#J_creatNewRecord").live('click', function(){
            var html = $("#J_template").html();
            var next_id = $("#J_next").attr("next-id");
                
            html = html.replace(/data-id=\"\"/g,"data-id=\""+next_id+"\"");
            html = html.replace(/J_recordTemplate/,"J_record");
            $(".J_record:last").after(html);
            next_id = parseInt(next_id)+1;
            $("#J_next").attr("next-id", next_id);          
            //clickAddRecord($(this));

        });

        $("#J_saveRecord").live('click', function(){
            alert();
            //clickSaveRecord($(this));
        });

        $(".J_continue").live("click", function(){
            var record = $(this).closest(".J_record");

            var data_type = record.find(".active").attr("data-type");
            var goods_number = record.find(".J_goodsNumber").val()

            $.get(baseUrl+"/ajaxStorage/getStockTable",
                {data_type:data_type, goods_number:goods_number},
                function(html){
                    $("#J_template").html(html);
                    record.find(".J_recordContent").append(html);
                }
            );
        })

        $(".J_selector").live("click", function(){
            selectorClicked($(this));
        });

        
    }

    function selectorClicked(actionItem){
        var data_id = actionItem.attr("data-id");
        $(".J_selector[data-id="+data_id+"]").removeClass("active");
        actionItem.addClass("active");
        $(".J_recordContent[data-id="+data_id+"]").html("");
    }
}
