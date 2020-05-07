
<?php
    $d->reset();
    $sql = "select thumb,id,photo from #_product_photo where hienthi=1 and type='$type_bar'
     and id_product='".$row_detail['id']."' order by stt,id desc ";
    $d->query($sql);
    $product_photos = $d->result_array();
?><?php if(!empty($row_detail['photo'])){ ?>
<div class="list_thumb">
    
    <div class="item_thumb"><a  data-zoom-id="Zoom-1" href="<?=_upload_product_l.$row_detail['photo']?>"
    data-image="<?=_upload_product_l.$row_detail['photo']?>">
    <img u="image" src="<?=_upload_product_l.$row_detail['thumb']?>" width="120" height="100" /></a>
        </div>

    <?php for($i=0,$count_ch=count($product_photos);$i<$count_ch;$i++){?>
        <div class="item_thumb"><a  data-zoom-id="Zoom-1" href="<?=_upload_product_l.$product_photos[$i]['photo']?>"
    data-image="<?=_upload_product_l.$product_photos[$i]['photo']?>">
    <img u="image" src="<?=_upload_product_l.$product_photos[$i]['thumb']?>" width="120" height="100" /></a>
        </div>
    <?php } ?>
</div>
<?php } ?>
<?php /* <script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.0-packed.js"></script>
<script type="text/javascript" language="javascript">
    $(function() {
        $('#foo3').carouFredSel({
            width: 400,
            height: 'auto',
            prev: '#prev13',
            next: '#next13',
            auto: true,
            scroll: 1
        });
    });
</script>
<style type="text/css" media="all">
.list_carousel {
    width: 450px;
    position:relative;
    float:left;
}
.list_carousel ul {
    margin: 0;
    width: 400px;
    padding: 0;
    list-style: none;

    display: block;
}
.list_carousel li {
    display: block;
    float: left;
    padding: 5px 10px 5px 10px;
}
.list_carousel li img{
    float: left;
}
.list_carousel li a{ text-decoration:none;}
.list_carousel li a h3{ color:#835410; text-align:center; font-weight:500; margin-top:10px; font-size:16px; margin-bottom:10px; text-transform:uppercase;}
.list_carousel li:hover{
}
.list_carousel li.active{
}
.list_carousel.responsive {
    width: auto;
    margin-left: 0;
}
.clearfix {
    float: none;
    clear: both;
}
.pager {
    float: left;
    width: 320px;
    text-align: center;
}
.pager a {
    margin: 0 5px;
    text-decoration: none;
}
.pager a.selected {
    text-decoration: underline;
}
.timer {
    background-color: #999;
    height: 6px;
    width: 0px;
}
.prev13{ width: 41px; height: 36px; position: absolute; z-index: 10; background: url(images/left.png) no-repeat; top: 50px; left: 20px;}
.next13{ width: 41px; height: 36px; position: absolute; z-index: 10; background: url(images/right.png) no-repeat; top: 50px; right: 20px;}
</style>*/?>