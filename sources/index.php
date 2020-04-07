<?php  if(!defined('_source')) die("Error");
	//dump($_SESSION['cart']);
	$d->reset();
    $sql= "select ten_$lang,id,thumb,tenkhongdau,giaban,giacu,size,giacu,photo,gia from #_product where hienthi=1 and noibat<>0 and type='product' order by RAND () limit 0,36";
    $d->query($sql);
    $product = $d->result_array();

    $d->reset();
    $sql= "select ten_$lang,id,thumb,tenkhongdau,giaban,giacu,giacu,photo,soluongban,soluongdeal,gia from #_product where hienthi=1 and type='deal-gia-soc' order by stt,id desc limit 0,50";
    $d->query($sql);
    $dealgiasoc = $d->result_array();

    $d->reset();
    $sql_detail = "select id,photo,thumb,ten_$lang,giaban,tenkhongdau,giacu,luotxem,luotxem+luotxem2 as luotxemhd ,gia from #_product where hienthi=1 and type='product' order by luotxemhd desc limit 0,30";
    $d->query($sql_detail);
    $tikiemhangdau = $d->result_array();

    $a_cl = array_column($_SESSION["daxem"],'productid');

    if(!empty($a_cl)){

        $d->reset();
        $sql_detail = "select id,photo,thumb,ten_$lang,giaban,tenkhongdau,giacu,luotxem,luotxem+luotxem2 as luotxemhd ,gia
         from #_product where id in (".implode($a_cl,",").") order by luotxemhd desc limit 0,30";
        $d->query($sql_detail);
        $spdaxem = $d->result_array();
    }

    $d->reset();
    $sql= "select ten_$lang,id,tenkhongdau,thumb2,thumb from #_product_list where hienthi=1 and danhmuc!=0 order by stt,id desc";
    $d->query($sql);
    $product_list_index = $d->result_array();

    $d->reset();
    $sql= "select ten_$lang,id,tenkhongdau,thumb,thumb,id_list,id_cat from #_product_item where hienthi=1 and noibat!=0 and type='product' order by stt,id desc";
    $d->query($sql);
    $danhmuc_nb = $d->result_array();

    $d->reset();
    $sql_banner_top= "select photo_vi,link from #_photo where type='banner_qc'";
    $d->query($sql_banner_top);
    $banner_qc = $d->fetch_array();


 
?>
    
