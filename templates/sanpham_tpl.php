<h2 class="visit_hidden"><?=$title_detail?></h2>
<div id="info">
    <div id="sanpham" class="pa_top">

      <div class="khung_pr">

          <div class="flex_sanpham">
              <div class="left_sp">
                 <?php  include _template."layout/left.php";?> 
              </div> 
              <div class="right_sp">
                  <div class="w_loc_sp">
                      <?php  include _template."layout/sort.php";?> 
                  </div>
                  <div class="flex_r_sp">
                    <?php if(count($product)!=0){?>
                        <?php foreach($product as $k){?>
                            <div class="item_sp_tt">
                              <div class="bg_ff">
                                  <div class="zoom">
                                      <div class="hidden_img">
                                          <a href="san-pham/<?=$k['tenkhongdau']?>.html">
                                              <img src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>" onerror="this.src='http://placehold.it/475x500';">
                                              <?php if($k['giacu'] > 0){?>
                                                  <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                              <?php } ?>
                                           </a>
                                          
                                      </div>
                                  </div>
                                  <div class="info_sp">
                                      <h3><a href="san-pham/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                      <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                          <span><?php if($k['giaban']==0) echo _lienhe; else echo number_format ($k['giaban'],0,",",",")." VNĐ";?></span>
                                          <?php if($k['giacu']>0){?>
                                              <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                          <?php } ?>
                                      </div>
                                      <div class="luotxem"><i class="fa fa-eye"></i> <?=$k['luotxem']+$k['luotxem2']?> lượt xem</div>
                                      <?= likelayout($k["id"]) ?>
                                  </div>
                              </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                      <div style="text-align:center; color:#FF0000; font-weight:900; font-size:22px; text-transform:uppercase;" >Chưa Có Tin Cho Mục này .</div> 
                    <?php }?>
                  </div>
                  <div class="clear"></div>
                  <div class="paging"><?=$paging?></div> 
              </div>
          </div>

      </div>
         
    </div>
</div>
<h1 class="visit_hidden"><?=$row_setting['ten_'.$lang]?></h1>