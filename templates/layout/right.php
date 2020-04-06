<?php  if(!defined('_source')) die("Error");

    $id =  addslashes($_GET['id']);
    $idl =  addslashes($_GET['idl']);

    $d->reset();
    $sql = "select id,ten_$lang,tenkhongdau from #_baiviet_list where hienthi=1 and type='".$type_bar."' order by id,stt desc";
    $d->query($sql);
    $result_list = $d->result_array();

    if(count($result_list)<=0){
      $d->reset();
      $sql = "select id,ten_$lang,tenkhongdau from #_baiviet where hienthi=1 and type='".$type_bar."' order by id,stt desc";
      $d->query($sql);
      $result = $d->result_array();
    }

?>
<div id="right">
  <div class="thanh_title"><h2><?=$title_detail?></h2></div><div class="clear"></div>
  <div class="box_right">
    <div class="content_box_right">
      <ul>
        <?php for($i=0;$i<count($result);$i++){ ?>
          <li><a href="<?=$_GET['com']?>/<?=$result[$i]['tenkhongdau']?>.html" title="<?=$result[$i]['ten_vi']?>"><?=$result[$i]['ten_vi']?></a></li>
        <?php } ?>
        <?php for($i=0;$i<count($result_list);$i++){ ?>
          <li><a href="<?=$_GET['com']?>/<?=$result_list[$i]['tenkhongdau']?>/" title="<?=$result_list[$i]['ten_vi']?>"><?=$result_list[$i]['ten_vi']?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>