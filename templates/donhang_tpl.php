<script type="text/javascript">
$(document).ready(function($) {
	$('.item-trangthai').click(function(event) {
		$('.item-trangthai').removeClass('active');
		$(this).addClass('active');
        $('.item-donhang').removeClass('active');
        var tab = $(this).find('a').attr("href");
        $(tab).addClass('active');
		return false;
	});	
});
</script>
<?php 

?>
<div class="main_content pa_top">
        
    <div class="flex_taikhoan">
        <div class="l_taikhoan"> 
            <div class="box-img-name-user">
                <div class="img-user">
                    <img src="<?=_upload_thanhvien_l?><?=$row_thanhvien['photo']?>" alt="<?=$row_thanhvien['username']?>" onerror="this.src='http://placehold.it/70x70';">
                </div> 
                <div class="name-user">
                    <div class="ten_user"><?=$row_thanhvien['ten']?></div>   
                    <p onclick="window.location.href='tai-khoan.htm'"><i class="fa fa-pencil"></i> Sửa hồ sơ</p> 
                </div>
            </div>
            <div class="box-info-donmua">
                <div class="info_user item-info-user <?php if($com=='tai-khoan') echo 'active';?>"><img src="images/info_user.png"><a href="tai-khoan.htm">Tài khoản của tôi</a></div>
                <div class="donmua_user item-info-user <?php if($com=='don-hang') echo 'active';?>"><img src="images/donmua.png"> <a href="don-hang.htm">Đơn Mua</a></div>
            </div>
        </div>
        <div class="r_taikhoan">
            <div class="box-head-user head-trangthai">
                <div class="item-trangthai active">
                	<a href="#chothanhtoan"> Đơn hàng mới</a>
                </div>
                <div class="item-trangthai">
                	<a href="#cholayhang"> Chuẩn bị hàng</a>
                </div>
                <div class="item-trangthai">
                	<a href="#danggiao"> Đang giao</a>
                </div>
                <div class="item-trangthai">
                	<a href="#dagiao"> Đã giao</a>
                </div>
                <div class="item-trangthai">
                	<a href="#dahuy"> Đã hủy</a>
                </div>
            </div>
            <div class="box-update-user box-donhang">     
            	<div id="chothanhtoan" class="item-donhang active">
            		<?php foreach($row_chothanhtoan as $k){
                        $d->reset();
                        $sql_detail = "select * from #_order_detail where id_order='".$k['id']."'";
                        $d->query($sql_detail);
                        $row_detail = $d->result_array();
                    ?>
                        <?php foreach($row_detail as $key =>$v){
                            $pid=$v['id_product'];
                            $psize=$v['size'];
                            $pmau=$v['mau'];
                            $pphoto=get_thumb($pid);
                            $size = get_size($pid,$psize);
                            $tongtien+= $v['gia']*$v['soluong'];
                           
                        ?>
                            <div class="row_donhang">
                                <div class="row_1">
                                    <div class="col1_donhang">
                                       <div class="img-donhang">
                                           <img src="<?=_upload_product_l?><?=$pphoto?>">
                                       </div> 
                                       <div class="info_donhang">
                                            <p class="tensp_dh"><a href="san-pham/<?=changeTitle(get_product_name($v['id_product']));?>.html"><?=get_product_name($v['id_product']);?></a></p>
                                            <?php if($size){?><p class="size_dh">Size: <?=$size?></p><?php } ?>
                                            <?php if($pmau){?><p class="mau_dh">Màu: <?=$pmau?></p><?php } ?>
                                            <p class="sl_dh">Số lượng: <?=$v['soluong']?></p>
                                       </div>
                                    </div>
                                    <div class="col2_donhang">
                                        <?=number_format($v['gia'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                    <div class="col3_donhang">
                                        <?=number_format($v['gia']*$v['soluong'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                </div>
                                <div class="row_2">
                                    <div class="tongiadonhang">
                                        <?php if($k['tienship']){?>
                                        <p>Phí vận chuyển: <span><?=number_format($k['tienship'],0, ',', '.')?>&nbsp;VNĐ</span></p><?php } ?>
                                        <p>Tổng tiền: <span><?=number_format(($k['tienship']+get_tong_tien($k['id'])),0, ',', '.')?>&nbsp;VNĐ</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
            	</div>
            	<div id="cholayhang" class="item-donhang">
            		<?php foreach($row_cholayhang as $k){
                        $d->reset();
                        $sql_detail = "select * from #_order_detail where id_order='".$k['id']."'";
                        $d->query($sql_detail);
                        $row_detail = $d->result_array();
                    ?>
                        <?php foreach($row_detail as $key =>$v){
                            $pid=$v['id_product'];
                            $psize=$v['size'];
                            $pmau=$v['mau'];
                            $pphoto=get_thumb($pid);
                            $size = get_size($pid,$psize);
                            $tongtien+= $v['gia']*$v['soluong'];
                           
                        ?>
                            <div class="row_donhang">
                                <div class="row_1">
                                    <div class="col1_donhang">
                                       <div class="img-donhang">
                                           <img src="<?=_upload_product_l?><?=$pphoto?>">
                                       </div> 
                                       <div class="info_donhang">
                                            <p class="tensp_dh"><a href="san-pham/<?=changeTitle(get_product_name($v['id_product']));?>.html"><?=get_product_name($v['id_product']);?></a></p>
                                            <?php if($size){?><p class="size_dh">Size: <?=$size?></p><?php } ?>
                                            <?php if($pmau){?><p class="mau_dh">Màu: <?=$pmau?></p><?php } ?>
                                            <p class="sl_dh">Số lượng: <?=$v['soluong']?></p>
                                       </div>
                                    </div>
                                    <div class="col2_donhang">
                                        <?=number_format($v['gia'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                    <div class="col3_donhang">
                                        <?=number_format($v['gia']*$v['soluong'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                </div>
                                <div class="row_2">
                                    <div class="tongiadonhang">
                                        <?php if($k['tienship']){?>
                                        <p>Phí vận chuyển: <span><?=number_format($k['tienship'],0, ',', '.')?>&nbsp;VNĐ</span></p><?php } ?>
                                        <p>Tổng tiền: <span><?=number_format(($k['tienship']+get_tong_tien($k['id'])),0, ',', '.')?>&nbsp;VNĐ</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
            	</div>
            	<div id="danggiao" class="item-donhang">
            		<?php foreach($row_danggiao as $k){ 
                        $d->reset();
                        $sql_detail = "select * from #_order_detail where id_order='".$k['id']."'";
                        $d->query($sql_detail);
                        $row_detail = $d->result_array();
                    ?>
                        <?php foreach($row_detail as $key =>$v){
                            $pid=$v['id_product'];
                            $psize=$v['size'];
                            $pmau=$v['mau'];
                            $pphoto=get_thumb($pid);
                            $size = get_size($pid,$psize);
                            $tongtien+= $v['gia']*$v['soluong'];
                           
                        ?>
                            <div class="row_donhang">
                                <div class="row_1">
                                    <div class="col1_donhang">
                                       <div class="img-donhang">
                                           <img src="<?=_upload_product_l?><?=$pphoto?>">
                                       </div> 
                                       <div class="info_donhang">
                                            <p class="tensp_dh"><a href="san-pham/<?=changeTitle(get_product_name($v['id_product']));?>.html"><?=get_product_name($v['id_product']);?></a></p>
                                            <?php if($size){?><p class="size_dh">Size: <?=$size?></p><?php } ?>
                                            <?php if($pmau){?><p class="mau_dh">Màu: <?=$pmau?></p><?php } ?>
                                            <p class="sl_dh">Số lượng: <?=$v['soluong']?></p>
                                       </div>
                                    </div>
                                    <div class="col2_donhang">
                                        <?=number_format($v['gia'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                    <div class="col3_donhang">
                                        <?=number_format($v['gia']*$v['soluong'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                </div>
                                <div class="row_2">
                                    <div class="tongiadonhang">
                                        <?php if($k['tienship']){?>
                                        <p>Phí vận chuyển: <span><?=number_format($k['tienship'],0, ',', '.')?>&nbsp;VNĐ</span></p><?php } ?>
                                        <p>Tổng tiền: <span><?=number_format(($k['tienship']+get_tong_tien($k['id'])),0, ',', '.')?>&nbsp;VNĐ</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
            	</div>
            	<div id="dagiao" class="item-donhang">
            		<?php foreach($row_dagiao as $k){
                        $d->reset();
                        $sql_detail = "select * from #_order_detail where id_order='".$k['id']."'";
                        $d->query($sql_detail);
                        $row_detail = $d->result_array();
                    ?>
                        <?php foreach($row_detail as $key =>$v){
                            $pid=$v['id_product'];
                            $psize=$v['size'];
                            $pmau=$v['mau'];
                            $pphoto=get_thumb($pid);
                            $size = get_size($pid,$psize);
                            $tongtien+= $v['gia']*$v['soluong'];
                           
                        ?>
                            <div class="row_donhang">
                                <div class="row_1">
                                    <div class="col1_donhang">
                                       <div class="img-donhang">
                                           <img src="<?=_upload_product_l?><?=$pphoto?>">
                                       </div> 
                                       <div class="info_donhang">
                                            <p class="tensp_dh"><a href="san-pham/<?=changeTitle(get_product_name($v['id_product']));?>.html"><?=get_product_name($v['id_product']);?></a></p>
                                            <?php if($size){?><p class="size_dh">Size: <?=$size?></p><?php } ?>
                                            <?php if($pmau){?><p class="mau_dh">Màu: <?=$pmau?></p><?php } ?>
                                            <p class="sl_dh">Số lượng: <?=$v['soluong']?></p>
                                       </div>
                                    </div>
                                    <div class="col2_donhang">
                                        <?=number_format($v['gia'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                    <div class="col3_donhang">
                                        <?=number_format($v['gia']*$v['soluong'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                </div>
                                <div class="row_2">
                                    <div class="tongiadonhang">
                                        <?php if($k['tienship']){?>
                                        <p>Phí vận chuyển: <span><?=number_format($k['tienship'],0, ',', '.')?>&nbsp;VNĐ</span></p><?php } ?>
                                        <p>Tổng tiền: <span><?=number_format(($k['tienship']+get_tong_tien($k['id'])),0, ',', '.')?>&nbsp;VNĐ</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
            	</div>
            	<div id="dahuy" class="item-donhang">
            		<?php foreach($row_dahuy as $k){
                        $d->reset();
                        $sql_detail = "select * from #_order_detail where id_order='".$k['id']."'";
                        $d->query($sql_detail);
                        $row_detail = $d->result_array();
                    ?>
                        <?php foreach($row_detail as $key =>$v){
                            $pid=$v['id_product'];
                            $psize=$v['size'];
                            $pmau=$v['mau'];
                            $pphoto=get_thumb($pid);
                            $size = get_size($pid,$psize);
                            $tongtien+= $v['gia']*$v['soluong'];
                           
                        ?>
                            <div class="row_donhang">
                                <div class="row_1">
                                    <div class="col1_donhang">
                                       <div class="img-donhang">
                                           <img src="<?=_upload_product_l?><?=$pphoto?>">
                                       </div> 
                                       <div class="info_donhang">
                                            <p class="tensp_dh"><a href="san-pham/<?=changeTitle(get_product_name($v['id_product']));?>.html"><?=get_product_name($v['id_product']);?></a></p>
                                            <?php if($size){?><p class="size_dh">Size: <?=$size?></p><?php } ?>
                                            <?php if($pmau){?><p class="mau_dh">Màu: <?=$pmau?></p><?php } ?>
                                            <p class="sl_dh">Số lượng: <?=$v['soluong']?></p>
                                       </div>
                                    </div>
                                    <div class="col2_donhang">
                                        <?=number_format($v['gia'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                    <div class="col3_donhang">
                                        <?=number_format($v['gia']*$v['soluong'],0, ',', '.')?>&nbsp;VNĐ
                                    </div>
                                </div>
                                <div class="row_2">
                                    <div class="tongiadonhang">
                                        <?php if($k['tienship']){?>
                                        <p>Phí vận chuyển: <span><?=number_format($k['tienship'],0, ',', '.')?>&nbsp;VNĐ</span></p><?php } ?>
                                        <p>Tổng tiền: <span><?=number_format(($k['tienship']+get_tong_tien($k['id'])),0, ',', '.')?>&nbsp;VNĐ</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
            	</div>
            </div>
        </div>
    </div>

</div>

<style type="text/css">
.head-trangthai{display: flex;justify-content: space-between;padding-bottom: 0px;}
.item-trangthai{width: calc(100% / 5);text-align: center;padding-bottom: 15px;font-family:'RobotoRegular';position: relative;}
.item-trangthai a{font-size:16px;color: #333;}
.item-trangthai.active{position: relative;}
.item-trangthai.active a{color: var(--color-r)}
.item-trangthai:hover a:after{content:"";position: absolute;bottom:-1px;left: 0px;width: 100%;height: 2px;background:var(--color-r);}
.item-trangthai:hover a{color: var(--color-r)}
.item-trangthai.active:after{content:"";position: absolute;bottom:-1px;left: 0px;width: 100%;height: 2px;background:var(--color-r);}
.box-donhang.active{display:block;}
.item-donhang{display:none;}
.item-donhang.active{display:block;}
.row_donhang{padding-bottom:10px;margin-bottom: 10px;border-bottom: 1px solid #eee;display:flex;justify-content: space-between;flex-direction:column;font-family:'RobotoRegular';font-size: 14px;}
.col1_donhang{width:60%;display:flex;}
.col1_donhang img{width: 100%;height: 100%;object-fit:cover;}
.col2_donhang{width:25%;display:flex}
.col2_donhang{width:15%;display:flex}
.row_1{display:flex;justify-content: space-between;}
.img-donhang{width: 100px;height: 100px;margin-right:10px;}
.tongiadonhang{text-align: right;}
.tensp_dh{font-family:'RobotoBold';font-size: 14px;line-height: 16px;}
.col2_donhang,.col3_donhang{font-family:'RobotoBold';color: #000}
.tongiadonhang{font-family:'RobotoRegular';font-size: 16px;color: #000}
.tongiadonhang span{font-family:'RobotoBold';color:#ff0000;}
.info_donhang p{font-family:'RobotoBold';font-size:13px}
</style>
