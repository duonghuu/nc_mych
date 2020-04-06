<?php 
	$d->reset();
	$sql_images= "select photo,id from #_doitac where hienthi=1";
	$d->query($sql_images);
	$slide_giau = $d->result_array();
	

?>
<style>
.theme-default #slider {
    width:555px; /* Make sure your images are the same size */
    height:310px; /* Make sure your images are the same size */
}

/*====================*/
/*=== Other Styles ===*/
/*====================*/
.clear {
	clear:both;
}
</style>
    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/orman/orman.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/nivo-slider.css" type="text/css" media="screen" />

    <div id="wrapper">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                    <?php for($i=0,$count_image=count($slide_giau);$i<$count_image;$i++){?>
                			<img src="<?=_upload_doitac_l.$slide_giau[$i]['photo']?>" width="555" height="310" />
            		 <?php }?> 
            </div>
        </div>

    </div>
    <script type="text/javascript" src="themes/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="themes/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>