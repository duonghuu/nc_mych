<script type="text/javascript">

	$(document).ready(function() {
							   
	$("#chonhet").click(function(){
		var status=this.checked;
		$("input[name='chon']").each(function(){this.checked=status;})
	});
	
	$("#send").click(function(){
		var listid="";
		$("input[name='chon']").each(function(){
			if (this.checked) listid = listid+","+this.value;
			})
		listid=listid.substr(1);	 //alert(listid);
		if (listid=="") { alert("Bạn chưa chọn email nào"); return false;}
		hoi= confirm("Xác nhận muốn gửi thư đi?");
		if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
	});
	});
	
	
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
		{
			location.href = l;	
		}
	}	
	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.frm.action = str;
			document.frm.submit();
		}
	}	
	
</script>
<script type="text/javascript">
function doEnter(evt){
	// IE					// Netscape/Firefox/Opera
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
		onSearch(evt);
	}
}
function onSearch(evt)
{	
		var keyword = document.getElementById("keyword").value;	
		location.href = "index.php?com=user_daily&act=man&keyword="+keyword
		loadPage(document.location);
}


function select_onchange_member()
	{
		var a=document.getElementById("active_user");
		window.location ="index.php?com=user_daily&act=man&active_user="+a.value+"&curPage=<?=$_REQUEST['curPage']?>";	
		return true;
	}


</script>

<?php
function get_main_list()
	{
		$sql="select hoten,id from table_user";
		$stmt=mysql_query($sql);
		$str='
			<select id="active_user" name="active_user" onchange="select_onchange()" class="main_font">
			<option value="">---Chọn danh mục---</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['active_user'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}


?>


<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=user_daily&act=man"><span>Quản lý user đại lý</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="frm" id="f" action="index.php?com=user_daily&act=send"  method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=user_daily&act=add'" />
    <!-- <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=user_daily&act=man&multi=show');return false;" />
     <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=user_daily&act=man&multi=hide');return false;" /> -->
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=user_daily&act=man&multi=del');return false;"  />
        

        
    </div> 
     
     
     <div style="float:right;">
        <div class="selector">
        
        
        
<!-- <select name="active_user" id="active_user" onchange="select_onchange_member()">
<option value="" <?php if ($_GET["active_user"]=="") {?> selected="selected" <?php }?>>Tất cả</option>
<option value="0" <?php if ($_GET["active_user"]=="0") {?> selected="selected" <?php }?>>Chưa kích hoạt</option>
<option value="1" <?php if ($_GET["active_user"]=="1") {?> selected="selected" <?php }?> >Đã kích hoạt</option>
</select> -->
        
<!-- Tìm kiếm: <input name="keyword" id="keyword" type="text" value="<?=@$_REQUEST['keyword']?>" onkeypress="doEnter(event,'keyword');"/>  -->


        


<!-- <input type="button" value=" Tìm "  onclick="onSearch(event)"  /> -->


			

        </div>  
    </div>
     
  	
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox"  name="chonhet" id="chonhet"  />
    </span>
    <h6>Danh sách  hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="sortCol" width="40%"><div>Đại Lý<span></span></div></td>    
        <td class="sortCol" width="40%"><div>Tên đăng nhập<span></span></div></td>     
        <!-- <td width="40%">Mật khẩu</td> -->
      
        <td width="10%">Thao tác</td>
      </tr>
    </thead>
    
      
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon[]" id="chon" value="<?=$items[$i]['id']?>" class="chonxoa" />
        </td>
       
        <td>
            <?php
				$sql_danhmuc="select ten_vi from table_daily where id='".$items[$i]['id_daily']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>      
        </td>
      
        <td class="title_name_data">
         <a href="index.php?com=user_daily&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['username']?></a>
        </td>
        
        
        
        <!-- <td>
         <a href="index.php?com=user_daily&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['matkhau']?></a>
        </td> -->


        
        <td class="actBtns">
      <a href="index.php?com=user_daily&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=user_daily&act=delete&id=<?=$items[$i]['id']?>" onclick="CheckDelete('index.php?com=user_daily&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>
</form>





<script type="text/javascript">		
	function TreeFilterChanged_other(){		
				$('#validate').submit();		
	}	
</script>

  <?php
				$sql_danhmuc="select * from table_info where com='user_daily' ";
				$result=mysql_query($sql_danhmuc);
				$about_user_daily =mysql_fetch_array($result);
				
			?>      
<?php /*?><form name="supplier" id="validate" class="form" action="index.php?com=user_daily&act=save_info" method="post" enctype="multipart/form-data">

<div class="widget">

 <div class="formRow">
			<label>Mô tả VI:</label>
               <div class="clear"></div>
			<div class="formRight-full">
				<textarea rows="8" cols="" title="Viết mô tả ngắn sản phẩm" class="tipS validate[required]" name="mota_vi" id="short"><?=@$about_user_daily['mota_vi']?></textarea>
                
                
                
                <script type="text/javascript">//<![CDATA[
            window.CKEDITOR_BASEPATH='ckeditor/';
            //]]></script>
            <script type="text/javascript" src="ckeditor/ckeditor.js?t=B5GJ5GG"></script>
            <script type="text/javascript">//<![CDATA[
            CKEDITOR.replace('mota_vi', {"width":900,"height":300,});
            //]]></script>
                
			</div>
			<div class="clear"></div>
		</div><!--end formRow-->
        
        
        <div class="formRow">
			<div class="formRight">
                <input type="hidden" name="id_cat" id="id_this_product" value="<?=@$item_type['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged_other(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>

	</div>

</form><?php */?>



