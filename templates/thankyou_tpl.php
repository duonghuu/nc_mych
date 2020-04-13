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
    <a class="logomy" href="trang-chu.htm" title="Siêu thị đồ gia dụng My Châu"><img src="<?=_upload_hinhanh_l.$logo_top['photo_vi']?>" alt="MyChau"></a>
    <div class="thanks-info">
        <h3 class="thanks-title">Cảm ơn bạn đã mua hàng tại <?= $row_setting["ten_$lang"] ?>!</h3>
        <p>Mã số đơn hàng của bạn:</p>
        <div class="madon"><span><?= $_SESSION['thanks']["madon"] ?></span></div>
        <div class="shiptime">
        <i class="fa fa-truck" aria-hidden="true"></i> Giao hàng tiêu chuẩn: thời gian giao hàng dự kiến <?= $giao_thu ?>, <?= $giao_ngaythang ?>
        </div>
        <div class="thanks-note">
        Thông tin chi tiết về đơn hàng đã được gửi đến địa chỉ mail <span><?= $_SESSION['thanks']["email"] ?></span>. Nếu không tìm thấy, vui lòng kiểm tra trong hộp thư <strong>Spam</strong> hoặc <strong>Junk Folder</strong>.
        </div>
        <div class="thanks-note2">
        <i class="fa fa-info-circle" aria-hidden="true"></i> <?= $textxacnhan["noidung_$lang"] ?>
        </div>
    </div>
</div>
</div>