$(document).ready(function(){
    var listall = new ListAll($("#J_baseUrl").val());
    listall.init();
});

function ListAll(){
    this.init = function(){
        $("#J_tabs").tabs({
            activate:function(event, ui){
                getPlanContentWithStatus(ui.newPanel.selector, ui.newPanel.selector.charAt(6));
            }
        });
        bindEvent();
    };

    function bindEvent(){
    }

    function getPlanContentWithStatus(selector, state){

    }
}
