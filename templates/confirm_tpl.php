<div class="checkout-main">
<div class="checkout-address-selection">
   
    <h5>Địa chỉ nhận hàng</h5>
    <p>
        <?= $_SESSION['thanks']["diachi"] ?>
        <?= (!empty($_SESSION['thanks']["id_tinh"]))?", ".$_SESSION['thanks']["id_tinh"].", ":"" ?>
        <?= (!empty($_SESSION['thanks']["id_huyen"]))?", ".$_SESSION['thanks']["id_huyen"].", ":"" ?>
    </p>
</div>
<div class="thankyou-bg">
  <?php
$a_xulygiao =$_SESSION['thanks']["tggiao"];
// Array
// (
//     [0] => 87
//     [1] => 88
// )
if(!empty($a_xulygiao)){
$a_truncate = array_unique($a_xulygiao);
$d->reset();
$d->setTable("baiviet");
$d->setWhere("id in (".implode(',',$a_truncate).")");
$d->select("giaban");
$result=array_column($d->result_array(),'giaban');
$max_day = max($result);
if(empty($result)){
    $max_day=10;
}
$giao_ngaythang = date('d/m', strtotime("+".$max_day." days"));
$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
$giao_thu = $thu['vi'][date('w',strtotime("+".$max_day." days"))];
}
   ?>
<div class="thankyou-flex">
    <?php /* <a class="logomy" href="trang-chu.htm" title="Siêu thị đồ gia dụng My Châu"><img src="<?=_upload_hinhanh_l.$logo_top['photo_vi']?>" alt="MyChau"></a> */?>
    <div class="thanks-info">
        <?php /* <h3 class="thanks-title">Cảm ơn bạn đã mua hàng tại <?= $row_setting["ten_$lang"] ?>!</h3> */?>
        <p>Mã số đơn hàng của bạn:</p>
        <div class="madon"><span><?= $_SESSION['thanks']["madon"] ?></span></div>
        <div class="shiptime">
        <i class="fa fa-truck" aria-hidden="true"></i> Giao hàng tiêu chuẩn: thời gian giao hàng dự kiến <?= $giao_thu ?>, <?= $giao_ngaythang ?>
        </div>
        <?php /* <div class="thanks-note">
                Thông tin chi tiết về đơn hàng đã được gửi đến địa chỉ mail <span><?= $_SESSION['thanks']["email"] ?></span>. Nếu không tìm thấy, vui lòng kiểm tra trong hộp thư <strong>Spam</strong> hoặc <strong>Junk Folder</strong>.
                </div> */?>
        <div class="thanks-note2">
        <i class="fa fa-info-circle" aria-hidden="true"></i> <?= $textxacnhan["noidung_$lang"] ?>
        </div>
    </div>
</div>
</div>
<div class="checkout-product-ordered-list">
    <div class="checkout-product-ordered-list__headers">
        <div class="mycheckout col1"><strong>Sản phẩm</strong></div>
        <div class="mycheckout col2"><span>Đơn giá</span></div>
        <div class="mycheckout col3"><span>Số lượng</span></div>
        <div class="mycheckout col4"><span>Thành tiền</span></div>
    </div>
    <div class="checkout-product-ordered-list-item__items">
<?php foreach($_SESSION['cart'] as $k=>$v){
    $code = $k;
    $pid=$v['productid'];
    $q=$v['qty'];
    $pgia=$v['gia'];
    $pname=get_product_name($pid);
    if($q==0) continue;
 ?>
        <div class="checkout-product-ordered-list-item__item">
            <div class="mycheckout col1"><div class="checkout-product-ordered-list-item__header checkout-product-ordered-list-item__header--product"><img src="upload/product/<?=get_thumb2($pid)?>" onerror="this.src='http://placehold.it/115x150';" width="40" height="40"><span><?= $pname ?></span></div></div>
            <div class="mycheckout col2"><span><?=number_format(get_gia($pid,$pgia),0, ',', '.')?>&nbsp;đ</span></div>
            <div class="mycheckout col3"><span><?= $q ?></span></div>
            <div class="mycheckout col4"><span><?=number_format(get_gia($pid,$pgia)*$q,0, ',', '.')?>&nbsp;đ</span></div>
        </div>
    <?php } ?>
    </div>
    
    
</div>
<div class="checkout-transport">
    <div class="mycheckout col1"><span>Đơn vị vận chuyển:</span></div>
    <div class="mycheckout col2"><span>Giao hàng tiết kiệm</span></div>
    <div class="mycheckout col3"><span>Nhận hàng vào <?= $giao_thu ?>, <?= $giao_ngaythang ?></span></div>
    <div class="mycheckout col4"><span><?=number_format(get_order_total(),0, ',', '.')?> đ</span></div>
</div>
<form action="" method="post">
<div class="checkout-payment-method">
    
    <div class="checkout-payment-left">
        <textarea name="noidung" placeholder="Ghi chú" class="form-control" style="height: 150px"></textarea>
    </div>
    <div class="checkout-payment-right">
        <div class="checkout-line"><span class="line-span-1">Tổng tiền hàng</span> <span class="line-span-2"><?=number_format(get_order_total(),0, ',', '.')?> đ</span></div>
        <div class="checkout-line"><span class="line-span-1">Phí vận chuyển</span> <span class="line-span-2"><?=number_format($_SESSION['numbphiship'],0, ',', '.')?> đ</span></div>
        <div class="checkout-line"><span class="line-span-1">Tổng thanh toán:</span> <span class="line-span-2"><?=number_format(get_order_total()+$_SESSION['numbphiship'],0, ',', '.')?> đ</span></div>
        <?php /* <a href="thank-you.html" class="xacnhandon">Xác nhận</a> */?>
        <div class="checkout-line">
            <button type="submit" class="xacnhandon btn btn-primary">Xác nhận</button>
            <input type="hidden" name="nltval" value="1">
            <input type="hidden" name="nlttoken" value="<?= time() ?>">
        </div>
        
    </div>
    
</div></form>
</div>