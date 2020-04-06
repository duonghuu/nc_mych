<script>
    $(document).ready(function() {

      var owl = $("#owl-demo");

      owl.owlCarousel({

        items : 6, //10 items above 1000px browser width
        itemsDesktop : [1040,5], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,3], // betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0
        itemsMobile : [400,1], // itemsMobile disabled - inherit from itemsTablet option
        autoPlay: true,
        scrollPerPage : 1,
        slideSpeed: 300,
        pagination:false,
         // navigationText: ["",""],
        navigation : false,
        slideSpeed : 300,
        paginationSpeed : 400,
      
      });
});
</script>
<?php 
    $d->reset();
    $sql="select id,ten_$lang,photo_vi,thumb,link from #_photo where hienthi=1 and type='doitac' order by stt asc";
    $d->query($sql);
    $result_doitac=$d->result_array();
?>
<style type="text/css">
  .owl-carousel{text-align: center;}
  .owl-carousel .item{text-align: center;}
  .owl-carousel .item img{background-color: #fff;transition: all 0.5s ease-in-out;}
  .owl-carousel .item:hover img{transform: scale(1.1);}
</style>
<div id="owl-demo" class="owl-carousel">
  <?php for($a=0;$a<count($result_doitac);$a++){ ?>
    <div class="item">
      <a href="<?=$result_doitac[$a]['link']?>" title="<?=$result_doitac[$a]['ten_vi']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$result_doitac[$a]['thumb']?>" alt="<?=$result_doitac[$a]['ten_vi']?>"></a>
    </div>
  <?php } ?>
</div>