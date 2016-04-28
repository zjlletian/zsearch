
//格式化当前时间
function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    return year + seperator1 + month + seperator1 + strDate + " " + date.getHours() + seperator2 + date.getMinutes() + seperator2 + date.getSeconds();
}

var box=$("#keyword");
var tip=$("#tip");

//提交前验证
$('#searchform').submit(function(){
    key=$.trim(box.val());
    if(key==''){
        location.href='/';
        return false;
    }
    else{
        box.val(key);
        localStorage.setItem(key,getNowFormatDate);
    }
});

//输入焦点进入
box.focus(function(){
    searchTip();
});

//用户输入
box.bind('input', function() {
    searchTip();
});

//搜索提示
function searchTip(){
    key=$.trim(box.val());
    tip.css('display','none');
    if(key!=''){
        $.get('/tip.php?k='+key,function(data){
            if(data.length>0){
                tip.css('display','');
                tip.html('');
                for(i=0;i<data.length;i++){
                    str="<a href=\"javascript:usrtip('"+data[i].keyword+"')\" class='tiplink'><div class='tiplinkdiv'>"+key+" <strong>"+data[i].keyword.replace(key,'')+"</strong></div></a>";
                    tip.append(str);
                }
            }
            binghover();
        });
    }
}

//使用搜索提示
function usrtip(key){
    box.val(key);
    $('#searchform').submit();
}

//监视鼠标是否在tiplink上
var tiphovered=false;
function binghover(){
    $('.tiplink').hover(
        function(){
            tiphovered=true;
        },
        function(){
            tiphovered=false;
        }
    );
}

//鼠标离开
box.blur(function(){
    if(!tiphovered){
        tip.css('display','none');
    }
});
