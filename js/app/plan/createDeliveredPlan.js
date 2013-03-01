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
            var data = getDeliveredPlanData();
            $.post(baseUrl+"/ajaxPlan/saveDeliveredPlan", {data:data}, function(){
                location.href=baseUrl+"/plan/deliveredList";
            });
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
        var silk = [];
        var product = [];
        $("#J_silkTable input").each(function(index, value){
            var silkInput = $(value);
            silk.push({
                silk_id:silkInput.attr("data-silk-id"),
                weight:silkInput.val(),
            });
        });
        $("#J_productTable input").each(function(index, value){
            var productInput = $(value);
            product.push({
                product_id:productInput.attr("data-product-id"),
                count:productInput.val(),
            });
        });
        var planData = {
            client_id:$("#J_selectProvider").attr('provider'),
            goods_number:$("#J_goodsNumber").val(),
            silk:silk,
            product:product,
        };
        return planData;    
    }
}

