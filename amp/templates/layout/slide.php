<?php 
	$d->reset();
	$sql= "select a.id,a.photo,a.photo1,a.photo2,a.link,l.ten from #_photo as a, #_photo_lang as l where a.hienthi=1 and a.com='slider' and a.id=l.id_photo and l.lang='".$lang."' order by stt asc, id desc";
	$d->query($sql);
	$slide_main = $d->result_array();
?>
<amp-carousel width="750" height="400" layout="responsive" delay="3000" autoplay type="slides">
<?php foreach ($slide_main as $key => $value) {?>
<amp-img srcset="thumb/750x400/1/<?=_upload_hinhanh_l.$value['photo']?>" width="750" height="400" layout="responsive"></amp-img>
<?php }?>
</amp-carousel>

