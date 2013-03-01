$(document).ready(function(){
    var selectProvider = new SelectProvider($("#J_baseUrl").val());
    selectProvider.init();
});

function SelectProvider(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){

        $("#J_selectProvider").nyroModal({
            closeOnEscape:false,
            closeOnClick:false
        });

        $(".J_location").live('click', function(){
            clickLocation($(this));
        });

        $(".J_provider").live('click', function(){
            selectProvider($(this));
        });

        $("#J_submitProvider").live('click', function(){
            submitProvider($(this));
        });

        $(".J_createProvider").live('keyup', function(){
            validateProvider($(this));
        });
    }

    function clickLocation(actionItem){
        var providerLocation = actionItem.text();
        $(".J_providerList[location!="+providerLocation+"]").hide();
        $(".J_providerList[location="+providerLocation+"]").show();
        $(".J_location").removeClass("active");
        actionItem.addClass("active");
    };

    function selectProvider(actionItem){
        $("#J_selectProvider").attr("provider", actionItem.attr("provider-id"));
        $("#J_selectProvider").text(actionItem.text());
        $.nmTop().close();
    };

    function submitProvider(actionItem){
        var providerName = $("#J_providerName").val();
        var data = {
            "providerName":providerName,
            "providerLocation":$("#J_providerLocation").val(),
        };
        $.post(baseUrl+"/ajaxStorage/saveprovider", {data:data}, function(result){
            $("#J_selectProvider").attr("provider", result["id"]);
            $("#J_selectProvider").text(result["name"]);
            var addr = $(".J_providerList[location="+result["location"]+"]");
            if(addr.length == 0){
                $(".J_location:last").after("<a href=\"javascript:void(0);\" class=\"J_location\">"+result["location"]+"</a>");
                $(".J_providerList:last").after("<div class=\"J_providerList\" location=\""+
                    result["location"]+"\" style=\"display: none;\"><span provider-id=\""+
                    result["id"]+"\" class=\"J_provider\">"+
                    result["name"]+"</span></div>");
            }else{
                addr.append("<span provider-id=\""+result["id"]+"\" class=\"J_provider\">"+result["name"]+"</span>");
            }
            $.nmTop().close();
        },'json');
    };

    function validateProvider(actionItem){
        var buttonAvailable = true;
        $(".J_createProvider").each(function(index, value){
            if($(value).val().length == 0){
                buttonAvailable = false;
                return false;
            }
        });

        if(buttonAvailable){
            $("#J_submitProvider").removeAttr("disabled");
        }
    }
}
