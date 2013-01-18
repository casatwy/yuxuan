$(document).ready(function(){
    admin = new Admin($("#J_baseUrl").val());
    admin.init();
});
function Admin(baseUrl){
    this.init = function(){
        bindEvent();
    }

    function bindEvent(){
       $('#J_updateUser').nyroModal({
           closeOnEscapse:false,
           closeOnClick:false
       });

       $('#J_submit').live('click', function(){
           register();
           submitData();
       }); 
    }

    function register(){
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

       if($('#J_pwd1').val() != $('#J_pwd2').val()){
           $.jGrowl("两次密码输入不同！", {
               header:"提示",
               life:2000
           });
           result = false;
       }
       return result;
    }

    function submitData(){
       var data = admin.getData();
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

    this.getData = function(){
       var data = {
            name : $('#J_name').val(),
            pwd : $('#J_pwd1').val(),
            tel : $('#J_tel').val()
       } 
       return data;
    }
}
