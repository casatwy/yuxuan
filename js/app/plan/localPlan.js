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
            events:baseUrl + "/ajaxPlan/getPlanEvents",
            header:{
                left:'prev title next',
                center:'',
                right:'today'
            },
            weekMode:'liquid',

            monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            monthNamesShort:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            dayNames:["周一","周二","周三","周四","周五","周六","周日"],
            dayNamesShort:["一","二","三","四","五","六","日"],

            dayClick:function(date, allDay, jsEvent, view){
                //date: Tue Jan 01 2013 00:00:00 GMT+0800 (CST)
                //allDay: true (boolean)
                //view: a big object
                clickOnDay();
            },
            eventClick:function(){
                clickOnEvent();
            }
        });

        function clickOnDay(){
            alert("day clicked");
        }

        function clickOnEvent(){
            alert("event clicked");
            return false;
        }
    }
}
