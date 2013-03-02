$(document).ready(function(){
    var judge = new Judge($("#J_baseUrl").val());
    judge.init();
});
function Judge(baseUrl){
    this.init = function(){
        bindEvent();
    };
    this.checkAvailable = function(){
        var providerVal = $("#J_selectProvider").attr("provider");
        if(providerVal == "none"){
            $.jGrowl("请选择客户!", { life: 5000 });  return false ; }
        else{
        return true;
        }
    }

    function bindEvent(){
        $(".J_goodsNum").live("keyup",function(){
            var goodsNumLength = $(this).val().length;
            var note = $(this).closest(".J_note");

            $(note).find(".J_goOnButton").attr("disabled",goodsNumLength == 0);
        });

    }
}
