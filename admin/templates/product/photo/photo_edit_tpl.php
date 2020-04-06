<?php
	$kichthuoc="";
	$name_photo="";
	if($_REQUEST['type']=='quangcao')
	{
		$kichthuoc="Width: 200px - Height: 200px";
		$name_photo="Hình ảnh quảng cáo";
	}

?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=product&act=man_photo&type=<?=$_REQUEST['type']?>&idc=<?=$_REQUEST['idc']?>"><span><?=$name_photo?></span></a></li>
           	<li class="current"><a href="#" onclick="return false;">Sửa <?=$name_photo?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>

<form name="supplier" id="validate" class="form" action="index.php?com=product&type=<?=$_REQUEST['type']?>&act=save_photo&id=<?=$_REQUEST['id'];?>&idc=<?=$_REQUEST['idc']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa <?=$name_photo?></h6>
		</div>		
		<div class="formRow">
			<label>Tên VI</label>
			<div class="formRight">
                <input type="text" name="ten_vi" title="Nhập tên VI hình ảnh" id="ten_vi"  value="<?=@$item['ten_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        

        		        
        <div class="formRow">
            <label>Link : </label>
            <div class="formRight">
                <input type="text" id="links" name="links" value="<?=@$item['links']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
       
            </div>
            <div class="clear"></div>
        </div>              
		
        <div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
               <div class="mt10">
               
               
               <img src="<?=_upload_product.$item['photo']?>" style="max-width:100px;" />
               
               </div>
            	<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải File ảnh (JPEG, GIF , JPG , PNG)"><?=$kichthuoc?>
			</div>
			<div class="clear"></div>
  	
		</div>
        
        
        
        
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
			
	<div class="formRow">
			<div class="formRight">



		<input type="hidden" name="id" value="<?=$item['id']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=product&type=<?=$_REQUEST['type']?>&act=man_photo&idc=<?=$_REQUEST['idc']?>'" class="blueB" />
                
                
             
                
			</div>
			<div class="clear"></div>
		</div>     
		
	</div>
   
</form>   