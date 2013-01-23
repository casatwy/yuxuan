$(document).ready(function(){
    var createDeliveredPlan = new CreateDeliveredPlan($("#J_baseUrl").val());
    createDeliveredPlan.init();
});

function CreateDeliveredPlan(baseUrl){
    this.init = function(){
        $("a[href='/plan/deliveredList']").closest("li").addClass("active");
        bindEvent();
    }

    function bindEvent(){

        $("#J_addRecord").bind("click", function(){
            addRecord($(this));
        });

        $(".J_deleteRecord").live("click", function(){
            deleteRecord($(this));
        });

        $("#J_saveRecord").bind("click", function(){
            saveRecord($(this));
        });
    }

    function saveRecord(actionItem){
        if(!inputAvailable()){
            return false;
        }
        var data = getPostData();
        console.log(data);
        $.post(baseUrl+"/ajaxPlan/saveDeliveredPlan", {data:data}, function(result){
            if(result['success'] == "1"){
                //$.jGrowl("保存成功！", {
                //    header:"反馈",
                //    life:2000,
                //    beforeOpen:function(){
                //        $("#J_container").html(result["content"]);
                //    }
                //});
                //window.open(baseUrl+"/plan/printPlan/id/"+result['id'],'_blank');
                window.location.href = baseUrl+"/plan/printPlan/id/"+result['id'];
            }else{
                $.jGrowl("保存失败，请检查数据。", {header:"反馈"});
            }
        }, 'json');
    }

    function inputAvailable(){
        var result = true;
        $(".J_content input").each(function(index, value){
            if($(value).val().length == 0){
                $.jGrowl("请填写空白处！", {
                    header:"提示",
                    life:2000
                });
                result = false;
                return false;
            }
        });

        if($("#J_selectProvider").attr("provider") === "none"){
            $.jGrowl("请选择客户！", {
                header:"提示",
                life:2000
            });
            result = false;
        }

		if(isNaN($('.J_colorNumber').val())){
            $.jGrowl("色号为数字！", {
                header:"提示",
                life:2000
            });
            result = false;
		}

		if(isNaN($('.J_goodsNumber').val())){
            $.jGrowl("货号为数字！", {
                header:"提示",
                life:2000
            });
            result = false;
		}

        return result;
    }

    function getPostData(){
        var data = new Array();
        $(".J_row").each(function(index, value){
            var item = {
                provider_id     :   $("#J_selectProvider").attr("provider"),
                goods_number    :   $(value).find(".J_goodsNumber").val(),
                color_number    :   $(value).find(".J_colorNumber").val(),
                color_name      :   $(value).find(".J_colorName").val(),
                needle_type     :   $(value).find(".J_needleType").val(),
                size            :   $(value).find(".J_size").val(),
                quantity        :   $(value).find(".J_quentity").val(),
            };
            data.push(item);
        });
        return data;
    }

    function deleteRecord(actionItem){
        if(parseInt($(".J_row").length) == 1){
            $.jGrowl("至少要保留一行。", {header:"提示"});
        }else{
            actionItem.closest(".J_row").remove();
        }
    }

    function addRecord(actionItem){
        var html = $(".J_row:last").html();
        $(".J_row:last").after("<div class=\"J_row\"></div>");
        $(".J_row:last").html(html);
    }
}
