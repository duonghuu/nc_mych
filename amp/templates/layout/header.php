<?php

	    $d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='logo'";
    $d->query($sql_banner_top);
    $logo_top = $d->fetch_array();
	
	
	$d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='icon_top' and id='107'";
    $d->query($sql_banner_top);
    $icon_cart = $d->fetch_array();
	
	
		$d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='icon_top' and id='108'";
    $d->query($sql_banner_top);
    $icon_login = $d->fetch_array();
	
			$d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='icon_top' and id='109'";
    $d->query($sql_banner_top);
    $icon_register = $d->fetch_array();
	
?>
<header itemscope itemtype="https://schema.org/WPHeader">
    <div class="list_top clearfix">
        <a href="/gio-hang.html"><?=$lang_arr["giohang"]?></a>
        <a href="/tai-khoan.html" >
        <?php if(isset($_SESSION["login"]['thanhvien'])){?>
            Xin chào, <?=$_SESSION['login']['ten']?>
			 <a href="dang-xuat.htm" title="Đăng xuất">Đăng xuất</a>
        <?php }else{?>
            <?=$lang_arr["taikhoan"]?>
        <?php }?>
        </a>
        
    </div>
	<div id="logo" class="clearfix">
		<amp-img src="/<?=_upload_hinhanh_l.$logo_top['photo_vi']?>" width="140" height="70"></amp-img>
	</div>
	<div id="header_fix" class="clearfix">
        <div class="header_fix_box clearfix">
            <button class="navmenu_link" title="Thanh điều hướng website" on='tap:sidebar.toggle'><i class="fa fa-bars"></i></button>    
            <!-- <a class="search_open"><i class="fa fa-search"></i></a>   -->
        </div>
        <!--------------- /Khung Tìm kiếm ------------------>
        <div class="search_box_hide">
            <form action="/index.php" method="get" name="frm_search" id="frm_search" target="_top">
                <input type="hidden" name="com" value="search" />
	            <input type="text" id="search_input" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." />
                <input type="submit" class="btn_search" id="btnSearch" value="Tìm kiếm" />
	        </form>
        </div>
    </div>
</header> 