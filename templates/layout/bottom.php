<?php
	$d->reset();
	$sql = "select ten_$lang,id,links from #_video where hienthi=1 order by stt,id desc ";
	$d->query($sql);
	$video = $d->result_array();
?>
<div class="hocvien">
	   <div class="thanh_title"><h4>Công trình dự án</h4></div>
	   <?php include _template."layout/jssor.php";?>
</div>

<div class="video_clip">
	   <div class="thanh_title"><h4>Video clip</h4></div>
	    <div id="video">
            <div id="video_load">
            <object width="100%" height="180"><param name="movie" value="//www.youtube.com/v/<?=youtobi($video[0]['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/<?=youtobi($video[0]['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="100%" height="180" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" ></embed></object>
              </div>
              <select class="video" name="video">
              <?php for($i=0;$i<count($video);$i++){?>
                <option value="<?=youtobi($video[$i]['links'])?>"><?=$video[$i]['ten_'.$lang]?></option>
              <?php } ?>
              </select>
        </div>
</div>

