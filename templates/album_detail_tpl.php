<div id="info">
<div id="sanpham">
    <div class="thanhsp"><h2><?=$album_detail[0]['ten_'.$lang]?></h2></div>
    <div class="khung">
		<div id="album">
    <?php for($i=0,$count_ab=count($album_images);$i<$count_ab;$i++){?>
    <a href="<?=_upload_album_l.$album_images[$i]['photo']?>" class="phongto">
        <img src="<?=_upload_album_l.$album_images[$i]['photo']?>" alt="<?=$album_detail[0]['ten_'.$lang]?>">
    </a>
    <?php } ?>
    </div>
            </div>
        </div>
</div>
     