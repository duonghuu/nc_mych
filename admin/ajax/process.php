<?php 
	session_start();
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$d = new database($config['database']);
	$id_daily=$_SESSION['login_admin']["id_daily"];
	
	
	if(isset($_POST['cmd'])){
		
		
		


		
		
		
		if($_POST['cmd']=='load_list'){
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_list from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_list"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_list"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
			$d->reset();
			$sql = "select id, ten_vi from #_product_list where hienthi=1 $where_daily order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			
		
			
			echo '<option value="0">Chọn danh mục cấp 1</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}

		else if($_POST['cmd']=='load_list_edit' and isset($_POST['id_list'])){
			$id_list=(int)$_POST['id_list'];
			
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_list from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_list"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_list"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
			
			
			$d->reset();
			$sql = "select id, ten_vi from #_product_list where hienthi=1 $where_daily order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 1</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_list) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
			
		}else if($_POST['cmd']=='load_cat' and isset($_POST['id_list'])){
			$id_list=(int)$_POST['id_list'];
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_cat from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_cat"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_cat"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
			
			
			$d->reset();
			$sql = "select id, ten_vi from #_product_cat where hienthi=1 $where_daily and id_list='$id_list' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 2</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_cat_edit' and isset($_POST['id_list']) and isset($_POST['id_cat'])){
			$id_list=(int)$_POST['id_list'];
			$id_cat=(int)$_POST['id_cat'];
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_item from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_item"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_item"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
			
			$d->reset();
			$sql = "select id, ten_vi from #_product_cat where hienthi=1 $where_daily and id_list='$id_list' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 2</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_cat) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_item_edit' and isset($_POST['id_list']) and isset($_POST['id_cat']) and isset($_POST['id_item'])){
			$id_list=(int)$_POST['id_list'];
			$id_cat=(int)$_POST['id_cat'];
			$id_item=(int)$_POST['id_item'];
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_item from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_item"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_item"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
			
			$d->reset();
			$sql = "select id, ten_vi from #_product_item where hienthi=1 $where_daily and id_cat='$id_cat' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 3</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
	<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_item) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php
				}
			}
		}else if($_POST['cmd']=='load_item' and isset($_POST['id_cat'])){
			$id_cat=(int)$_POST['id_cat'];
			
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_item from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_item"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_item"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
			$d->reset();
			$sql = "select id, ten_vi from #_product_item where hienthi=1 $where_daily and id_cat='$id_cat' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 3</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php
				}
				
			}
		}
		
		
		
		
		else if($_POST['cmd']=='load_sub_edit' and isset($_POST['id_list']) and isset($_POST['id_cat']) and isset($_POST['id_item']) and isset($_POST['id_sub']) ){
			$id_list=(int)$_POST['id_list'];
			$id_cat=(int)$_POST['id_cat'];
			$id_item=(int)$_POST['id_item'];
			$id_sub=(int)$_POST['id_sub'];
			$d->reset();
			$sql = "select id, ten_vi from #_product_sub where hienthi=1 and id_item='$id_item' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 4</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
	<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_sub) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php
				}
			}
		}else if($_POST['cmd']=='load_sub' and isset($_POST['id_item'])){
			$id_item=(int)$_POST['id_item'];
			$d->reset();
			$sql = "select id, ten_vi from #_product_sub where hienthi=1 and id_item='$id_item' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 4</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php
				}
				
			}
		}
		

		// Đại lý
		if($_POST['cmd']=='load_daily')
	
		{	
		
			if ($id_daily>0)
			{
				$where_daily .= " and id='".$id_daily."' ";
		
			}
		
		
		
			$d->reset();
			$sql = "select id, ten_vi from #_daily where hienthi=1 $where_daily order by ten_vi";
			$d->query($sql);
			$result=$d->result_array();
			if ($id_daily<=0)
			{
			echo '<option value="">Chọn Đại lý</option>';
			}
			if(!empty($result))
			{
				foreach($result as $result_item)
				{
		?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
	<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_daily_edit' and isset($_POST['id_daily'])){
			$id_daily=(int)$_POST['id_daily'];
			
			if ($id_daily>0)
			{
				$where_daily .= " and id='".$id_daily."' ";
		
			}
			
			$d->reset();
			$sql = "select id, ten_vi from #_daily where hienthi=1 $where_daily order by ten_vi";
			$d->query($sql);
			$result=$d->result_array();
			if ($id_daily<=0)
			{
			echo '<option value="">Chọn Đại lý</option>';
			}
			if(!empty($result)){
				foreach($result as $result_item){ ?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_daily) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
			<?php	
				}
			}
		}





		
	}else{
		echo 'error';
	}
	
?>