<?php
	if($_GET['loai']=='dang-tin'){
			$_SESSION['tag_load'] = 'dangtin';
	} elseif($_SESSION['tag_load']=='' || $_GET['thanhvien'] != $_SESSION['login']['thanhvien']){
			$_SESSION['tag_load'] = 'ttcanhan';
	}
	
	$d->reset();
	$sql = "select id from #_product where hienthi=1 and thanhvien='".$_SESSION['login']['mathanhvien']."' order by stt,id desc";
	$d->query($sql);
	$tindadang = $d->result_array();

  $d->reset();
  $sql = "select id from #_product where hienthi=0 and thanhvien='".$_SESSION['login']['mathanhvien']."' order by stt,id desc";
  $d->query($sql);
  $tinchoduyet = $d->result_array();
	
?>
<link href="css/canhan.css" type="text/css" rel="stylesheet" />
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	var thanhvien = '<?=$_GET['mathanhvien']?>';
	$('#load_tin').load('ajax_thongtin/<?=$_SESSION['tag_load']?>.php?thanhvien='+thanhvien);
	$('.tag_canhan li,.dangtin,.thongbao,.tt_xacthuc').click(function(e) {
		$('.tag_canhan li a').removeClass('active');
		$(this).find('a').addClass('active');
		var cls = $(this).attr('class');
		$('#load_tin').load('ajax_thongtin/'+cls+'.php?thanhvien='+thanhvien);
        return false;
  });
  
});
</script>
<script type="text/javascript" src="admin/tiny_mce/tiny_mce.js"></script>
<div id="info">
    <div id="sanpham">
        <div class="thanhsp"><h2>Trang cá nhân</h2></div>
        <div class="khung">
          
        <div class="canhan col-md-3 col-sm-3 col-xx-12 col-xs-12">
        <div class="menu_left">
        <div class="right">
          <ul>
            	<li class="avata"><a href="tai-khoan/<?=$thanhvien[0]['mathanhvien']?>/<?=bodautv($thanhvien[0]['hoten'])?>"><img src="<?=_upload_thanhvien_l.$thanhvien[0]['photo']?>" alt="<?=$thanhvien[0]['hoten']?>" /></a></li>
              <li><p><h2><?=$thanhvien[0]['hoten']?></h2></p></li>
              <li><b>Thành viên từ : </b><p><?=date('d/m/Y - g:i A',$thanhvien[0]['ngaytao']);?></p></li>
              <li><b>Họ Tên :</b> <?=$thanhvien[0]['hoten']?></li>
              <li><b>Địa chỉ :</b> <?=$thanhvien[0]['diachi']?></li>
              <li><b>Điện Thoại :</b> <?=$thanhvien[0]['dienthoai']?></li>
              <li><b>Email :</b> <?=$thanhvien[0]['email']?></li>
          </ul>
        </div>
        </div>
        </div>
          
        <div class="thong_canhan col-md-9 col-sm-9 col-xx-12 col-xs-12">
            <div class="tag_canhan">
                <ul>
                    <li class="ttcanhan"><a href="thong-tin-ca-nhan.html" <?php if($_SESSION['tag_load']=='ttcanhan'){ echo 'class="active"';}?>>Thông Tin Cá Nhân</a></li>
                    <li class="dadang"><a href="tin-da-dang.html" <?php if($_SESSION['tag_load']=='dadang'){ echo 'class="active"';}?>>Tin Đã Đăng ( <?=count($tindadang)?> ) </a></li>
                     <li class="choduyet"><a href="dang-cho-duyet.html" <?php if($_SESSION['tag_load']=='choduyet'){ echo 'class="active"';}?>>Đang chờ duyệt ( <?=count($tinchoduyet)?> )</a></li>
                </ul>
            </div>
            <div id="load_tin"> </div>
        </div>
          
		  </div>
    </div>
</div>
