/**
 * Created by Administrator on 2017/7/29.
 */
function Ajax(url,data,fnSucc,fnFaild) {
    //alert(url);
    //1.创建ajax对象
    if(window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        var oAjax=new XMLHttpRequest();
    }else{// code for IE6, IE5
        var oAjax=new ActiveXObject("Microsoft.XMLHTTP");
    }

    //2.链接服务器（打开服务器的连接）
    //open(方法，文件名，异步传输)
    // oAjax.open('GET',url,true);
    oAjax.open('POST',url,true);
    oAjax.setRequestHeader("Content-type","application/x-www-form-urlencoded");//用post必須加上這一句，並且要放到open()方法下面
    //3.发送
    oAjax.send(data);
    //4.接收返回
    oAjax.onreadystatechange=function() {
//                alert(oAjax.readyState);
        if (oAjax.readyState==4) {
            //alert(oAjax.status);
            if(oAjax.status==200) {
                //alert(oAjax.responseText);
                fnSucc(oAjax.responseText);
            }else{
                fnFaild(oAjax.status);
            }
        };
    };
}
