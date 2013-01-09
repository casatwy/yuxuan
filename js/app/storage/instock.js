$(document).ready(function(){
    var page = new InstockPage($("#J_baseUrl").val());
    page.init();
});

function InstockPage(baseUrl){
    this.baseUrl = baseUrl;
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        $("#J_createRecord").bind('click', function(){
            createRecord($(this));
        });
    }

    function createRecord(actionItem){
        $.colorbox({overlayClose:false, escKey:false, arrowKey:false, href:baseUrl+"/storage/ajaxcreateinstock"});
    }
}
