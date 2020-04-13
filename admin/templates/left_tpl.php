<?php 
if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where_daily.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}


?>
<div class="logo"> <a href="#" target="_blank" onclick="return false;"> <img src="images/logo.png"  alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span>Trang chủ</span></a></li>

  <li class="categories_li <?php if($_GET['com']=='city' || ($_GET['type']=='product' && $_GET['com']!='tags') || $_GET['type']=='mausp' || $_GET['type']=='tggiao') echo ' activemenu' ?>" id="menu2"><a href="" title="" class="exp"><span>Sản phẩm</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='mausp') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=mausp">Quản lý màu sản phẩm</a></li>
      <li<?php if($_GET['act']=='man_list') echo ' class="this"' ?>><a href="index.php?com=product&act=man_list&type=product">Quản lý danh mục 1</a></li>
      <li<?php if($_GET['act']=='man_cat') echo ' class="this"' ?>><a href="index.php?com=product&act=man_cat&type=product">Quản lý danh mục 2</a></li> 
      <li<?php if($_GET['act']=='man_item') echo ' class="this"' ?>><a href="index.php?com=product&act=man_item&type=product">Quản lý danh mục 3</a></li>
      <li<?php if($_GET['act']=='man' && $_GET['com']!='order') echo ' class="this"' ?>><a href="index.php?com=product&act=man&type=product">Quản lý sản phẩm</a></li>
     <li<?php if($_GET['type']=='tggiao') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=tggiao">Thời gian giao hàng</a></li>
     <?php /* <li<?php if($_GET['act']=='chonthoigian' && $_GET['com']!='order') echo ' class="this"' ?>><a href="index.php?com=product&act=chonthoigian&type=product">Chọn thời gian giao hàng</a></li> */?>
      <?php if($_SESSION['login_admin']['type']!='daily') { ?>	
    	
    	<li<?php if($_GET['com']=='city') echo ' class="this"' ?> ><a href="index.php?com=city&act=man_list">Quản lý Tỉnh/Thành</a></li>   

    	<li<?php if($_GET['com']=='city') echo ' class="this"' ?> ><a href="index.php?com=city&act=man_cat">Quản lý Quận/Huyện</a></li> 	

      <li<?php if($_GET['type']=='vchuyen') echo ' class="this"' ?>>
      <a href="index.php?com=company&act=capnhat&type=vchuyen" title="">Nội dung vận chuyển</a></li>
      <?php }?>	
    	
	
	   </ul>
  </li>

  <li class="categories_li <?php if($_GET['com']=='order') echo ' activemenu' ?>" id="menu21">
    <a href="index.php?com=order&act=man&tinhtrang=1" title=""><span>Đơn hàng</span></a>
    </li>
    <ul class="sub">
      
    <?php if($_SESSION['login_admin']['type']!='daily') { ?>
      <li<?php if($_GET['type']=='vchuyen') echo ' class="this"' ?>>
      <a href="index.php?com=company&act=capnhat&type=textxacnhan" title="">Text xác nhận đơn hàng</a></li>
    <?php } ?>
    </ul>
      <?php /* if($_SESSION['login_admin']['type']!='daily') { ?>  
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='1') echo ' class="this"' ?> ><a href="index.php?com=order&act=man&tinhtrang=1">Chờ thanh toán</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='2') echo ' class="this"' ?> ><a href="index.php?com=order&act=man&tinhtrang=2">Chờ lấy hàng</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='3') echo ' class="this"' ?> ><a href="index.php?com=order&act=man&tinhtrang=3">Đang giao</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='4') echo ' class="this"' ?> ><a href="index.php?com=order&act=man&tinhtrang=4">Đã giao</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='5') echo ' class="this"' ?> ><a href="index.php?com=order&act=man&tinhtrang=5">Đã hủy</a></li>
      <?php } else {?> 
          <li <?php if($_GET['com']=='order_daily' && ($_GET["tinhtrang"]=="1" || $_GET["act"]=="edit" ) ) echo ' class="this"' ?>><a href="index.php?com=order_daily&act=man&tinhtrang=1">Chờ thanh toán</a></li>
          <li <?php if($_GET['com']=='order_daily' && ($_GET["tinhtrang"]=="2" || $_GET["act"]=="edit" ) ) echo ' class="this"' ?>><a href="index.php?com=order_daily&act=man&tinhtrang=2">Chờ lấy hàng</a></li>
          <li <?php if($_GET['com']=='order_daily' && ($_GET["tinhtrang"]=="3" || $_GET["act"]=="edit" ) ) echo ' class="this"' ?>><a href="index.php?com=order_daily&act=man&tinhtrang=3">Đang giao</a></li>
          <li <?php if($_GET['com']=='order_daily' && ($_GET["tinhtrang"]=="4" || $_GET["act"]=="edit" ) ) echo ' class="this"' ?>><a href="index.php?com=order_daily&act=man&tinhtrang=4">Đã giao</a></li>
          <li <?php if($_GET['com']=='order_daily' && ($_GET["tinhtrang"]=="5" || $_GET["act"]=="edit" ) ) echo ' class="this"' ?>><a href="index.php?com=order_daily&act=man&tinhtrang=5">Đã hủy</a></li>   

      <?php }*/ ?>
   

  

  <li class="categories_li <?php if($_GET['type']=='deal-gia-soc' || $_GET['type']=='baiviet') echo ' activemenu' ?>" id="menu13"><a href="" title="" class="exp"><span>Chương trình</span><strong></strong></a>
    <ul class="sub">
       <li<?php if($_GET['type']=='deal-gia-soc') echo ' class="this"' ?>><a href="index.php?com=product&act=man&type=deal-gia-soc">Deal giá sốc</a></li>


      <li<?php if($_GET['type']=='baiviet') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=baiviet">Dưới Deal giá sốc</a></li>


    </ul>
  </li>

  <li class="categories_li <?php if($_GET['com']=='tags' || $_GET['type']=='logo' || $_GET['type']=='facebook' || 
  $_GET['type']=='slider' ||  $_GET['type']=='banner_sl' ||  $_GET['type']=='banner_qc') 
  echo ' activemenu' ?>" id="menu11"><a href="" title="" class="exp"><span>Top</span><strong></strong></a>
    <ul class="sub">
        <li<?php if($_GET['type']=='logo') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=logo" title="">Logo</a></li>

        <li<?php if($_GET['com']=='tags') echo ' class="this"' ?>><a href="index.php?com=tags&act=man&type=product">Quản lý tags từ khóa</a></li>

         <li<?php if($_GET['type']=='facebook') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=facebook" title="">Share mạng xã hội</a></li>

         <li<?php if($_GET['type']=='slider') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slider" title="">Hình ảnh slider</a></li>
         <li<?php if($_GET['type']=='banner_sl') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=banner_sl" title="">Banner Phải slider</a></li>
         

         <li<?php if($_GET['type']=='banner_qc') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=banner_qc" title="">Banner quảng cáo</a></li>
    </ul>
  </li>

  <li class="categories_li <?php if($_GET['type']=='gioithieu' || $_GET['type']=='hotrokhachhang'  
  || $_GET['type']=='img-thanhtoan' || $_GET['type']=='img-vanchuyen' || $_GET['type']=='img-bocongthuong' 
  || $_GET['com']=='setting' || $_GET['com']=='newsletter'  || $_GET['com']=='company'
   || $_GET['com']=='album')
   echo ' activemenu' ?>" id="menu12"><a href="" title="" class="exp"><span>Bottom</span><strong></strong></a>
    <ul class="sub">
        <li<?php if($_GET['type']=='gioithieu') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=gioithieu">Quản lý giới thiệu</a></li>
        <li<?php if($_GET['type']=='hotrokhachhang') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=hotrokhachhang">Quản lý hỗ trợ khách hàng</a></li>

        <li<?php if($_GET['type']=='img-thanhtoan') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=img-thanhtoan" title="">Hình ảnh thanh toán</a></li>

        <li<?php if($_GET['type']=='img-vanchuyen') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=img-vanchuyen" title="">Hình ảnh đơn vị</a></li>

        <li<?php if($_GET['type']=='img-bocongthuong') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=img-bocongthuong" title="">Bộ công thương</a></li>

         <li<?php if($_GET['type']=='popup') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=popup" title="">Popup</a></li>

         <li<?php if($_GET['type']=='van-chuyen') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=van-chuyen" title="">Hình thức giao hàng</a></li>

        <!-- <li<?php if($_GET['type']=='lienhe') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=lienhe" title="">Liên hệ</a></li> -->
        <li<?php if($_GET['type']=='footer') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=footer" title="">Footer</a></li>
        <li<?php if($_GET['com']=='setting') echo ' class="this"' ?>><a href="index.php?com=setting&act=capnhat" title="">Cấu hình chung</a></li>
        <li<?php if($_GET['com']=='newsletter') echo ' class="this"' ?>><a href="index.php?com=newsletter&act=man" title="">Mail nhận tin</a></li>
    </ul>
  </li>


  <?php if($_SESSION['login_admin']['type']!='daily') { ?>
     <li class="<?php if($_SESSION['login_admin']['type']=='daily') echo 'hidden-an' ?> categories_li<?php 
     if($_GET['com']=='daily' || $_GET['com']=='user_daily') echo ' activemenu' ?>" id="menu10"><a href="" title="" class="exp"><span>Đại lý</span><strong></strong></a>
      <ul class="sub"> 
        <li <?php if( $_GET["com"]=="daily") echo ' class="this"' ?>><a href="index.php?com=daily&act=man_list">Quản lý thông tin đại lý</a></li> 
        <li <?php if($_GET['com']=='user_daily') echo ' class="this"' ?>><a href="index.php?com=user_daily&act=man">Tài khoản đăng nhập của đại lý</a></li>
      </ul>
  </li>
  
  <?php /*<li class="categories_li <?php if($_GET['com']=='baiviet') echo ' activemenu' ?>" id="menu_bv"><a href="" title="" class="exp"><span>Bài viết</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='header') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=header">Quản lý bài viết header</a></li>
   

     
    </ul>
  </li>*/?>

  <?php /* <li class="template_li<?php if($_GET['com']=='setting' || $_GET['com']=='newsletter'  || $_GET['com']=='company'
     || $_GET['com']=='album') echo ' activemenu' ?>" id="menu5"><a href="#" title="" class="exp"><span>
     Thông tin công ty</span><strong></strong></a>
      <ul class="sub">
         <li<?php if($_GET['type']=='popup') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=popup" title="">Popup</a></li>
  
         <li<?php if($_GET['type']=='van-chuyen') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=van-chuyen" title="">Hình thức giao hàng</a></li>
  
        <!-- <li<?php if($_GET['type']=='lienhe') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=lienhe" title="">Liên hệ</a></li> -->
        <li<?php if($_GET['type']=='footer') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=footer" title="">Footer</a></li>
        <li<?php if($_GET['com']=='setting') echo ' class="this"' ?>><a href="index.php?com=setting&act=capnhat" title="">Cấu hình chung</a></li>
        <li<?php if($_GET['com']=='newsletter') echo ' class="this"' ?>><a href="index.php?com=newsletter&act=man" title="">Mail nhận tin</a></li>
      </ul>
    </li> */?>

  <?php /* <li class="gallery_li<?php if($_GET['type']=='slider' ||  $_GET['type']=='banner_sl' ||  $_GET['type']=='banner_qc') 
  echo ' activemenu' ?>" id="menu7"><a href="#" title="" class="exp"><span>Hình Ảnh - Slider</span><strong></strong></a>
      <ul class="sub">
     
       <!-- <li<?php if($_GET['type']=='icon_top') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=icon_top" title="">Quản Lý Icon Top</a></li> -->
    
        <li<?php if($_GET['type']=='slider') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slider" title="">Hình ảnh slider</a></li>
        <li<?php if($_GET['type']=='banner_sl') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=banner_sl" title="">Banner Phải slider</a></li>
    
  
        <li<?php if($_GET['type']=='banner_qc') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=banner_qc" title="">Banner quảng cáo</a></li>
       
      </ul>
    </li> */?>
  <li class="setting_li<?php if($_GET['com']=='database' || $_GET['com']=='background' || $_GET['com']=='user' || $_GET['com']=='phanquyen') echo ' activemenu' ?>" id="menu8"><a href="#" title="" class="exp"><span>Cấu hình website</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='phanquyen' && $_GET['act']=='man') echo ' class="this"' ?>><a href="index.php?com=phanquyen&act=man">Quản trị phân quyền</a></li>
      
      <li<?php if($_GET['com']=='user' && $_GET['act']=='admin_edit') echo ' class="this"' ?>><a href="index.php?com=user&act=admin_edit">Thông tin Tài khoản</a></li>
      <li><a href="googleshopping.php">Export XML to google shopping</a></li>
       <li<?php if($_GET['com']=='user' && $_GET['act']=='admin') echo ' class="this"' ?>><a href="index.php?com=user&act=man">Thông tin User</a></li>
      <!-- <li<?php if($_GET['com']=='background' && $_GET['type']=='bgweb') echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgweb">Background web</a></li> -->
    </ul>
  </li>
  
  <?php } ?>
  
</ul>