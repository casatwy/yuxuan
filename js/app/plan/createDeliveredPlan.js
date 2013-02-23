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
                $(plan).find('#J_show').html(html);
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
        var data = [];
        $.each($("#J_show"), function(index, value){
            var $value = $(value);
            var item = {};

            item.weight = [];
            $.each($value.find("table:first"), function(idx, val){
                    item.weight.push({weight:$(val).find("input").val()});
                });

            item.number = [];
            $.each($value.find("table:last"), function(idx, val){
                    item.number.push({weight:$(val).find("input").val()});
                });

            data.push(item);
            console.log(item);
            
        }); 
    }
}
