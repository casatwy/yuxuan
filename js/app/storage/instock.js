$(document).ready(function(){
    var page = new InstockPage($("#J_baseUrl").val());
    page.init();
});

function InstockPage(baseUrl){

    var stockHelper = new StockHelper(baseUrl);
    stockHelper.init();

    var recordHelper = new RecordHelper(baseUrl);
    recordHelper.init();

    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
    }
}
