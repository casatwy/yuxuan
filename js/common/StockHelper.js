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
            html = html.replace(/J_Record/,"J_record");
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
            var yarn =  $(".J_yarn").html();
            var type =  $(".J_type").html();
            var record = $(this).closest(".J_record");
            var data_type = record.find(".active").attr("data-type");
            var goodsNumber = record.find(".J_goodsNumber").val()

            if ( data_type == 0)
                record.find(".J_recordContent").append(yarn);
            else
                record.find(".J_recordContent").append(type);
            alert(goodsNumber);
                console.log(goodsNumber);
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
