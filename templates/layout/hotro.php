<?php
	$d->reset();
	$sql = "select * from #_yahoo where hienthi=1 order by stt,id desc ";
	$d->query($sql);
	$yahoo = $d->result_array();
?>
<script>
    $(document).ready(function(){
		$('.hotro_right').hover(function(){
					$('.hotro_right .noidung_20').slideDown(800);
			},function(){
					$('.hotro_right .noidung_20').slideUp(800);
		}); 
	}); 	
</script>
<div class="hotro_right">
	<div id="img">
    	<div class="hotline_r">0932.100.277 - 0932.189.918</div>
    </div>
    <div style="display: none;" class="noidung_20">
    	<table style="width: 100%">
			<tbody>
			<?php for($i=0;$i<count($yahoo);$i++){?>
			<tr>
                <th><p class="rmp fw-bold fs-12"><?=$yahoo[$i]['ten']?></p></th>
                <th><p class="red"><?=$yahoo[$i]['dienthoai']?></p></th>
                <td><p class="rmp"><a href="skype:<?=$yahoo[$i]['skype']?>?chat"><img src="images/skype-icon.png"></a></p> </td>
            </tr>
            <?php } ?>
            

		</tbody></table>
    </div>
</div>