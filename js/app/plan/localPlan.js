$(document).ready(function(){
    var localPlan = new LocalPlan($("#J_baseUrl").val());
    localPlan.init();
});

function LocalPlan(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
        setCalendar();
    }

    function setCalendar(){
        $("#J_calendar").fullCalendar({
            editable:false,
            theme:true,
            header:{
                left:'前一天，下一天 今天',
                center:'标题',
                right:'月，周，日',
            },
            //events:"url to get events, data type is json",
            dayClick:function(){
                clickOnDay();
            },
        });

        function clickOnDay(){
            alert("day Clicked");
        }
    }
}
