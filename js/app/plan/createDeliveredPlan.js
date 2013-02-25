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
                var itemDate = {};
                itemDate.weight = [];
                $(item).find("table:first input").each(function(idx, val){
                     itemDate.weight.push({weight:$(this).val()});  
                    });
    
                itemDate.number = [];
                $(item).find("table:last input").each(function(idx, val){
                    itemDate.number.push({number:$(this).val()});
                    });
             plandata.push(itemDate);
                }
        }); 
        console.log(plandata);
        return plandata;    
    }
}

