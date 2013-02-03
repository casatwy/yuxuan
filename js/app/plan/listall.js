$(document).ready(function(){
    var listall = new ListAll($("#J_baseUrl").val());
    listall.init();
});

function ListAll(){
    this.init = function(){
        $("#J_tabs").tabs();
        bindEvent();
    };

    function bindEvent(){
    }
}
