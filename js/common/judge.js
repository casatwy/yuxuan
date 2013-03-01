$(document).ready(function(){
    var judge = new Judge($("#J_baseUrl").val());
    judge.init();
});
function Judge(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){
        $(".J_goodsNum").live("keyup",function(){
            var goodsNumLength = $(this).val().length;
            var note = $(this).closest(".J_note");

            $(note).find(".J_goOnButton").attr("disabled",goodsNumLength == 0);
        });

    }
}
