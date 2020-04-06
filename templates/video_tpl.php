<div id="info">
      
<?php include _template."layout/left.php";?>

      <div class="khung_pr"> 
      <div class="thanh_title"><h2><?=$title_detail?></h2></div>
      <div>
      <?php for($i=0, $count_tt=count($tintuc);$i<$count_tt;$i++){  ?> 
        <div class="box_video col-md-4 col-md-4 col-sm-4 col-xx-6 col-xs-12">
            <a href="video/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html" >
            <img src="http://img.youtube.com/vi/<?=youtobi($tintuc[$i]['links'])?>/sddefault.jpg" border="0" align="left" /></a>
            <h3><a href="dich-vu/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html" ><?=$tintuc[$i]['ten_'.$lang]?></a></h3>
        </div>
       <?php }?>
      </div>
       <div align="center" ><div class="paging"><?=$paging?></div></div>
      </div>
</div> 