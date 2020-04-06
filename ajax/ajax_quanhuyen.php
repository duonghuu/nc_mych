<?php
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];


	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	$d = new database($config['database']);	

	$id_tinh=$_POST['id_tinh'];

	$d->reset();
    $result_quan= "select name,id,loai from #_district where provinceid='".$id_tinh."' order by id desc";
    $d->query($result_quan);
    $result_quan = $d->result_array();

?>

<td>Quận/Huyện<span>*</span></td>
<td>
	<?php 
		$d->reset();
	    $result_tinh= "select name,id,loai from #_province order by id desc";
	    $d->query($result_tinh);
	    $result_tinh = $d->result_array();
	?>
	<select name="quanhuyen" id="quanhuyen">
    	<option value="">--Chọn Quận/Huyện--</option>
    	<?php for($i=0;$i<count($result_quan);$i++) { ?>
    	<option value="<?=$result_quan[$i]['id']?>" rel="<?=$result_quan[$i]['loai']?>"><?=$result_quan[$i]['name']?></option>
    	<?php } ?>
    </select>
</td>
<script type="text/javascript">
	$(document).ready(function(){
		$( "#quanhuyen" ).change(function(){
			var id_quanhuyen=$(this).val();
			var id_tinh="<?=$_POST['id_tinh']?>";
			var tinh_loai="<?=$_POST['tinh_loai']?>";
			var ptvc="<?=$_POST['ptvc']?>";
			var quanhuyen_loai=$("option:selected", this).attr("rel");
			$.ajax({
				type:"POST",
				url:"ajax/ajax_tinhship.php",
				data:"id_quanhuyen="+id_quanhuyen+"&id_tinh="+id_tinh+"&quanhuyen_loai="+quanhuyen_loai+"&tinh_loai="+tinh_loai+"&ptvc="+ptvc,
				success:function(re){
					$('.kqship').html(re);
				}
			});
		});	
		$( "input[name=ptvc]" ).on( "click", function() {
			var id_tinh="<?=$_POST['id_tinh']?>";
			var tinh_loai="<?=$_POST['tinh_loai']?>";
			var ptvc=$("input[name=ptvc]:checked").val();
			var id_quanhuyen=$("select[name=quanhuyen]").val();
			var quanhuyen_loai=$("select[name=quanhuyen] option:selected").attr("rel");
			$.ajax({
				type:"POST",
				url:"ajax/ajax_tinhship.php",
				data:"id_quanhuyen="+id_quanhuyen+"&id_tinh="+id_tinh+"&quanhuyen_loai="+quanhuyen_loai+"&tinh_loai="+tinh_loai+"&ptvc="+ptvc,
				success:function(re){
					$('.kqship').html(re);
				}
			});
		});
	})
</script>
