$(document).ready(function(){
    var createDeliveredPlan = new CreateDeliveredPlan($("#J_baseUrl").val());
    createDeliveredPlan.init();
});

function CreateDeliveredPlan(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
    }
}
