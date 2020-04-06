<?php 
    $d->reset();
    $sql="select id,ten_$lang,tenkhongdau,icon from #_product_list where hienthi=1 and type='product' order by stt,id desc";
    $d->query($sql);
    $row_list_id=$d->result_array();
 ?>
<nav id="menu_mobi" style="height:0; overflow:hidden;">
 	<?php if($row_list_id) {?>
        <ul>
        <?php foreach($row_list_id as $k=>$v){?>
            <?php
              $d->reset();
              $sql = "select ten_$lang,id,tenkhongdau from #_product_cat where hienthi=1 and id_list='".$v['id']."' and type='product' order by stt,id";
              $d->query($sql);
              $row_cat = $d->result_array();
            ?>
               <li class="" ><a href="san-pham/<?=$v['tenkhongdau']?>" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a>
                  <?php if($row_cat) {?>
                        <ul>
                          <?php foreach($row_cat as $h =>$j){?>
                            <?php
                              $d->reset();
                              $sql = "select ten_$lang,tenkhongdau,id from #_product_item where hienthi=1 and id_cat='".$j['id']."' and type='product' order by stt,id";
                              $d->query($sql);
                              $row_item = $d->result_array();
                            ?>
                            <li class="" ><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$j['tenkhongdau']?>" title="<?=$j['ten_'.$lang]?>"><?=$j['ten_'.$lang]?></a>
                                <?php if($row_item) {?>
                                    <ul>
                                        <?php foreach($row_item as $i =>$w){?>
                                          <li class="" ><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$j['tenkhongdau']?>/<?=$w['tenkhongdau']?>" title="<?=$w['ten_'.$lang]?>"><?=$w['ten_'.$lang]?></a>
                                             </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                          <?php } ?>
                      </ul>
                    <?php } ?>
               </li>
            <?php } ?>
        </ul>
    <?php } ?>
</nav>