<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
        elements : "noidung,diemnoibat,dieukien",
		theme : "advanced",
		convert_urls : false,
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,imagemanager,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
height:"500px",
    width:"100%",
	remove_script_host : false,

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<h3>Quản lý sản phẩm</h3>
<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_list");
		window.location ="index.php?com=product&act=<?php if(@$_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if(@$_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_list="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_list");
		var b=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=<?php if(@$_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if(@$_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_list="+a.value+"&id_cat="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_list");
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_item");
		window.location ="index.php?com=product&act=<?php if(@$_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if(@$_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value;	
		return true;
	}
</script>

<script type="text/javascript">
	$(document).ready(function(e) {
		$("#btn_luu").click(function(e) {
			var loai=$("input[name='loai']:checked").length;
			if(loai==0){
				alert( "Bạn chưa chọn loại deal." );
				$("input[name='loai']").focus();
				return false;
			}
			/*var noiapdung=$("input[name='noiapdung[]']:checked").length;
			if(noiapdung==0){
				alert( "Bạn chưa chọn nơi áp dụng." );
				$("input[name='noiapdung[]']").focus();
				return false;
			}*/
		});
	});
</script>

<?php
function get_main_list()
	{
		$sql="select * from table_product_list order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" class="main_font">
			<option>Chọn danh mục cấp 1</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_main_cat()
	{
		$sql_huyen="select * from table_product_cat where id_list=".@$_REQUEST['id_list']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_cat" name="id_cat"" >
			<option>Chọn danh mục cấp 2</option>			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}	
	
function get_main_item()
	{
		$sql_huyen="select * from table_product_item where id_cat=".@$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" >
			<option>Chọn danh mục cấp 3</option>			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}			
	function get_main_khuvuc()
	{
		$sql="select * from table_product_khuvuc order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_khuvuc" name="id_khuvuc" class="main_font">
			<option>Chọn danh mục khu vực</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_khuvuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

?>
<form name="frm" method="post" action="index.php?com=product&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">	 
    <b>Danh mục cấp 1:</b><?=get_main_list();?><br /><br />
    <b>Khu vực:</b><?=get_main_khuvuc();?><br /><br />
	<!--<b>Danh mục cấp 2:</b><?=get_main_cat();?><br /><br />   	
    <b>Danh mục cấp 3:</b><?=get_main_item();?><br /><br />-->
	<?php if (@$_REQUEST['act']=='edit'){?>
	<b>Hình hiện tại:</b><img src="<?=_upload_product.$item['thumb']?>"  alt="NO PHOTO" /><br />
	<?php }?>
    
	<b>Hình ảnh:</b> <input type="file" name="file" /> Width:286px - Height: 286px <?=_product_type?><br /><br />
	<b>Tên</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /> 
    <!--<b>Mã</b> <input type="text" name="masp" value="<?=@$item['masp']?>" class="input" /><br /> -->   
    <b>Số người mua</b> <input type="text" name="damua" value="<?=@$item['damua']?>"  /><br />
    <b>Giá</b> <input type="text" name="gia" value="<?=@$item['gia']?>"  /><br />
    <b>Giá khuyến mãi</b> <input type="text" name="giakm" value="<?=@$item['giakm']?>"  /><br /> 
    <b>Phần trăm</b> <input type="text" name="phantram" value="<?=@$item['phantram']?>" /> %<br />
    <b>Loại</b> <input type="radio" name="loai" value="voucher" id="voucher"  <?php if($item['loai']=="voucher") echo'checked="checked"'; ?> /> <label for="voucher">Giao voucher</label> &nbsp; <input type="radio" name="loai" value="sanpham" id="sanpham" <?php if($item['loai']=="sanpham") echo'checked="checked"'; ?>/> <label for="sanpham">Giao sản phẩm</label><br /> <br />
    
   
    <b>Ngày kết thúc</b> <input id="date" type="text" name="thoigian" value="<?=($item['thoigian']!='')? date("Y-m-d H:i:s",$item['thoigian']):''?>" class="input" /><br /> 
    
    
	<script>
       var logic = function( currentDateTime ){
		if( currentDateTime.getDay()==6 ){
			this.setOptions({
				//minTime:'11:00'
			});
		}else
			this.setOptions({
				//minTime:'8:00'
			});
	};
	$('#date').datetimepicker({
		onChangeDateTime:logic,
		onShow:logic,
		format:'Y-m-d H:i:s'
	});
    </script>
    
    <!--chon noi ap dung-->
    <!--<b style="color:red">CHỌN NƠI ÁP DỤNG</b><br /><br />
    <?php
    $noiapdung=explode(",",$item['noiapdung']);
	?>
    <input type="checkbox" name="noiapdung[]" value="hcm" id="hcm"  <?php if(in_array ("hcm", $noiapdung)) echo 'checked="checked"'; ?> /> <label for="hcm">Hồ Chí Minh</label> &nbsp; <input type="checkbox" name="noiapdung[]" value="hanoi" id="hanoi"  <?php if(in_array ("hanoi", $noiapdung)) echo 'checked="checked"'; ?>  /> <label for="hanoi">Hà Nội</label>&nbsp; <input type="checkbox" name="noiapdung[]" value="tinh" id="tinh"  <?php if(in_array ("tinh", $noiapdung)) echo 'checked="checked"'; ?>/> <label for="tinh">Các tỉnh thành khác</label><br /> <br />
    <!--chon noi ap dung--><br />
    
    
    
    <!--voucher-->
    <b style="color:red">DÀNH CHO VOUCHER</b><br /><br />
    <b>Địa điểm sử dụng</b> <input type="text" name="diadiem" value="<?=@$item['diadiem']?>" class="input" /><br /> 
    <b>Tọa độ bản đồ</b> <input type="text" name="toado" value="<?=@$item['toado']?>" class="input" /><br /> 
    <!--voucher--><br />
    
    
     <div id="tab-container-1">
        <ul id="tab-container-1-nav" class="tablayout">
          <li><a class="active" href="#tab1">Keyword</a></li>
          <li><a class="" href="#tab2">Mô tả</a></li>
          <li><a class="" href="#tab3">Điểm nổi bật</a></li>
          <li><a class="" href="#tab4">Điều kiện</a></li>
          <li><a class="" href="#tab5">Thông tin chi tiết</a></li>
        </ul>
        <div class="tabs-container"><!--Start .tabs-container--> 
            <div class="tab" id="tab1"><!--Start Tab1-->
                  <b>Keyword</b><br/>
				  <div> <textarea name="keyword" id="keyword" cols="80" rows="5"><?=@$item['keyword']?></textarea></div>
                <div class="clear"></div>
            </div><!--End Tab1-->
            <div class="tab" id="tab2"><!--Start Tab2-->
                <div> <textarea name="mota" id="mota" cols="80" rows="5"><?=@$item['mota']?></textarea></div>
                <div class="clear"></div>
            </div><!--End Tab2-->
            <div class="tab" id="tab3"><!--Start Tab3-->
                <div><textarea name="diemnoibat" id="diemnoibat" cols="80" rows="5"><?=@$item['diemnoibat']?></textarea></div>
                <div class="clear"></div>
            </div><!--End Tab3-->
            <div class="tab" id="tab4"><!--Start Tab4-->
                <div> <textarea name="dieukien" id="dieukien" cols="80" rows="5"><?=@$item['dieukien']?></textarea></div>
                <div class="clear"></div>
            </div><!--End Tab4-->
            <div class="tab" id="tab5"><!--Start Tab5-->
                <div><textarea name="noidung" id="noidung"><?=@$item['noidung']?></textarea></div>
                <div class="clear"></div>
            </div><!--End Tab5-->
            
        </div><!--End .tabs-container--> 
    </div> 
    <script type="text/javascript">
        var tabber1 = new Yetii({
        id: 'tab-container-1',
        active: 1,
        timeout: null,
        interval: null,
        tabclass: 'tab',
        activeclass: 'active'
        });
    </script>
    
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>
	<b>Hiển thị tin</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br /><br />
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="hidden" name="linkduongdan" id="linkduongdan" value="<?=$_SERVER['HTTP_REFERER']?>" />
	<input type="submit" value="Lưu" class="btn" id="btn_luu"/>
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=product&act=man'" class="btn" />
</form>