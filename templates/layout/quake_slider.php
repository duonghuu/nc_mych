<?php

	$d->reset();
	$sql = "select photo_vi,link from #_photo where hienthi=1 and type='slider' order by stt,id desc";
	$d->query($sql);
	$slide_s = $d->result_array();

?>
    <link href="js/slide_p/css/quake.slider.css" rel="stylesheet" type="text/css" />
    <link href="js/slide_p/skins/dark-room/quake.skin.css" rel="stylesheet" type="text/css" />
    <script src="js/slide_p/js/quake.slider-min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.quake-slider').quake({
                thumbnails: false,
                animationSpeed: 1000,
                applyEffectsRandomly: true,
                navPlacement: 'inside',
                navAlwaysVisible: false,
                captionOpacity: '0.3',
                captionsSetup: [
                                 {
                                     "orientation": "top",
                                     "slides": [0, 1],
                                     "callback": captionAnimateCallback
                                 },
                                  {
                                      "orientation": "left",
                                      "slides": [2, 3],
                                      "callback": captionAnimationCallback1
                                  }
                                  ,
                                  {
                                      "orientation": "bottom",
                                      "slides": [4, 5],
                                      "callback": captionAnimateCallback
                                  }
                                  ,
                                  {
                                      "orientation": "right",
                                      "slides": [6, 7],
                                      "callback": captionAnimationCallback1
                                  }
                                ]

            });

            function captionAnimateCallback(captionWrapper, captionContainer, orientation) {
                captionWrapper.css({ left: '-990px' }).stop(true, true).animate({ left: 0 }, 500);
                captionContainer.css({ left: '-990px' }).stop(true, true).animate({ left: 0 }, 500);
            }
            function captionAnimationCallback1(captionWrapper, captionContainer, orientation) {
                captionWrapper.css({ top: '-330px' }).stop(true, true).animate({ top: 0 }, 500);
                captionContainer.css({ top: '-330px' }).stop(true, true).animate({ top: 0 }, 500);
            }
        });
    </script>

    <div class="quake-slider">
        <div class="quake-slider-images">
         <?php for($i=0,$count_bg=count($slide_s);$i<$count_bg;$i++){?>
            <a target="_blank" href="<?=$slide_s[$i]['link']?>">
                <img src="<?=_upload_hinhanh_l.$slide_s[$i]['photo_vi']?>" alt="slide "  />
            </a>
        <?php } ?>
        </div>
        
    </div>
