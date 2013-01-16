$(document).ready(function(){
    var page = new CreateInStock();
    page.init();
});

function CreateInStock(baseUrl){
    stockHelper = new StockHelper(baseUrl);

    this.init = function(){
        stockHelper.init();
        bindEvent();
    };

    function bindEvent(){
    }


}
