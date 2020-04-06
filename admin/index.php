<?php
	session_start();
	error_reporting(0);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	$lang = 'vi';

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."type.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = 'NINACO';	
	$d = new database($config['database']);	
	$archive = new PclZip($file);
	
	$id_daily=$_SESSION['logindaily']["id_daily"];
	
	if(isset($_SESSION['logindaily']['type']) && $_SESSION['logindaily']['type']=='daily' && !empty($_SESSION['logindaily']['id_daily'])){
		if($com=='' || $com=='index' || $com=='product' || $com=='city' || $com=='order'  || $com=='order_daily' || $com=='create_order_daily' || $com=='daily' || $com=='user_daily' ){
			
		}elseif($com == 'product'){
			$arr = array("man","man_list","man_cat", "add", "edit", "save", "delete", "man_image360", "add_image360", "save_image360",
						 "man_color", "add_color", "edit_color", "save_color", "delete_color",
						 "man_rating", "add_rating", "edit_rating", "save_rating", "delete_rating");
			if (in_array($act,$arr)) {
				
			}else{
				transfer("Bạn không có quyền truy cập vào đây","index.php");
				exit;
			}
		}elseif($com == 'user'){
			$arr = array("login","logout");
			if (in_array($act,$arr)) {
				
			}else{
				transfer("Bạn không có quyền truy cập vào đây","index.php");
				exit;
			}
		}else{
			transfer('Bạn không có quyền truy cập vào trang này','index.php');
		}
	}

	switch($com){
		
		
	case 'order_daily':
			$source = "order_daily";
			break;	
	case 'tags':
			$source = "tags";
			break;	
	case 'user_daily':
			$source = "user_daily";
			break;		
		
		case 'daily':
			$source = "daily";
			break;		
		
	case 'city':
			$source = "city";
			break;	
		
		case 'member':
			$source = "member";
			break;
		case 'order':
			$source = "order";
			break;
		case 'background':
			$source = "background";
			break;
		case 'album':
			$source = "album";
			break;
		case 'video':
			$source = "video";
			break;
		case 'contact':
			$source = "contact";
			break;
		case 'gia':
			$source = "gia";
			break;
		case 'post':
			$source = "post";
			break;
		case 'newsletter':
			$source = "newsletter";
			break;
		case 'phanquyen':
			$source = "phanquyen";
			break;
		case 'com':
			$source = "com";
			break;
		case 'donhang':
			$source = "donhang";
			break;
		case 'company':
			$source = "company";
			break;
		case 'baiviet':
			$source = "baiviet";
			break;
		case 'database':
			$source = "database";
			break;
		case 'backup':
			$source = "backup";
			break;		
		case 'info':
			$source = "info";
			break;
		case 'product':
			$source = "product";
			break;
		case 'user':
			$source = "user";
			break;		
		case 'lkweb':
			$source = "lkweb";
			break;		
		case 'photo':
			$source = "photo";
			break;														
		case 'setting':
			$source = "setting";
			break;										
		case 'yahoo':
			$source = "yahoo";
			break;
		case 'excel':
			$source = "excel";
			break;										
		case 'bannerqc':
			$source = "bannerqc";
			break;
		default: 
			$source = "";
			$template = "index";
			break;
	}
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	if($_SESSION['login']['role']==1 && $_GET['com']!='' && $_GET['act']!='logout' && $_GET['act']!='login'){
		
		if(phanquyen_tv($_GET['com'],$_SESSION['login']['quyen'],$_GET['act'],$_GET['type'])==0){
			$_SESSION['edit']['quyen'] = 'false';
			transfer("Bạn Không có quyền vào đây !","index.php");
		} else {
			$_SESSION['edit']['quyen'] = 'true';
		}
	}

	if($source!="") include _source.$source.".php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Hệ thống quản trị nội dung</title>
<?php /* <link href="css/main.css" rel="stylesheet" type="text/css" /> */?>
<link href="css/main_repon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/external.js"></script>
<script src="js/jquery.price_format.2.0.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js"></script>
<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<!-- MultiUpload -->
<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
<script src="js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="css/jquery.minicolors.css">
<link href="js/select-box-searching-jquery/select2.css" rel="stylesheet"/>
<script src="js/select-box-searching-jquery/select2.js"></script>
</head>
<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  
<body data-title="<?= $source."_"._template.$template ?>">
<!-- Left side content -->    
<script type="text/javascript">
$(function(){
	var num = $('#menu').children(this).length;
	for (var index=0; index<=num; index++)
	{
		var id = $('#menu').children().eq(index).attr('id');
		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
		$('#'+id+' .sub li:last-child').addClass('last');
	}
	$('#menu .activemenu .sub').css('display', 'block');
	$('#menu .activemenu a').removeClass('inactive');
	$('.conso').priceFormat({
		limit: 13,
		prefix: '',
		centsLimit: 0
	});
	
	$('.color').each( function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    format: $(this).attr('data-format') || 'hex',
                    keywords: $(this).attr('data-keywords') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(value, opacity) {
                        if( !value ) return;
                        if( opacity ) value += ', ' + opacity;
                        if( typeof console === 'object' ) {
                            console.log(value);
                        }
                    },
                    theme: 'bootstrap'
                });

            });

})
</script>
<style type="text/css">
<?php if($config['lang']=="vi"){?>
	.chonngonngu{
		display:none;
	}
<?php } ?>
</style>
<div id="leftSide">
<?php include _template."left_tpl.php";?>
</div>
<!-- Right side -->
    <div id="rightSide">
        <!-- Top fixed navigation -->
        <div class="topNav">
	        <?php include _template."header_tpl.php";?>
		</div>

