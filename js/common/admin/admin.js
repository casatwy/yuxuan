$(document).ready(function(){
    admin = new Admin($("#J_baseUrl").val());
    admin.init();
});
function Admin(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
       $('.J_update').nyroModal({
           closeOnEscapse:false,
           closeOnClick:false
       });

       $('#J_usersubmit').live('click', function(){
           if(register()){
               submitUserData();
           }
       }); 

       $('#J_providersubmit').live('click',function(){
           if(isblank()){
               submitProviderData();
           }
       });

       $('#J_typesubmit').live('click',function(){
            if(isblank){
                submitTypeData(); 
            }
       });
    }

    function isblank(){
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
       return result;
    }

    function register(){
       var result = isblank();
       if($('#J_pwd1').val() != $('#J_pwd2').val()){
           $.jGrowl("两次密码输入不同！", {
               header:"提示",
               life:2000
           });
           result = false;
       }
       return result;
    }

    function submitUserData(){
       var data = admin.getUserData();
       var type = $('#J_type').val();
       if(type == 'add'){
            var appendUrl = '/ajaxAdmin/saveUser';
       }else if(type == 'update'){
            var appendUrl = '/ajaxAdmin/updateUser';  
            data['id'] = $('#J_userId').val();
       }
       $.post(baseUrl+appendUrl, {data:data},function(result){
           if(result['success'] == '1'){
                window.location.href = baseUrl+'/admin/users';
           }else{
                $.jGrowl("保存失败，用户已存在。", {header:"反馈"});
           }
       },'json');
    }

    function submitProviderData(){
        var data = admin.getProviderData();
        $.post(baseUrl+'/ajaxAdmin/updateProvider', {data:data}, function(result){
           if(result['success'] == '1'){
                window.location.href = baseUrl+'/admin/clients';
           }else{
                $.jGrowl("保存失败", {header:"反馈"});
           }
        },'json');
    }

    function submitTypeData(){
        var data = admin.getTypeData();
        if($('#J_kind').val() == 'add'){
            var appendUrl = '/ajaxAdmin/saveType';
        }else if($('#J_kind').val() == 'update'){
            var appendUrl = '/ajaxAdmin/updateType';
            data['id'] = $('#J_typeId').val();
        }
        $.post(baseUrl+appendUrl, {data:data}, function(result){
           if(result['success'] == '1'){
                window.location.href = baseUrl+'/admin/types';
           }else{
                $.jGrowl("保存失败，名称已存在。", {header:"反馈"});
           }
        },'json');
    }

    this.getUserData = function(){
       var data = {
            name : $('#J_name').val(),
            pwd : $('#J_pwd1').val(),
            tel : $('#J_tel').val()
       } 
       return data;
    }

    this.getProviderData = function(){
        var data = {
            id : $('#J_providerId').val(),
            name : $('#J_providerName').val(),
            address : $('#J_providerLocation').val(),
        }
        return data;
    }

    this.getTypeData = function(){
        var data = {
            name : $('#J_typeName').val(),
        }
        return data;
    }
}
