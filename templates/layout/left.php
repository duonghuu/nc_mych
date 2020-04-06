<?php
    $d->reset();
    $sql="select id,ten_$lang,tenkhongdau,icon from #_product_list where hienthi=1 and type='product' order by stt,id desc";
    $d->query($sql);
    $row_list_id=$d->result_array();

    if($_GET['idl']!=''){
        $d->reset();
        $sql="select id from #_product_list where hienthi=1 and tenkhongdau='".$_GET['idl']."'";
        $d->query($sql);
        $list_danhmuc =$d->fetch_array();
        $active_l =  $list_danhmuc['id'];
    }
    if($_GET['idc']!=''){
        $d->reset();
        $sql="select id,id_list from #_product_cat where hienthi=1 and tenkhongdau='".$_GET['idc']."'";
        $d->query($sql);
        $list_danhmuc =$d->fetch_array();
        $active_l =  $list_danhmuc['id_list'];
        $active_c =  $list_danhmuc['id'];
    }
    if($_GET['idi']!=''){
        $d->reset();
        $sql="select id,id_list,id_cat from #_product_item where hienthi=1 and tenkhongdau='".$_GET['idi']."'";
        $d->query($sql);
        $list_danhmuc =$d->fetch_array();
        $active_l =  $list_danhmuc['id_list'];
        $active_c =  $list_danhmuc['id_cat'];
        $active_i =  $list_danhmuc['id'];

    }
?>

<div class="w_danhmuc_l">
    <?php /* <div class="tit_danhmuc_l"><img src="images/bar.png"> <span> Danh mục</span></div>
        <div class="content_danhmuc">
              <?php if($row_list_id) {?>
                <ul>
                    <?php foreach($row_list_id as $k=>$v){?>
                    <?php
                      $d->reset();
                      $sql = "select ten_$lang,id,tenkhongdau from #_product_cat where hienthi=1 and id_list='".$v['id']."' and type='product' order by stt,id";
                      $d->query($sql);
                      $row_cat = $d->result_array();
                    ?>
                       <li class="<?php if($active_l==$v['id']) echo'active';?>" ><a href="san-pham/<?=$v['tenkhongdau']?>" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a>
                          <?php if($row_cat) {?>
                                <ul>
                                  <?php foreach($row_cat as $h =>$j){?>
                                    <?php
                                      $d->reset();
                                      $sql = "select ten_$lang,tenkhongdau,id from #_product_item where hienthi=1 and id_cat='".$j['id']."' and type='product' order by stt,id";
                                      $d->query($sql);
                                      $row_item = $d->result_array();
                                    ?>
                                    <li class="<?php if($active_c==$j['id']) echo'active';?>" ><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$j['tenkhongdau']?>" title="<?=$j['ten_'.$lang]?>"><?=$j['ten_'.$lang]?></a>
                                        <?php if($row_item) {?>
                                            <ul>
                                                <?php foreach($row_item as $i =>$w){?>
                                                  <li class="<?php if($active_i==$w['id']) echo'active';?>" ><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$j['tenkhongdau']?>/<?=$w['tenkhongdau']?>" title="<?=$w['ten_'.$lang]?>"><?=$w['ten_'.$lang]?></a>
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
        </div> */?>
    <div class="tit_danhmuc_l"><img src="images/bar.png"> <span> Danh mục</span></div>
    <div class="content_danhmuc2">
      
          <?php if($row_list_id) {?>
            <ul>
                <?php foreach($row_list_id as $k=>$v){?>
                <?php
                  $d->reset();
                  $sql = "select ten_$lang,id,tenkhongdau from #_product_cat where hienthi=1 and id_list='".$v['id']."' and type='product' order by stt,id";
                  $d->query($sql);
                  $row_cat = $d->result_array();
                ?>
                   <li class="<?php if($active_l==$v['id']) echo'active';?>" ><span><a href="san-pham/<?=$v['tenkhongdau']?>" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a><i data-toggle="collapse" data-target="#<?= md5($v['tenkhongdau'].$v['id']) ?>" class="fa fa-plus" aria-hidden="true"></i></span>
                      <?php if($row_cat) {?>
                            <ul id="<?= md5($v['tenkhongdau'].$v['id']) ?>" class="collapse <?php if($active_l==$v['id']) echo'in';?>">
                              <?php foreach($row_cat as $h =>$j){?>
                                <?php
                                  $d->reset();
                                  $sql = "select ten_$lang,tenkhongdau,id from #_product_item where hienthi=1 and id_cat='".$j['id']."' and type='product' order by stt,id";
                                  $d->query($sql);
                                  $row_item = $d->result_array();
                                ?>
                                <li class="<?php if($active_c==$j['id']) echo'active';?>" ><span><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$j['tenkhongdau']?>" title="<?=$j['ten_'.$lang]?>"><?=$j['ten_'.$lang]?></a><i data-toggle="collapse" data-target="#<?= md5($j['tenkhongdau'].$j['id']) ?>" class="fa fa-plus" aria-hidden="true"></i></span>
                                    <?php if($row_item) {?>
                                        <ul id="<?= md5($j['tenkhongdau'].$j['id']) ?>" class="collapse <?php if($active_c==$j['id']) echo'in';?>">
                                            <?php foreach($row_item as $i =>$w){?>
                                              <li class="<?php if($active_i==$w['id']) echo'active';?>" ><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$j['tenkhongdau']?>/<?=$w['tenkhongdau']?>" title="<?=$w['ten_'.$lang]?>"><?=$w['ten_'.$lang]?></a>
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
    </div>
</div>
<script>
  $(document).ready(function() {
    $('.content_danhmuc2 li i').click(function(){
      $(this).toggleClass('active');
    })
  });
</script>
