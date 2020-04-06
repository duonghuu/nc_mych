<script src="js/full_width/skdslider.js"></script>
<link href="js/full_width/skdslider.css" rel="stylesheet">
<script type="text/javascript">
	$(document).ready(function(){
		$('#demo3').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
	});
</script>
<?php  
	$d->reset();
	$sql= "select * from #_photo where hienthi=1 and com='slider' order by stt,id desc ";
	$d->query($sql);
	$slide_show = $d->result_array();
?>

<div class="skdslider">
    <ul id="demo3" class="slides">
   <?php for($i=0;$i<count($slide_show);$i++){?>
        <li><A href="<?=$slide_show[$i]['link']?>"><img src="<?=_upload_hinhanh_l.$slide_show[$i]['photo_vi']?>" alt="slide image" /></A></li>
    <?php } ?>    
    </ul>
</div>

