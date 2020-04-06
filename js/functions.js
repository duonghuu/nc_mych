// JavaScript Document
var i = 0; var j=0;
$(document).ready(function() {
	// For menu over
	$("#mainmenu > li").bind("mouseenter mouseleave", function(e){
		   $(this).toggleClass("over");														   
	});
	
	$("#mainmenu > li > ul > li").bind("mouseenter mouseleave", function(e){
		$(this).toggleClass("over");
	});
	
	$(".logo-link").click(function(){
		window.location='http://thietkewebstar.com';							   
	});
	
	$('#mainmenu > li').bind('mouseenter', jsddm_open);
	$('#mainmenu > li').bind('mouseleave',  jsddm_timer);
	
	$("#mainmenu > li > ul").css('opacity','0.93');
	
	 /*  For dropdown menu */
	var timeout    = 500;
	var closetimer = 0;
	var ddmenuitem = 0;
	
	function jsddm_open(){  
	   jsddm_canceltimer();
	   jsddm_close();
	   ddmenuitem = $(this).find('ul').slideDown(500);
	}
	function jsddm_close(){  
		if(ddmenuitem) 
			ddmenuitem.hide(50);
	}
	function jsddm_timer(){  
		closetimer = window.setTimeout(jsddm_close, timeout);
	}
	function jsddm_canceltimer(){
		if(closetimer){  
			window.clearTimeout(closetimer);
			closetimer = null;
		}
	}
	document.onclick = jsddm_close;
	
	// For slice intro
	$("#intro > div").each(function(){
		j++;
	});
	if(j>0){
		show(i);
	}
	
	$("#checkdomain").click(function(){
        $("#loading").hide(100);
		if(document.formdangky.domain.value==''){
			alert("Vui lòng nhập tên miền cần kiểm tra");
			document.formdangky.tenmien.focus();
			return;
		}
		if(document.formdangky.domain.value.indexOf(".")==-1){
			alert("Vui lòng nhập đúng tên miền cần kiểm tra");
			document.formdangky.tenmien.focus();
			return;
		}
		$.ajax({
		  url: '../index.php?choose=domainresult&domain='+document.formdangky.tenmien.value,
		  beforeSend: function(){
			$("#loading").show(500);
		  },
		  success: function(data) {
			$("#loading").hide(100);
			$('#status').html(data);
			$('#status').slideDown(900);
		  }
		});
	});
	
});

// For slice intro
function show(k){
	$("#intro > div").each(function(){
		$(this).hide(30);
	});
	
	var str = '';
	var num = Math.floor(Math.random()*11);
	
	if(num%2==0)
		str="show(600)";
	else
		str="fadeIn(1500)";
		
	eval('$("#_"+i).'+str+';');
	if(i==j-1)	i=0; else i++;

	setTimeout('show('+i+')',8000);
}

//For check or uncheck domain
function check(){	
	if($("#checkall").is(':checked')){
		for(var l=1;l<=24;l++)
			$("#dm"+l).attr("checked",true);	
	}else{
		for(var l=1;l<=24;l++)
			$("#dm"+l).attr("checked",false);	
	}
}

function checkform(){
	if(document.formdangky.domain.value==''){
		alert("Vui lòng nhập tên miền cần kiểm tra");
		return false;
	}
	for(var i=1;i<=24;i++){
		var j=false;
		if($("#dm"+i).attr("checked")==true){
			j=true;
			break;
		}
	}
	if(j==false){
		alert("Vui lòng chọn loại tên miền cần kiểm tra. Vd: .com,.net hay .vn");
		return false;
	}
	
	document.checkdomain.submit();
}

var message= 'Bản quyền thuộc về ngoinhaviet.org !';
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}}
function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}}}
if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}
document.oncontextmenu=new Function("alert(message);return false")


