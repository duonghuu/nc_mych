<?php
	if($_GET['idl']!=''){

		$id_danhmuc = $_GET['idl'];
		$danhmuc = 'idl';
	}
	if($_GET['idc']!=''){

		$id_danhmuc = $_GET['idc'];
		$danhmuc = 'idc';
	}
	if($_GET['idi']!=''){
		$id_danhmuc = $_GET['idi'];
		$danhmuc = 'idi';
	}
	if($_GET['com']=='tag-tu-khoa'){
		$type_tag ="tags";
		if($id!=''){
			$tags = $_GET['id'];
		}else{
			$tags = $_GET['tags'];
		}
	}
	
?>
<script type="text/javascript">
	$(document).ready(function($) {
			$('.sl_sapxep').change(function(event) {
			$('.input_sort').val($(this).val());
			$('#form_sort').submit();
		});
	});
</script>
<form action="index.php" id="form_sort" method="GET">
	<input type="hidden" value="<?=$com?>" name="com">
	<input type="hidden" value="<?=$id_danhmuc?>" name="<?=$danhmuc?>">
	<input type="hidden" value="<?=$tags?>" name="<?=$type_tag?>">
	<?php if($com=='tim-kiem'){?>
		<input type="hidden" value="<?=$_GET['keywords']?>" name="keywords">
	<?php } ?>
	<input type="hidden" value="<?=$_GET['sort']?>" name="sort" class="input_sort">
	
</form>
<div class="bg_loc">
	  <span>Sắp xếp theo</span>
	  <select name="sapxep" class="sl_sapxep">
	      <option value="price_ASC" <?php if($_GET['sort']=='price_ASC'){echo "selected='selected'";}?>>Giá tăng dần</option>
	      <option value="price_DESC" <?php if($_GET['sort']=='price_DESC'){echo "selected='selected'";}?>>Giá giảm dần</option>
	  </select>
</div>
