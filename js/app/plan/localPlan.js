$(document).ready(function(){
    var localPlan = new LocalPlan($("#J_baseUrl").val());
    localPlan.init();
    var popupDiagram = new PopupDiagram($("#J_baseUrl").val());
    popupDiagram.init();
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
                left:'prev title next',
                center:'',
                right:'today'
            },
            weekMode:'variable',
            timeFormat:'yyyy-MM-dd HH:mm:ss',

            monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            monthNamesShort:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            dayNames:["周一","周二","周三","周四","周五","周六","周日"],
            dayNamesShort:["一","二","三","四","五","六","日"],

            //events:baseUrl + "/ajaxPlan/getPlanEvents",
            events:function(start,end,callback){
                getPlanEvents(start, end, callback);
            },
            
            dayClick:function(date, allDay, jsEvent, view){
                clickOnDay(date, allDay, jsEvent, view);
            },
            eventClick:function(event, jsEvent, view){
                clickOnEvent(event, jsEvent, view);
            }
        });

        function getPlanEvents(start, end, callback){
            $.post(baseUrl + "/ajaxPlan/getPlanEvents", {start:start, end:end}, function(doc){
                callback(doc);
            },'json');
        }

        function clickOnDay(date, allDay, jsEvent, view){
            //date: Tue Jan 01 2013 00:00:00 GMT+0800 (CST)
            //allDay: true (boolean)
            //view: a big object
            $(".J_event").hide();
            $.get(baseUrl+'/ajaxPlan/getDate',{date:date},function(result){
                showDayData(date, allDay, jsEvent, view, result);
            });
        }

        function showDayData(date, allDay, jsEvent, view, start){
            $.nmManual(baseUrl+"/ajaxPlan/getDayContent/start/"+start,{
                closeOnClick:true,
                closeOnEscape:true,
                showCloseButton:false,
                callbacks:{
                    beforeHideBg:function(){
                        $(".J_event").show();
                    },
                    afterShowCont:function(){
                        $("#J_dailyPlanTab").tabs();
                    },
                },
            });
            return false;
        }

        function clickOnEvent(event, jsevent, view){
            //view.title = time
            //$(".J_event").hide();
            //$.nmManual(baseUrl+"/ajaxplan/getPlanContent",{
            //    closeOnClick:true,
            //    closeOnEscape:true,
            //    showCloseButton:false,
            //    domCopy:true,
            //    callbacks:{
            //        afterHideBg:function(){
            //            $(".J_event").show();
            //        }
            //    },
            //});
            return true;
        }
    }
}

function PopupDiagram(baseUrl){
    this.init = function(){
        bindEvent();
    };

    function bindEvent(){
        /*
         *
         * in model Product's afterSave function will set it to finish automatically
         *
         * */
        //$(".J_Popup_finish").live("click", function(){
        //    alert();
        //});

        $(".J_Popup_checkRecord").live("click", function(){
            redirectToCheckRecord($(this));
        });

        $(".J_Popup_checkProduceHistory").live("click", function(){
            alert();
        });

        $(".J_Popup_saveAll").live("click", function(){
            alert();
        });
    }

    function redirectToCheckRecord(actionItem){
        location.href = baseUrl + "/storage/search/goodsNumber/"+actionItem.attr("data-goods-number") + "/type/" + actionItem.attr('data-type');
    }
}
