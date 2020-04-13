<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});
</script>
<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=setting&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=setting&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title chonngonngu">
			<ul>
				<li><a href="vi" class="active tipS validate[required]" title="Chọn tiếng việt "><img src="./images/vi.png" alt="" class="tiengviet" />Tiếng Việt</a></li>
				<li><a href="en" class="tipS validate[required]" title="Chọn tiếng anh "><img src="./images/en.png" alt="" class="tienganh" />Tiếng Anh</a></li>
			</ul>
		</div>	
		<div class="formRow lang_hidden lang_vi active">
			<label>Tên Công Ty</label>
			<div class="formRight">
				<input type="text" name="ten_vi" title="Nhập tên công ty" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow lang_hidden lang_en">
			<label>Tên Công Ty (Tiếng anh)</label>
			<div class="formRight">
				<input type="text" name="ten_en" title="Nhập tên công ty" id="ten_en" class="tipS validate[required]" value="<?=@$item['ten_en']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow lang_hidden lang_vi active">
			<label>Slogan</label>
			<div class="formRight">
				<input type="text" name="slogan_vi" title="Nhập slogan" id="slogan_vi" class="tipS validate[required]" value="<?=@$item['slogan_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<!-- <div class="formRow lang_hidden lang_en">
			<label>Slogan (Tiếng anh)</label>
			<div class="formRight">
                <input type="text" name="slogan_en" title="Nhập slogan" id="slogan_en" class="tipS validate[required]" value="<?=@$item['slogan_en']?>" />
			</div>
			<div class="clear"></div>
		</div> -->
		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ email" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Email top</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['emailtop']?>" name="emailtop" title="Nhập địa chỉ email top" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Hotline top</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hotlinetop']?>" name="hotlinetop" title="Nhập hotline" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Hotline</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hotline']?>" name="hotline" title="Nhập số điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <!-- <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập số điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div> -->
		 <!-- <div class="formRow">
			<label>Đặt vé</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['datve']?>" name="datve" title="Nhập số đặt vé" class="tipS" />
			</div>
			<div class="clear"></div>
		</div> -->
		<div class="formRow lang_hidden lang_vi active">
			<label>Địa chỉ</label>
			<div class="formRight">
				<input type="text" name="diachi_vi" title="Nhập địa chỉ công ty" id="diachi_vi" class="tipS validate[required]" value="<?=@$item['diachi_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow lang_hidden lang_en">
			<label>Địa chỉ (Tiếng anh)</label>
			<div class="formRight">
				<input type="text" name="diachi_en" title="Nhập địa chỉ công ty" id="diachi_en" class="tipS validate[required]" value="<?=@$item['diachi_en']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Website</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['website']?>" name="website" title="Nhập địa chỉ website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Tọa độ bản đồ</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['toado']?>" name="toado" title="Nhập tọa độ vị trí công ty" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>FanPage Facebook</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['facebook']?>" name="facebook" title="Nhập link fanpage facebook" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow none">
			<label>Text xác nhận đơn hàng</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['confirmtext']?>" name="confirmtext" title="Nhập text" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- <div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Nội dung footer</h6>
		</div>
		<div class="formRow">
			<label>T2- T7</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['thu2']?>" name="thu2" title="Nhập thời gian làm t2-t7" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Chủ nhật</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['chunhat']?>" name="chunhat" title="Nhập thời gian làm chủ nhật" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Phản Hồi </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['tenph']?>" name="tenph" title="Nhập tên người phản hồi" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Điện thoại </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoaiph']?>" name="dienthoaiph" title="Nhập điện thoại phản hồi" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Email </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['emailph']?>" name="emailph" title="Nhập email phản hồi" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>ĐT Ngoài giờ </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ngoaigio']?>" name="ngoaigio" title="Nhập thời gian nghe điện thoại ngoài h" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
	</div> -->
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Nội dung seo</h6>
		</div>			
		<div class="formRow">
			<label>Title</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title']?>" name="title" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Từ khóa</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Description:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description"><?=@$item['description']?></textarea>
				<input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" name="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 160 ký tự)</b>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Analytics:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Code Analytics" class="tipS" name="analytics"><?=@$item['analytics']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>V chat :</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Code vchat" class="tipS" name="vchat"><?=@$item['vchat']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Tên tài khoản Google+</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['googleplus']?>" name="googleplus" title="Tên public trên Google+" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Tài khoản Google+</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['author']?>" name="author" title="Link tài khoản Google+" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<div class="formRight">
				<input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
				<input type="submit" class="blueB"  value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div> 			
	</div>
</form>   