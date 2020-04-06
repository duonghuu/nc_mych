<script type="text/javascript">
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#xoahet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=product&act=delete&listid=" + listid;
});
});
</script>
<script type="text/javascript">
function doEnter(evt){
	// IE					// Netscape/Firefox/Opera
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
		onSearch(evt);
	}
}
function onSearch(evt) {	
		var keyword = document.getElementById("keyword").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=product&act=man&keyword="+keyword;
		loadPage(document.location);
			
}

</script>
<script language="javascript">
	function select_onchange()
	{
		var a=document.getElementById("id_list");
		window.location ="index.php?com=product&act=man&id_list="+a.value;	
		return true;
	}
	function select_onchange1()
	{
		var a=document.getElementById("id_list");
		var b=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=man&id_list="+a.value+"&id_cat="+b.value;	
		return true;
	}
	function select_onchange2()
	{
		var a=document.getElementById("id_list");
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_item");
		window.location ="index.php?com=product&act=man&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value;	
		return true;
	}
					
</script>
<?php
function get_main_list()
	{
		$sql="select ten,id from table_product_list  order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange()" class="main_font">
			<option value="">Danh mục cấp 1</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==@$_REQUEST['id_list'])
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
		$sql="select ten,id from table_product_cat  where id_list='".@$_REQUEST['id_list']."' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font">
			<option value="">Danh mục cấp 2</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_cat'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	function get_main_item()
	{
		$sql="select ten,id from table_product_item where id_cat='".@$_REQUEST['id_cat']."' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_item" name="id_item" onchange="select_onchange2()" class="main_font">
			<option value="">Danh mục cấp 3</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_item'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_main_khuvuc()
	{
		$sql="select ten,id from table_product_khuvuc  order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_khuvuc" name="id_khuvuc"  class="main_font">
			<option value="">Danh mục khu vực</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==@$_REQUEST['id_khuvuc'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>
<h3><a href="index.php?com=product&act=add">Thêm sản phẩm</a></h3>
Tìm kiếm: <input name="keyword" id="keyword" type="text" /> <input type="button" value=" Tìm "  onclick="onSearch(event)"/>
<table class="blue_table">
	<tr>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">Stt</th>		
        <th style="width:10%;"><?=get_main_list()?></th>
        <th style="width:10%;"><?=get_main_khuvuc()?></th>
       <!-- <th style="width:10%;"><?=get_main_cat()?></th>
      	 <th style="width:10%;"><?=get_main_item()?></th>-->
        <th style="width:20%;">Tên  </th>  
       <th style="width:10%;">Hình ảnh</th>  
       <th style="width:5%;">Tiêu biểu</th> 
       <th style="width:5%;">Nổi bật</th> 
		<th style="width:5%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
    	<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
		<td style="width:10%;">
			  <?php
				$sql_danhmuc="select ten from table_product_list where id='".$items[$i]['id_list']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']
			?>      
        </td>
        <td style="width:10%;">
			  <?php
				$sql_danhmuc="select ten from table_product_khuvuc where id='".$items[$i]['id_khuvuc']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']
			?>      
        </td>
        <!--<td style="width:10%;">
        	  <?php
				$sql_danhmuc="select ten from table_product_cat where id='".$items[$i]['id_cat']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']
			?>    
        </td>  
       <td style="width:10%;">
        	  <?php
				$sql_danhmuc="select ten from table_product_item where id='".$items[$i]['id_item']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']
			?>    
        </td> --> 
        <td style="width:20%;"><a href="index.php?com=product&act=edit&id_khuvuc=<?=$items[$i]['id_khuvuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?></a></td>                                 
        <td align="center" style="width:10%;">
         <a href="index.php?com=hasp&amp;act=man_photo&amp;idc=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>" style="text-decoration:underline;">
          Thêm ảnh</a>      
     	</td>
       <td align="center" style="width:5%;">
		  <?php if($items[$i]['spbc']>0) { ?>
            <a href="index.php?com=product&act=man&spbc=<?=$items[$i]['id']?><?php if(@$_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/yes-km.gif" border="0" /></a>
            <?php } else {?>
           <a href="index.php?com=product&act=man&spbc=<?=$items[$i]['id']?><?php if(@$_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/no-km.gif" border="0" /></a>
           <?php }?>     
        </td>
        <td align="center" style="width:5%;">
			<?php if($items[$i]['noibat']>0) { ?>
            <a href="index.php?com=product&act=man&noibat=<?=$items[$i]['id']?><?php if(@$_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/yes-km.gif" border="0" /></a>
            <?php } else { ?>
           <a href="index.php?com=product&act=man&noibat=<?=$items[$i]['id']?><?php if(@$_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/no-km.gif" border="0" /></a>
           <?php } ?>      
        </td>
        
		<td style="width:5%;">
			<?php  if(@$items[$i]['hienthi']==1) { ?>
            <a href="index.php?com=product&act=man&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
            <?  } else { ?>
             <a href="index.php?com=product&act=man&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
             <?php }?>      
        </td>
		<td style="width:5%;"><a href="index.php?com=product&act=edit&id_khuvuc=<?=$items[$i]['id_khuvuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/edit.png" /></a></td>
		<td style="width:5%;"><a href="index.php?com=product&act=delete&id_khuvuc=<?=$items[$i]['id_khuvuc']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" /></a></td>
	</tr>
	<?php	}?>
    </table>
<a href="index.php?com=product&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>
<div class="paging"><?=$paging['paging']?></div>