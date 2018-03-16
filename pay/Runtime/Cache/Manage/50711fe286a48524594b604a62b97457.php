<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
    <title>提示信息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="/Public/plugin/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script language=javascript src="/Public/plugin/layer/layer.js"></script>
</head>
<body>
<script language="JavaScript">
    var msg='<div style="margin:10px 20px;"><p><?php echo ($msg); ?></p><p>系统将在 <font color="#00a0ea" style="padding:0 5px" id="spanSeconds"><?php echo ($waitSecond); ?></font>秒后自动返回...</p></div>';
    var index = layer.open({
        title: '提示信息',
        content: msg,
        type:1,
        btn:['确定'],
        yes:function(index){
            location.href='<?php echo ($jumpUrl); ?>';
        }
    });
    
<!--
var seconds = <?php echo ($waitSecond); ?>;
var defaultUrl = "<?php echo ($jumpUrl); ?>";
var alertWindow='';
onload = function()
{
  if (defaultUrl == 'javascript:history.go(-1)' && window.history.length == 0)
  {
   // document.getElementById('redirectionMsg').innerHTML = '';
    return;
  }

    alertWindow=window.setInterval(redirection, 1000);
}
function redirection()
{
  if (seconds <= 0)
  {
    window.clearInterval(alertWindow);
    return;
  }
  seconds --;
  document.getElementById('spanSeconds').innerHTML = seconds;

  if (seconds == 0)
  {
    window.clearInterval(alertWindow);
    window.parent.location.href = defaultUrl;
  }
}
</script>
</body>
</html>