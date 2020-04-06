<style type="text/css">

@font-face {
    font-family: 'RobotoCondensedRegular';
    src: url('css/fonts/RobotoCondensedRegular/RobotoCondensedRegular.eot');
    src: url('css/fonts/RobotoCondensedRegular/RobotoCondensedRegular.eot') format('embedded-opentype'),
         url('css/fonts/RobotoCondensedRegular/RobotoCondensedRegular.woff2') format('woff2'),
         url('css/fonts/RobotoCondensedRegular/RobotoCondensedRegular.woff') format('woff'),
         url('css/fonts/RobotoCondensedRegular/RobotoCondensedRegular.ttf') format('truetype'),
         url('css/fonts/RobotoCondensedRegular/RobotoCondensedRegular.svg#RobotoCondensedRegular') format('svg');
         font-style: normal;font-weight: normal;
}

    #slider11_container img{width:75px !important;max-width: 75px !important;float: left !important;margin-right:10px !important;}
    #slider11_container div.abc:hover img{    transform: rotateY(360deg);
    -webkit-transform: rotateY(360deg);
    -webkit-transition: 0.8s;
    -moz-transition: 0.8s;
    -o-transition: 0.8s;
    transition: 0.8s;}
    #slider11_container a.text_header{float: right !important;word-wrap:break-word !important;text-align: left !important;width: 70px !important;padding-top:15px !important;font-family: 'RobotoCondensedRegular';font-size: 14px;color:#404040;text-transform: uppercase;}
</style>
<script>
    jssor_slider11_starter = function (containerId) {
        var options = {
            $AutoPlay: true, 
            $Loop:0,
            $AutoPlaySteps: 1,
            $AutoPlayInterval: 0, 
            $PauseOnHover: 4, 
            $ArrowKeyNavigation: false, 
            $SlideEasing: $JssorEasing$.$EaseLinear,
            $SlideDuration: 10000,
            $MinDragOffsetToSlide: 20,
            $SlideWidth: 150,
            $SlideSpacing: 12,
            $DisplayPieces: 4,
            $ParkingPosition: 0,
            $UISearchMode: 1,
            $PlayOrientation: 1,
            $DragOrientation: 1
        };

        var jssor_slider11 = new $JssorSlider$(containerId, options);
    };
</script>
<?php 
    $d->reset();
    $sql="select id,thumb,photo,ten_$lang,noidung_$lang,tenkhongdau from table_baiviet where hienthi=1 and type='header' order by id,stt desc";
    $d->query($sql);
    $resutl_header=$d->result_array();
 ?>
<div id="slider11_container" style="position: relative; top: 0px; right: -5px;width: 680px; height: 75px; overflow: hidden; ">
    <div u="slides" style="cursor: pointer; position: absolute; right: 0px; top: 0px;left:5px;  width: 680px; height: 75px; overflow: hidden;">
        <?php for($i=0;$i<count($resutl_header);$i++){ ?>
            <div class="abc">
                <a href="chinh-sach/<?=$resutl_header[$i]['tenkhongdau']?>.html" title="<?=$resutl_header[$i]['ten_vi']?>">
                    <img u="image" alt="<?=$resutl_header[$i]['ten_vi']?>" src="<?=_upload_baiviet_l.$resutl_header[$i]['thumb']?>"/>
                </a>
                <a class="text_header" href="chinh-sach/<?=$resutl_header[$i]['tenkhongdau']?>.html" title="<?=$resutl_header[$i]['ten_vi']?>"><?=$resutl_header[$i]['ten_'.$lang]?></a>
            </div>
        <?php } ?>
    </div>
    <script>
        jssor_slider11_starter('slider11_container');
    </script>
</div>