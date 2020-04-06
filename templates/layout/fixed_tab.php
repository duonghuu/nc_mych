<div class="fixed_tab">
	<div class="flex_tab">
		<a class="item_b_tab"  href="">
			<div class="icon_b_tab"><i class="fa fa-home"></i></div>
			<div class="note_b_tab">trang chủ</div>
		</a>
		<?php if($_SESSION['login']==''){?>
		<a class="item_b_tab btn_login" href="#pop-login">
			<div class="icon_b_tab"><i class="fa fa-user"></i></div>
			<div class="note_b_tab">Đăng nhập</div>
		</a>
		<?php }else{?>
			<div class="item_b_tab">
				<!-- <a class="dangxuat_b" href="dang-xuat.htm" title="Đăng xuất">
					<i class="fa fa-sign-out" aria-hidden="true"></i></a> -->
				<div class="icon_b_tab"><i class="fa fa-user"></i></div>
				<a class="info_user_b note_b_tab" href="don-hang.htm"><?=$_SESSION['login']['email']?></a>
			</div>
		<?php } ?>
		<div class="header"><a href="javascript:void(0)" class="hien_menu"><i class="fa fa-bars"></i></a></div>
		<a class="item_b_tab" href="gio-hang.htm">
			<div class="icon_b_tab"><i class="glyphicon glyphicon-shopping-cart"></i></div>
			<div class="note_b_tab">Giỏ hàng</div>
		</a>
		<a class="item_b_tab click_daxem" href="javascript:void(0)">
			<div class="icon_b_tab"><i class="fa fa-eye" aria-hidden="true"></i></div>
			<div class="note_b_tab">Đã xem</div>
		</a>
	</div>
</div>