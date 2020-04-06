<?php
	$d->reset();
	$sql = "select noidung_$lang from #_company where type='footer' ";
	$d->query($sql);
	$footer = $d->fetch_array();

	$d->reset();
	$sql = "select thumb,link,ten_vi,photo_vi from #_photo where hienthi=1 and type='facebook' order by stt asc";
	$d->query($sql);
	$facebook = $d->result_array();
	
	$d->reset();
	$sql = "select id,type,ten_$lang,tenkhongdau from #_baiviet where hienthi=1 and type='gioithieu' and noibat<>0 order by stt asc";
	$d->query($sql);
	$result_about = $d->result_array();

	$d->reset();
	$sql = "select id,type,ten_$lang,tenkhongdau from #_baiviet where hienthi=1 and type='hotrokhachhang' and noibat<>0 order by stt asc";
	$d->query($sql);
	$result_hotro = $d->result_array();

	$d->reset();
	$sql = "select id,type,ten_$lang,photo_$lang,thumb from #_photo where hienthi=1 and type='top_footer' limit 0,1";
	$d->query($sql);
	$top_footer = $d->fetch_array();

    $d->reset();
    $sql="select id,thumb,photo,ten_$lang,noidung_$lang,tenkhongdau from table_baiviet where hienthi=1 and type='header' order by id,stt desc";
    $d->query($sql);
    $resutl_tf=$d->result_array();
	
?>
<footer id="wrap_footer" class="clearfix">
	<div class="noidung_ft clearfix">
		<div id="content_footer">
			<?=ampify($footer["noidung_vi"])?>
		</div>
		<div class="clear">
			<a class="title" href="/gioi-thieu.html" ><?=_gioithieu?></a>
		</div>
		
	</div>
	<div class="cont_copyright">
		<span>&copy; Copyright 2016  GIA DỤNG MY CHÂU, All Rights Reserved. Design by Nina.vn</span>
	</div>
</footer>