$(document).ready(function(){
    var createDeliveredPlan = new CreateDeliveredPlan($("#J_baseUrl").val());
    createDeliveredPlan.init();
});

function CreateDeliveredPlan(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        $('#J_saveAll').live('click',function(){
            alert('save');
            var data = getDeliveredPlanData();
        });

        $('.J_goOn').live('click',function(){
            var plan =  $(this).parents('.J_deliverdPlan');
            var goodsNumber = $(plan).find('#J_goodsNumber').val();
            $.get(baseUrl+'/ajaxPlan/getDeliveredTable', {goods_number : goodsNumber}, function(html){
                $(plan).find('.J_show').html(html);
               })
        });

        $('.J_addPlan').live('click',function(){
            var html = $('#J_addDeliverdPlan').html().toString();
            $("#J_deliverdPlanDiv").append(html);
        });

        $('.J_delPlan').live('click',function(){
            var length = $('#J_deliverdPlanDiv .J_deliverdPlan').length;
            if(length != 1)
                $(this).parents('.J_deliverdPlan').remove();
        });
    }
    function getDeliveredPlanData(){
        var plandata = [];
        $(".J_show").each(function(index, value){
            var item = $(value);
            if(!$(item).closest("#J_addDeliverdPlan").hasClass("hide")) {console.log()

                $(item).find("table:first tr:gt(0)").each(function(idx, val){
                    var itemDate = {};
                    itemDate.color_name = $(this).find(".J_color_name").text();
                    itemDate.color_number = $(this).find(".J_color_number").text();
                    itemDate.gang_number = $(this).find(".J_gang_number").text();
                    itemDate.weight = $(this).find("input").val(); 
                    plandata.push(itemDate); 
                    });

                $(item).find(".J_bignumberTable").each(function(idx, val){
                    var numberDate = {};
                    numberDate.color = $(val).find(".J_color_name").text();
                    numberDate.spec = [];
                    $(val).find(".J_smallnumberTable").each(function(idxNum, valNum){
                    numberDate.spec.push({size:$(valNum).find("td:eq(0)").text(),number:$(valNum).find("input").val()});
                        })
                    plandata.push(numberDate);
                    });

                }
        }); 
        console.log(plandata);
        return plandata;    
    }
}

