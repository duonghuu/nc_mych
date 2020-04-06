<style type="text/css">
    #slideads{
    position: absolute;
    visibility: hidden;
    z-index: 100;bottom:500px;top:330px;
    }
    #slideads1{
    float:left;
    margin-left: 0px;position: relative;bottom:150px;
    }
    #slideads2{
    float:right;
    margin-right: 0px;position: relative;bottom:150px;
    }
</style>
<script src="js/quangcaotruot.js" type="text/javascript"></script>
<?php
    $d->reset();
    $sql="select id,type,photo_vi,thumb,ten_vi,link,hienthi from table_photo where hienthi=1 and type='quangcaodoc' order by stt asc";
    $d->query($sql);
    $resutl_qc=$d->result_array();    



    if($_GET['idl'] != ""){
        $d->reset();
        $sql="select id,quangcaotrai,linkqctrai,quangcaophai,linkqcphai from table_product_list where hienthi=1 and tenkhongdau='".$_GET['idl']."' order by stt asc";
        $d->query($sql);
        $resutl_qc2 =$d->fetch_array();
		
		
		
		    $d->reset();
			$sql="select id,type,photo,ten_vi,links,hienthi from table_product_photo where id_product='".$resutl_qc2["id"]."' and hienthi=1 and type='quangcaotrai' order by stt asc";
			$d->query($sql);
			$rs_qcleft=$d->result_array();    
			
			 $d->reset();
			$sql="select id,type,photo,ten_vi,links,hienthi from table_product_photo where id_product='".$resutl_qc2["id"]."' and hienthi=1 and type='quangcaophai' order by stt asc";
			$d->query($sql);
			$rs_qcright=$d->result_array();    

    }



?>
<?php if($rs_qcleft[0]['photo'] != "" || $rs_qcright[0]['photo'] != "" ){ ?>
    
  <div id="slideads" class="max_quangcao">
    <div class="slideads1" id="slideads1">
	
		<?php foreach ($rs_qcleft as $i =>$v) {?>
		<div> 
        <a href="<?=$v['links']?>" title="<?=$v['ten_vi']?>" target="_blank"><img src="<?=_upload_product_l.$v['photo']?>" alt="<?=$v['ten_vi']?>"></a>
		</div>
		<?php }?>
	
	</div>
    <div class="slideads2" id="slideads2">
        <?php foreach ($rs_qcright as $i =>$v) {?>
		<div>
        <a href="<?=$v['links']?>" title="<?=$v['ten_vi']?>" target="_blank"><img src="<?=_upload_product_l.$v['photo']?>" alt="<?=$v['ten_vi']?>"></a>
		</div>
		<?php }?>
    </div>
</div>  

<?php } else {?>

 <?php if($resutl_qc[1]['hienthi']==1 || $resutl_qc[0]['hienthi']==1) { ?>

<div id="slideads">
    <?php if($resutl_qc[1]['hienthi']==1) { ?>
    <div class="slideads1" id="slideads1">
        <a href="<?=$resutl_qc[1]['link']?>" title="<?=$resutl_qc[1]['ten_vi']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$resutl_qc[1]['thumb']?>" alt="<?=$resutl_qc[1]['ten_vi']?>"></a>
    </div>
    <?php } ?>
    <?php if($resutl_qc[0]['hienthi']==1) { ?>
    <div class="slideads2" id="slideads2">
        <a href="<?=$resutl_qc[0]['link']?>" title="<?=$resutl_qc[0]['ten_vi']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$resutl_qc[0]['thumb']?>" alt="<?=$resutl_qc[0]['ten_vi']?>"></a>
    </div>
    <?php } ?>
</div>
<?php } ?>


<?php } ?>