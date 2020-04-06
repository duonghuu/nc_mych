
<script language="javascript">				
	function select_onchange1()
	{				
		var a=document.getElementById("id_list");
		window.location ="index.php?com=city&act=<?php if($_REQUEST['act']=='edit_item') echo 'edit_item'; else echo 'add_item';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_list="+a.value;	
		return true;
	}

	
</script>
<?php
function get_main_list()
	{
		$sql="select ten_vi,id from table_city_list  order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_font">
			<option value="">Danh mục cấp 1</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_list'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	function get_main_cat()
	{
		$sql="select ten_vi,id from table_city_cat  where id_list='".$_REQUEST['id_list']."' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat"  class="main_font">
			<option value="">Danh mục cấp 2</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_cat'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=city&act=man_item"><span>Thêm Phường(Xã)</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=city&act=save_item" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
		
        
        <div class="formRow">
			<label>Danh mục cấp 1</label>
			<div class="formRight">
            	<div class="selector">
				<?=get_main_list();?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Danh mục cấp 2</label>
			<div class="formRight">
            	<div class="selector">
				<?=get_main_cat();?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
        
        
        <div class="tab_gaconit">      
        
    <div id="tabs_container">
    	
        <ul id="tabs">
            <li class="active"><a href="#tab1">Tiếng Việt</a></li>
            <li><a href="#tab2">Tiếng Anh</a></li>
         
        </ul><!--tabs-->
	</div><!--tabs_container-->
    
    
    <div id="tabs_content_container">
      
        <div id="tab1" class="tab_content" style="display:block">

         <div class="formRow">
			<label>Tiêu đề VI</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_vi']?>" name="ten_vi" title="Nội dung tiêu đề VI" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
        

        </div><!--tab_content-->
      
        <div id="tab2" class="tab_content">


			
              
       <div class="formRow">
			<label>Tiêu đề EN</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_en']?>" name="ten_en" title="Nội dung tiêu đề EN" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
       
        
        

        </div><!--tab_content-->
     
    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
          
		     
        
		
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
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
     
		<div class="formRow">
			<div class="formRight">
            
  
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=city&act=man_item'" class="blueB" /> 
                
          

			</div>
			<div class="clear"></div>
		</div>
		
		
	</div>  
	
</form>



</div><!--end wrapper-->

