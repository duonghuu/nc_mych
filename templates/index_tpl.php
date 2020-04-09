<h1 class="visit_hidden"><?=$row_setting['ten_'.$lang]?></h1>
<div class="danhmuc_pro clearfix">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web">Sản phẩm yêu thích</h3>
            <div class="box-content box-pd10">
                <div class="chay_tkhd scroll">
                    <?php foreach($tikiemhangdau as $k){?>
                        <div class="item_tkhd">
                            <div class="product_images">
                                <a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html">
                                    <div class="hidden_img">
                                        <img data-src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>"  onerror="this.src='1x1.png';" class="lazy" src="1x1.png" >
                                        <?php if($k['giacu'] > 0){?>
                                            <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                            <?php $giasp = explode('|',$k['gia']);?>
                            <?php
                              $pricesize=str_replace(',', '', $giasp[0]);
                              if($pricesize <=0){$pricesize = $k['giaban'];}
                            ?>
                            <div class="info_deal">
                                <h3><a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                    <span><?php if($pricesize==0) echo _lienhe; else echo number_format ($pricesize,0,",",",")." VNĐ";?></span>
                                    <?php if($k['giacu']>0){?>
                                        <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                    <?php } ?>
                                    
                                </div>
                               <div class="luotxem"><i class="fa fa-eye"></i> <?=$k['luotxemhd']?> lượt xem</div>
                               <?= likelayout($k["id"]) ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(!empty($spdaxem)){ ?>
<div class="danhmuc_pro clearfix">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web">Sản phẩm đã xem</h3>
            <div class="box-content box-pd10">
                <div class="chay_tkhd scroll">
                    <?php foreach($spdaxem as $k){?>
                        <div class="item_tkhd">
                            <div class="product_images">
                                <a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html">
                                    <div class="hidden_img">
                                        <img data-src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>"  onerror="this.src='1x1.png';" class="lazy" src="1x1.png" >
                                        <?php if($k['giacu'] > 0){?>
                                            <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                            <?php $giasp = explode('|',$k['gia']);?>
                            <?php
                              $pricesize=str_replace(',', '', $giasp[0]);
                              if($pricesize <=0){$pricesize = $k['giaban'];}
                            ?>
                            <div class="info_deal">
                                <h3><a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                    <span><?php if($pricesize==0) echo _lienhe; else echo number_format ($pricesize,0,",",",")." VNĐ";?></span>
                                    <?php if($k['giacu']>0){?>
                                        <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                    <?php } ?>
                                    
                                </div>
                               <div class="luotxem"><i class="fa fa-eye"></i> <?=$k['luotxemhd']?> lượt xem</div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php if($thoigiantu <= time() && $thoigianden >= time() ) { ?>
<?php if($dealgiasoc){?>
<div class="danhmuc_pro clearfix" id="deal_giasoc">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web flex_tit">
                <span class="tit-deal">deal giá sốc</span>
                <?php  if($thoigiantu <= time() && $thoigianden >= time() ) { ?>
                    <p id="countdown_p"><span id="countdown" class="timer"></span></p>
                <?php } ?>
            </h3>
            <div class="box-content box-pd10">
                <div class="chay_deal scroll">
                    <?php foreach($dealgiasoc as $k){?>
                        <div class="item_deal">
                            <div class="product_images">
                                <a  target="_blank" href="deal-gia-soc/<?=$k['tenkhongdau']?>.html">
                                    <div class="hidden_img">
                                        <img src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>"  onerror="this.src='https://placehold.it/475x500';">
                                        <?php if($k['giacu'] > 0){?>
                                            <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                            <div class="info_deal">
                                <h3><a  target="_blank" href="deal-gia-soc/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                    <span><?php if($k['giaban']==0) echo _lienhe; else echo number_format ($k['giaban'],0,",",",")." VNĐ";?></span>
                                    <?php if($k['giacu']>0){?>
                                        <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                    <?php } ?>
                                    
                                </div>
                                <?php if(($k['soluongdeal'] > 0)){?>
                                    <div class="qty_ban">
                                        <div class="progress progress_deal">
                                          <div class="progress-bar" role="progressbar" style="width:<?=deal_price($k['soluongdeal'],$k['soluongban']);?>%;" aria-valuenow="<?=deal_price($k['soluongdeal'],$k['soluongban']);?>" aria-valuemin="0" aria-valuemax="<?=$k['soluongdeal']?>"></div>
                                            <div class="tk-deal">
                                                <?php if($k['soluongban'] == $k['soluongdeal']){?>
                                                    Hết hàng
                                                <?php }else{?>
                                                    Đã bán <?=$k['soluongban']?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>

<?php include _template."layout/block_bottom_slider.php";?> 

<?php if($product_list_index){?>
<div class="danhmuc_pro clearfix">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web">Danh mục sản phẩm</h3>
            <div class="box-content">
                <div class="box-list">
                    <div class="chay_box_list scroll">
                        <?php foreach($product_list_index as $k =>$v){?>
                            <div class="item_list <?php if($k==1) echo'active';?>" data-id="<?=$v['id']?>">
                                <div class="box-show">
                                    <a href="san-pham/<?= $v['tenkhongdau'] ?>">
                                        <img onerror="this.src='1x1.png';" class="lazy" src="1x1.png" data-src="<?=_upload_product_l?><?=$v['thumb']?>" alt="<?=$v['ten_'.$lang]?>"><br>
                                    <span class="ten_list"><?=$v['ten_'.$lang]?></span></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-loadcat">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if($tikiemhangdau){?>
<div class="danhmuc_pro clearfix">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web">Tìm kiếm hàng đầu</h3>
            <div class="box-content box-pd10">
                <div class="chay_tkhd scroll">
                    <?php foreach($tikiemhangdau as $k){?>
                        <div class="item_tkhd">
                            <div class="product_images">
                                <a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html">
                                    <div class="hidden_img">
                                        <img data-src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>"  onerror="this.src='1x1.png';" class="lazy" src="1x1.png" >
                                        <?php if($k['giacu'] > 0){?>
                                            <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                            <?php $giasp = explode('|',$k['gia']);?>
                            <?php
                              $pricesize=str_replace(',', '', $giasp[0]);
                              if($pricesize <=0){$pricesize = $k['giaban'];}
                            ?>
                            <div class="info_deal">
                                <h3><a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                    <span><?php if($pricesize==0) echo _lienhe; else echo number_format ($pricesize,0,",",",")." VNĐ";?></span>
                                    <?php if($k['giacu']>0){?>
                                        <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                    <?php } ?>
                                    
                                </div>
                               <div class="luotxem"><i class="fa fa-eye"></i> <?=$k['luotxemhd']?> lượt xem</div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if($banner_qc){?>
    <div class="banner_qc">
        <div class="margin-auto">
            <a href="<?=$banner_qc['link']?>">
                <img class="lazy" src="1x1.png" data-src="<?=_upload_hinhanh_l?>1200x110x1/<?=$banner_qc['photo_vi']?>" alt="<?=$row_setting['ten_'.$lang]?>">
            </a>
        </div>
    </div>
<?php } ?>
 <!-- style="background:url(<?=_upload_hinhanh_l?><?=$banner_qc['photo_vi']?>);background-size: cover;" -->


<?php if($danhmuc_nb){?>
<div class="danhmuc_pro clearfix">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web">Danh mục nổi bật</h3>
            <div class="box-content flex_danhmuc_nb">
                <?php foreach($danhmuc_nb as $k){
                    $d->reset();
                    $sql= "select id from #_product where hienthi=1 and id_item='".$k['id']."' and type='product' order by stt,id desc";
                    $d->query($sql);
                    $countsp = $d->result_array();

                    $d->reset();
                    $sql= "select tenkhongdau from #_product_list where hienthi=1 and id='".$k['id_list']."' and type='product'";
                    $d->query($sql);
                    $ten_list = $d->fetch_array();

                    $d->reset();
                    $sql= "select tenkhongdau from #_product_cat where hienthi=1 and id='".$k['id_cat']."' and type='product'";
                    $d->query($sql);
                    $ten_cat = $d->fetch_array();

                ?>
                    <div class="item_danhmuc">
                        <div class="info_danhmuc">
                            <h3><a href="san-pham/<?=$ten_list['tenkhongdau']?>/<?=$ten_cat['tenkhongdau']?>/<?=$k['tenkhongdau']?>"><?=$k['ten_'.$lang]?></a></h3>
                            <p><?=count($countsp)?> Sản phẩm</p>
                        </div>
                        <div class="img_danhmuc">
                            <a href="san-pham/<?=$ten_list['tenkhongdau']?>/<?=$ten_cat['tenkhongdau']?>/<?=$k['tenkhongdau']?>"><img onerror="this.src='1x1.png';" class="lazy" src="1x1.png" data-src="<?=_upload_product_l?><?=$k['thumb']?>" alt="<?=$k['ten_'.$lang]?>"></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<div class="danhmuc_pro clearfix">
    <div class="margin-auto">
        <div class="box-white">
            <h3 class="tit-web">Gợi ý cho bạn</h3>
            <div class="box-content flex-sanpham" id="project">
                <?php foreach($product as $k){?>
                    <div class="item_sp">
                        <div class="pre_css">
                            <div class="border_css">
                                <div class="zoom">
                                    <div class="hidden_img">
                                        <a target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html">
                                            <img onerror="this.src='1x1.png';" class="lazy" src="1x1.png"  data-src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>">
                                            <?php if($k['giacu'] > 0){?>
                                                <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                            <?php } ?>
                                         </a>
                                    </div>
                                </div>
                                <?php $giasp = explode('|',$k['gia']);?>
                                <?php
                                  $pricesize=str_replace(',', '', $giasp[0]);
                                  if($pricesize <=0){$pricesize = $k['giaban'];}
                                ?>
                                <div class="info_sp">
                                    <h3><a  target="_blank" href="san-pham/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                    <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                        <span><?php if($pricesize==0) echo _lienhe; else echo number_format ($pricesize,0,",",",")." VNĐ";?></span>
                                        <?php if($k['giacu']>0){?>
                                            <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="hover_bot">
                                <a href="san-pham-cung-nghanh.html&<?=$k['tenkhongdau']?>">SP cùng ngành</a>
                                <a href="san-pham-tuong-tu.html&<?=$k['tenkhongdau']?>">SP tương tự</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="xemthem_sp text-center">
                <a href="javascript:void(0)" data-p="2" id="load-page-index" data-item="36" title="Xem thêm"><span>Xem thêm</span></a>
            </div>
        </div>
    </div>
</div>


<?php if($product_list_index){?>
<div class="bottom_web">
    <div class="margin-auto">
        <h3 class="tit1">Danh mục</h3>
        <div class="flex_bottom_w">
            <?php foreach($product_list_index as $k =>$v){
                $d->reset();
                $sql_cat="select ten_vi,id,tenkhongdau from #_product_cat where id_list='".$v['id']."' and hienthi =1 order by stt";
                $d->query($sql_cat);
                $row_cat = $d->result_array();
            ?>
                <div class="col-bottom">
                    <div class="tit2"><?=$v['ten_'.$lang]?></div>
                    <?php if($row_cat){?>
                        <div class="content-col">
                            <?php foreach($row_cat as $i=>$j) {?>
                                <a href="san-pham/<?=$j['tenkhongdau']?>"><?=$j['ten_'.$lang]?></a><span class="<?php if($i+1 == count($row_cat)) echo 'visit_hidden';?>">|</span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>