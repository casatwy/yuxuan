$(document).ready(function(){
    var listall = new ListAll($("#J_baseUrl").val());
    listall.init();
});

function ListAll(baseUrl){
    this.init = function(){
        $("#J_tabs").tabs({
            activate:function(event, ui){
                var state = ui.newPanel.selector.charAt(6);
                if(state == "3"){
                    getFinishedPlan();
                }
            }
        });
        bindEvent();
    };

    function bindEvent(){
        $(".J_shangji").bind("click", function(){
            var plan_id = $(this).attr("data-plan-id");
            $.post(baseUrl+"/ajaxPlan/setShangji", {plan_id:plan_id}, function(){
                window.location.reload();
            });
        });

        $(".J_finish").bind("click", function(){
            var plan_id = $(this).attr("data-plan-id");
            $.post(baseUrl+"/ajaxPlan/setFinish", {plan_id:plan_id}, function(){
                window.location.reload();
            });
        });

        $(".J_delete").bind("click", function(){
            var plan_id = $(this).attr("data-plan-id");
            $.post(baseUrl+"/ajaxPlan/deleteByPlanId", {plan_id:plan_id}, function(){
                $("#J_tab1 tr[data-plan-id="+plan_id+"]").remove();
            });
        });

        $(".J_showPlan").nyroModal();
    }

    function getFinishedPlan(){
        alert("not finished");
    }
}
