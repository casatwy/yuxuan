$(document).ready(function(){
    var type = parseInt($("#J_searchButton").attr("data-type"));
    if(type == 1){
        $("a[href='/storage/outstock']").closest("li").addClass("active");
    }
    if(type == 2){
        $("a[href='/storage/instock']").closest("li").addClass("active");
    }
});
