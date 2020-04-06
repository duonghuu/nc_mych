<?php 

  
   $d->reset();
  $sql = "select * from #_product_list where hienthi=1 and type='product' order by stt,id desc";
  $d->query($sql);
  $row_list = $d->result_array();

  $d->reset();
  $sql = "select * from #_baiviet_list where hienthi=1 and type='dichvu' order by stt,id desc";
  $d->query($sql);
  $row_dichvu_list = $d->result_array();
  
?>
<amp-sidebar id='sidebar' layout='nodisplay'>
    <label>Menu</label>
    <ul class="menu_mobile">
      <li><a href="/index.html" title="<?=_trangchu?>"><?=_trangchu?></a></li>
      
    </ul>
    <amp-accordion class="drop_nav">
      <section>
          <h4>Sản phẩm <i class="fa fa-angle-right"></i></h4>
          <ul>
        <?php for($i=0,$count_xem=count($row_list);$i<$count_xem;$i++){?>
                <?php
                    $d->reset();
                    $sql = "select * from #_product_cat where hienthi=1 and id_list='".$row_list[$i]['id']."' and type='product' order by stt,id desc";
                    $d->query($sql);
                    $row_cat = $d->result_array();
                ?>
            <li><a href="/<?=$row_list[$i]['tenkhongdau']?>"><i class="fa fa-angle-double-right"></i> <?=$row_list[$i]['ten_'.$lang]?></a>
              <ul>
                <?php for($j=0,$count_cat=count($row_cat);$j<$count_cat;$j++){
                      $d->reset();
                      $sql = "select * from #_product_item where hienthi=1 and id_cat='".$row_cat[$j]['id']."' and type='product' order by stt,id desc";
                      $d->query($sql);
                      $row_item = $d->result_array();
                  ?>
                <li><a href="/<?=$row_list[$i]['tenkhongdau']?>/<?=$row_cat[$j]['tenkhongdau']?>"><i class="fa fa-angle-right"></i> <?=$row_cat[$j]['ten_'.$lang]?></a></li>
                <?php }?>
              </ul>
            </li>
          <?php }?>
          </ul>
      </section>
    </amp-accordion>
    <ul class="menu_mobile">
      <li><a href="/lien-he.html" title="<?=$lang_arr["lienhe"]?>"><?=_lienhe?></a></li>
    </ul>
</amp-sidebar>