<div class="wrapper">
<?php include _template.$template."_tpl.php";?>
</div></div>
    <div class="clear"></div>
</body>
<?php }else{?>
<body class="nobg loginPage">   
<?php include _template.$template."_tpl.php";?>
<!-- Footer line -->
<div id="footer">
	<div class="wrapper">Powered by <a href="http://www.nina.vn" title="Thiết kế web NINA">Thiết kế web NINA</a></div>
</div></body>
<?php }?>


<script type="text/javascript">
	$(document).ready(function() {
		//ckeditor
		$(".ck_editor").each(function(index, el) {
			CKEDITOR.replace( $(this).find("textarea").attr("id"), {
				height : 500,
				entities: false,
		        basicEntities: false,
		        entities_greek: false,
		        entities_latin: false,
				filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
				filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				allowedContent:
					'h1 h2 h3 p blockquote strong em;' +
					'a[!href];' +
					'img(left,right)[!src,alt,width,height];' +
					'table tr th td caption;' +
					'span{!font-family};' +
					'span{!color};' +
					'span(!marker);' +
					'del ins'
				});
		});
		//count char description
		if($("input[name='des_char']").length>0){
			$("input[name='des_char']").val($("textarea[name='description']").val().length);
			$("textarea[name='description']").keyup(function(event) {
				$length = $(this).val().length;
				$("input[name='des_char']").val($length);
				
			});
		}
		//
		/* ajax hienthi*/
		$("a.diamondToggle").click(function(){
			if($(this).attr("data-val3")=="id_tggiao"){
				if($(this).attr("rel")==0){
					$.ajax({
						type: "POST",
						url: "ajax/ajax_hienthi.php",
						data:{
							id: $(this).attr("data-val0"),
							bang: $(this).attr("data-val2"),
							type: $(this).attr("data-val3"),
							value:$(this).attr("data-val")
						}
					});
					$(this).addClass("diamondToggleOff");
					$(this).attr("rel",$(this).attr("data-val"));

				}else{

					$.ajax({
						type: "POST",
						url: "ajax/ajax_hienthi.php",
						data:{
							id: $(this).attr("data-val0"),
							bang: $(this).attr("data-val2"),
							type: $(this).attr("data-val3"),
							value:0
						}
					});
					$(this).removeClass("diamondToggleOff");
					$(this).attr("rel",0);
				}
			}else{
				if($(this).attr("rel")==0){
					$.ajax({
						type: "POST",
						url: "ajax/ajax_hienthi.php",
						data:{
							id: $(this).attr("data-val0"),
							bang: $(this).attr("data-val2"),
							type: $(this).attr("data-val3"),
							value:1
						}
					});
					$(this).addClass("diamondToggleOff");
					$(this).attr("rel",1);

				}else{

					$.ajax({
						type: "POST",
						url: "ajax/ajax_hienthi.php",
						data:{
							id: $(this).attr("data-val0"),
							bang: $(this).attr("data-val2"),
							type: $(this).attr("data-val3"),
							value:0
						}
					});
					$(this).removeClass("diamondToggleOff");
					$(this).attr("rel",0);
				}
			}

		});
		/*end  ajax hienthi*/
		/*select danhmuc*/
		$(".select_danhmuc").change(function() {
			var child = $(this).data("child");
			var levell = $(this).data('level');
			var table = $(this).data('table');
			var type = $(this).data('type');
			$.ajax({
				url: 'ajax/ajax_danhmuc.php',
				type: 'POST',
				data: {level: levell,id:$(this).val(),table:table,type:type},
				success:function(data){
					var op = "<option>Chọn Danh Mục</option>";

					if(levell=='0'){
						$("#id_cat").html(op);
						$("#id_item").html(op);
						$("#id_sub").html(op);
					}else if(levell=='1'){
						$("#id_sub").html(op);
						$("#id_item").html(op);
					}else if(levell=='2'){
						$("#id_sub").html(op);
					}
					$("#"+child).html(data);
				}
			});
		});
	});
</script>


</html>
