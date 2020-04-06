<?php 

    $d->reset();
    $sql = "select photo_vi,link from #_photo where hienthi=1 and type='slider' order by stt,id desc";
    $d->query($sql);
    $slide_s = $d->result_array();

    $d->reset();
    $sql = "select photo_vi,link,thumb from #_photo where hienthi=1 and type='banner_sl' order by stt,id desc limit 0,2";
    $d->query($sql);
    $banner_sl = $d->result_array();
?>
    <section id="slider-top" class="clearfix">
        <div class="slider_page p-relative">
          <div id="jssor_1" style="position: relative; width: 800px; height: 235px; max-width: 100%; overflow: hidden;">
            <div data-u="slides" style="position: relative; width: 800px; height: 235px; max-width: 100%; overflow: hidden;">
                <?php foreach($slide_s as $k){?>
                    <div data-b="0">
                       <a href="<?=$k['link']?>">
                            <img alt="" u=image src="<?=_upload_hinhanh_l?><?=$k['photo_vi']?>">
                        </a>
                    </div> 
                <?php } ?>
            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:80%;height:80%;">
                        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                    </svg>
                </div>
            </div>
            <!-- Arrow Navigator -->
            <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                </svg>
            </div>
          </div>
        </div>
    </section>
    <div class="r_slider">
        <?php foreach($banner_sl as $k){?>
            <div class="item_banner">
                <a href="<?=$k['link']?>">
                    <img src="<?=_upload_hinhanh_l?><?=$k['thumb']?>" alt="<?=$k['ten_'.$lang]?>">
                </a>  
            </div>
        <?php } ?>
    </div>

<?php if($source=='index') {?>
<script src="js/jssor/jssor.slider-25.2.0.min.js" type="text/javascript"></script>
<script src="js/jssor/jssor_1_slider_init.js" type="text/javascript"></script>
<script type="text/javascript">jssor_1_slider_init();</script>
<?php } ?>
