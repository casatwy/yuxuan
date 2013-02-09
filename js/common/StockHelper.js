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
                
            html = html.replace(/data-id=\"\"/,"data-id=\""+next_id+"\"");
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
            var yarn =  $("J_yarn").html();
            var type =  $("J_type").html();
            var record = $(this).closest(".J_record");
            var data_type = record.find(".active").attr("data-type")
            //if ()
            alert(data_type);
        })
    }

}
