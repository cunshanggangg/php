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

//獲取父節點的兄弟節點 start
function siblings(elm) {
    var r = [];
    var p = elm.parentNode.children;
    for(var i =0,pl= p.length;i<pl;i++) {
        if(p[i] !== elm) r.push(p[i]);
    }
    return r;
}
//獲取父節點的兄弟節點 end

//删除左右两端的空格 start
function trim(str){
    return str.replace(/(^\s*)|(\s*$)/g,"");
}
//删除左右两端的空格 end

//生成sql语句 start
function createSql(obj) {
//            alert(1231);
//            alert(obj);
//            var oNode = obj.parentNode.childNodes;//獲得子節點
//            var oNode = obj.parentNode.firstChild.nodeName;//結點的名稱:BUTTON
//            var oNode = obj.parentNode.firstChild.nodeType;//結點的類型：1：元素節點
//            var oNode = obj.parentNode.previousSibling.previousSibling.previousSibling.firstChild.value;
//            alert(oNode);
    var oNode = obj.parentNode;
    var oInput = siblings(oNode);
//            alert(oInput.length);
//            for(var i=0;i<rs.length;i++) {
//                rs[i].
//            }
//            alert(oInput[0].firstChild.value);
//            alert(oInput[3].firstChild.value);
//            alert(oInput[4].firstChild.value);
//            alert(oInput[5].firstChild.value);
//            alert(oInput[6].firstChild.value);
    //訂單編號
    var o_id = trim(oInput[0].firstChild.value);
    //省代碼
    var province_code = trim(oInput[3].firstChild.value);
    //市名稱
    var city_name = trim(oInput[4].firstChild.value);
    //市代碼
    var city_code = trim(oInput[5].firstChild.value);
    //區代碼
    var area_code = trim(oInput[6].firstChild.value);

    //組裝數劇
    var data2 = "o_id="+o_id+"&province_code="+province_code+"&city_name="+city_name+"&city_code="+city_code+"&area_code="+area_code;
//            alert(data2);
    Ajax("chkAddr.php",data2,
        function(str){
            var resSql = eval('('+str+')');
//                        alert(resSql);
            var oresSql = document.getElementById("resSql");
            oresSql.innerHTML = resSql[0]+"<br />"+resSql[1]+"<br />"+resSql[2];
        },
        function(){

        });
}
//生成sql语句 end