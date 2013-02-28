$(document).ready(function(){
    admin = new Admin($("#J_baseUrl").val());
    admin.init();
});
function Admin(baseUrl){
    this.init = function(){
        if($('#J_type').val() == 'addUser'){
            window.names = eval('('+$('#J_allUser').text()+')');
        }
        bindEvent();
    }

    function bindEvent(){
        $('.J_update').nyroModal({
            closeOnEscapse:false,
            closeOnClick:false
        });
        $('.J_deldate').live("click",function(){
            alert("删除");
        });

        $('#J_usersubmit').live('click', function(){
            if($('#J_type').val() == 'addUser'){
                var data = admin.getUserData();
                if(data){
                    submitUserData(data);
                }
            }else{
                if(register()){
                    var data = admin.getUpdateUserData();
                    submitUserData(data);
                }
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

        $('#J_addOneUser').live('click',function(){
            var html = $('#J_exOne').html();
            $('.J_content').append(html);
        });

        $('.J_deleUser').live('click',function(){
            if($('.J_content table').length == 1){
                $.jGrowl("至少要保留一行。", {header:"提示"});
            }else{
                $(this).closest('table').remove();
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
            return false;
        }
        return result;
    }

    function submitUserData(data){
        var type = $('#J_type').val();
        if(type == 'addUser'){
            var appendUrl = '/ajaxAdmin/saveUser';
        }else if(type == 'updateUser'){
            var appendUrl = '/ajaxAdmin/updateUser';  
        }
        $.post(baseUrl+appendUrl, {data:data},function(result){
            window.location.href = baseUrl+'/admin/users';
        },'json');
    }

    function submitProviderData(){
        var data = admin.getProviderData();
        $.post(baseUrl+'/ajaxAdmin/updateProvider', {data:data}, function(result){
            window.location.href = baseUrl+'/admin/clients';
        },'json');
    }

    function submitTypeData(){
        var data = admin.getTypeData();
        if($('#J_kind').val() == 'add'){
            var appendUrl = '/ajaxAdmin/saveType';
        }else if($('#J_kind').val() == 'update'){
            var appendUrl = '/ajaxAdmin/updateType';
            data['id'] = $('#J_userId').val();
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
        var result = isblank();
        var item = new Array(); 
        var tempName = new Array();
        var dbNames = window.names;
        var name,pwd1,pwd2,authority;
        $('.J_content table').each(function(index,value){
            index++ ;
            authority = 1;
            name = $(value).find('#J_name').val();
            pwd1 = $(value).find('#J_pwd1').val();
            pwd2 = $(value).find('#J_pwd2').val();
            if(isSet(tempName,name) < tempName.length){
                $.jGrowl("第"+index+"组用户名相同！", {
                    header:"提示",
                    life:2000
                });
                result = false;
                return false;
            }else{
                tempName.push(name);
            }

            if(isSet(dbNames,name) < dbNames.length){
                $.jGrowl("第"+index+"组用户名已存在！", {
                    header:"提示",
                    life:2000
                });
                result = false;
                return false;
            }

            if(pwd1 != pwd2){
                $.jGrowl("第"+index+"组两次密码输入不同！", {
                    header:"提示",
                    life:2000
                });
                result = false;
                return false;
            }

            $(value).find('.J_authority').each(function(i,v){
                if($(v).attr('checked') == 'checked'){
                    authority *= $(v).val();
                }
            });
            var data = {
                name : name,
                pwd : pwd1,
                tel : $(value).find('#J_tel').val(),
                authority : authority    
            } 
            item.push(data); 
        });
        if(result == false){
            return false; 
        }else{
            return item;
        }
    }

    this.getUpdateUserData = function(){
        var authority = 1;
        $('.J_authority').each(function(i,v){
            if($(v).attr('checked') == 'checked'){
                authority *= $(v).val();
            }
        });
        var data = {
            id : $('#J_userId').val(), 
            name : $('#J_name').val(),
            pwd : $('#J_pwd1').val(),
            tel : $('#J_tel').val(),
            authority : authority    
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

    function isSet(arr,name){
        var i = 0;
        for(i ; i<arr.length ; i++){
            if(arr[i] == name){
                break;
            }
        }
        return i;
    }
}
function updateAuthority(){
    var num = eval('('+$('#J_authoritys').text()+')');
    for(var i = 0;i<num.length;i++){
        $('.J_authority').each(function(index,value){
            if($(value).val() == num[i]){
                $(value).attr('checked','checked');
            }
        });
    }
}
