$(document).ready(function(){
    $('.form-ajax').submit(function(e){
        e.preventDefault();
        var index=layer.load();
        $.ajax({
            url : $(this).attr('action'),
            type : 'POST',
            data: $(this).serialize(),
            success : function(result){
                layer.close(index);
                if(result.status=='0' || result.status=='1'){
                    if(typeof(result['data'])=='string'){
                        layer.alert(result['data']);
                    }else{
                        layer.alert(result['data'][0],{'time': 1000*parseInt(result['data'][2])},function(){
                            if(typeof(result['data'][1])!='undefined' && result['data'][1]){
                                window.location.href = result['data'][1];
                            }
                        });
                    }
                    return ;
                }

                layer.alert(result);
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                layer.close(index);
                layer.alert('数据返回错误。'+errorThrown);
            }
        });
    });

    $('.selectAllCheckbox').click(function(){
        if($(this).prop('checked')){
            $('.checkbox').prop('checked',true);
        } else {
            $('.checkbox').prop('checked',false);
        }
    });

    $('.ajax-delete').click(function(){
        var url=$(this).attr('data-url');
        var id=$(this).attr('data-id');
        layer.confirm('是否要执行此操作？',function(index){
            $.get(url,function(data){
                layer.close(index);
                if(data.status=='0'){
                    layer.alert(data['data']);
                } else {
                    $('#tr'+id).fadeOut();
                }
        },'json');
        });
    });
    $('.addbtn').click(function(){
        location.href=$(this).attr('data-url');
    });
    $('.flushbtn').click(function(){
        window.location.reload();
    });
    $('.delbtn').click(function(){
        var url=$(this).attr('data-url');
        var id=$.commonjs.getCheckedID('.ajax-form');
        if(id==''){
            layer.alert('请选择要删除的数据。');
            return false;
        }
        layer.confirm('是否要执行此操作？',function(index){
            $.post(url,{'id':id,'times':Math.random()},function(data){
                layer.close(index);
                if(data.status=='0'){
                    layer.alert(data['data']);
                } else {
                    var listn=id.split(',');
                    for(var l in listn){
                        $('#tr'+listn[l]).fadeOut();
                    }
                }
        },'json');
        });
    });
    $('#verifyImg').on('click',function(){
        //重载验证码
        var timenow = new Date().getTime();
        var src = $(this).attr('src')+'?time='+timenow;
        $('#verifyImg').attr('src',src);
        $("#verifyCode").val("");
    });
    $.commonjs={
        getCheckedID:function(obj){
            var str='';
            $(obj).find('.thisid').each(function(i){
                if($(this).attr('checked')=='checked')
                    str+=','+$(this).val();
            });
            return str.substr(1);
        }
    }
});