<script>
    jssor_slider1_starter = function (containerId) {
        var options = {
            $AutoPlay: true, 
            $AutoPlaySteps: 1,
            $AutoPlayInterval: 0, 
            $PauseOnHover: 4, 
            $ArrowKeyNavigation: false, 
            $SlideEasing: $JssorEasing$.$EaseLinear,
            $SlideDuration: 12000,
            $MinDragOffsetToSlide: 20,
            $SlideWidth: 495,
            $SlideSpacing: 12,
            $DisplayPieces: 2,
            $ParkingPosition: 0,
            $UISearchMode: 1,
            $PlayOrientation: 1,
            $DragOrientation: 1
        };

        var jssor_slider1 = new $JssorSlider$(containerId, options);
    };
</script>
<?php 
    $d->reset();
    $sql="select id,thumb,photo_vi,ten_vi,link from table_photo where hienthi=1 and type='quangcaongang' order by id,stt desc";
    $d->query($sql);
    $resutl_quangcao=$d->result_array();
 ?>
<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 1200px; height: 160px; overflow: hidden; ">
    <div u="slides" style="cursor: pointer; position: absolute; left: 0px; top: 0px; width: 1200px; height: 160px; overflow: hidden;">
        <?php for($i=0;$i<count($resutl_quangcao);$i++){ ?>
            <div><a style="cursor: pointer;" href="<?=$resutl_quangcao[$i]['link']?>" target="_blank" title="<?=$resutl_quangcao[$i]['ten_vi']?>"><img u="image" alt="<?=$resutl_quangcao[$i]['ten_vi']?>" src="<?=_upload_hinhanh_l.$resutl_quangcao[$i]['thumb']?>" /></a></div>
        <?php } ?>
    </div>
    <script>
        jssor_slider1_starter('slider1_container');
    </script>
</div>