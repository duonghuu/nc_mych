<?php
    $d->reset();
	$sql_quangcaol = "select tenkhongdau,id,thumb,ten_$lang,mota_$lang from #_baiviet where hienthi=1 and type='hocvien' order by stt,id desc";
	$d->query($sql_quangcaol);
	$hocvien = $d->result_array();
?>
<script src="js/hiei.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
marqueeInit({
	uniqueid: 'mycrawler2',
	style: {
		'width': '1200px',
		'height': '100px'
	},
	inc: 2,
	mouse: 'cursor driven',
	moveatleast:1,
	neutral: 150,
	savedirection: true,
	random: true
});
</script>

<div id="java_km">
<div class="marquee" id="mycrawler2">
           <?php for($i=0,$count_km=count($hocvien);$i<$count_km;$i++){?>
           <a href="hoc-vien/<?=$hocvien[$i]['id']?>/<?=$hocvien[$i]['tenkhongdau']?>.html" target="_blank"><img src="<?=_upload_baiviet_l.$hocvien[$i]['thumb']?>" height="90" border="0" alt=""/></a>
           <?php }?>
           </div>
</div>
<script type="text/javascript">
marqueeInit({
	uniqueid: 'mycrawler2',
	style: {
		'width': '1000px',
		'height': '110px',
		'margin-left': '0px'
	},
	inc: 2,
	mouse: 'cursor driven',
	moveatleast:3,
	neutral: 150,
	savedirection: true,
	random: true
});
</script>
