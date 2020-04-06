<link href="assets/plugins/nprogress-master/nprogress.css" type="text/css" rel="stylesheet" />
<style type="text/css">
.pro_thuoctinh{margin-top: 5px;}
.pro_thuoctinh select{padding:3px 0px;}
.color select{padding:3px 0px;}
</style>
<?php
if($_REQUEST['command']=='delete' && $_REQUEST['code']!=''){
	remove_product($_REQUEST['code']);
}
else if($_REQUEST['command']=='clear'){
	unset($_SESSION['cart']);
}
else if($_REQUEST['command']=='update'){
	$max=count($_SESSION['cart']);
	$_SESSION['trongluong']=0;
	foreach($_SESSION['cart'] as $k => $v){
		$code = $k;
		$pid=$v['productid'];
		$q=$v['qty'];
		$pgia=$v['gia'];
		$psize=$v['size'];
		$color=$v['mausp'];
		$q=$_REQUEST[$code];
		$weight = get_product_kl($pid)*$q;
		$_SESSION['trongluong'] = $_SESSION['trongluong'] + $weight;
			//echo $q;
		if($q>0 && $q<=999){
			$soluong = str_replace(",", '.', $q);
			$_SESSION['cart'][$code]['qty']=$soluong;
			$_SESSION['cart'][$code]['mausp']=$_REQUEST['mausacsp'.$code];
			$_SESSION['cart'][$code]['size']=$_REQUEST['sizesp'.$code];
			$_SESSION['cart'][$code]['gia']=$_REQUEST['giasp'.$code];
		}
		else{
			$msg='Some products not updated!, quantity must be a number between 1 and 999';
		}
	}
}
?>
<script language="javascript">
	function clear_cart(){
		if(confirm('Bạn có muốn xóa tất giỏ hàng không ?')){
			document.frm_order.command.value='clear';
			document.frm_order.submit();
		}
	}
</script>
<script language="javascript">
	function xoa(code){
		if(confirm('Xóa sản phẩm này ! ')){
			document.frm_order.code.value=code;
			document.frm_order.command.value='delete';
			document.frm_order.submit();
		}
	}
	function update_cart(){
		if(confirm('Cập nhật giỏ hàng của bạn ?')){
			document.frm_order.command.value='update';
			document.frm_order.submit();
		}
	}
</script>
<script>
	$(document).ready(function(e){
		$(document).on("click",".plus, .minus",function(){
			var t=e(this).closest(".w_qty_gh").find(".qty"),n=parseFloat(t.val()),r=parseFloat(t.attr("max")),i=parseFloat(t.attr("min")),s=t.attr("step");
			if(!n||n==""||n=="NaN")n=0;
			if(r==""||r=="NaN")r="";if(i==""||i=="NaN")i=0;
			if(s=="any"||s==""||s==undefined||parseFloat(s)=="NaN")s=1;
			e(this).is(".plus")?r&&(r==n||n>r)?t.val(r):t.val(n+parseFloat(s)):i&&(i==n||n<i)?t.val(i):n>0&&t.val(n-parseFloat(s));
			t.trigger("change")
		});
	});
</script>
<link href="css/giohang.css" rel="stylesheet" type="text/css" />
<div id="info">
	<div id="sanpham" class="pa_top">
		<?php if(count($_SESSION['cart'])){?>
			<form method="post" name="frm_order" action="thanh-toan.htm" enctype="multipart/form-data"  id="frm_order">
				<input type="hidden" name="com" value="thanh-toan" />
				<input type="hidden" name="code" />
				<input type="hidden" name="command" />
				<div class="flex_thanhtoan">
					<div class="l_thanhtoan">
						<div class="content_giohang">
							<div class="tit_messge">Bạn có <?=get_total();?> sản phẩm trong giỏ hàng</div>
							<div class="row_head_gh">
								<div class="col1">Sản phẩm</div>
								<div class="col2">Đơn giá</div>
								<div class="col3">Số tiền</div>
							</div>
							<?php
							function get_color2($pid){
								global $d, $row;
								// $sql = "select mausac from table_product where type='product' and id='".$pid."'";
								// $d->query($sql);
								// $row = $d->fetch_array();
								// return $row['mausac'];
								$sql = "select ten_vi,photo,tenkhongdau,id from table_baiviet where type='product' and id_item='".$pid."'";
								$d->query($sql);
								$row = $d->result_array();
								return $row;
							}
							function get_size2($size_id){
								global $d, $row;
								$sql = "select size from table_product where type='product' and id='".$size_id."'";
								$d->query($sql);
								$row = $d->fetch_array();
								return $row['size'];
							}
							function get_gia2($gia_id){
								global $d, $row;
								$sql = "select gia from table_product where type='product' and id='".$gia_id."'";
								$d->query($sql);
								$row = $d->fetch_array();
								return $row['gia'];
							}
							//session_destroy();
							$max=count($_SESSION['cart']);
							$_SESSION['trongluong']=0;
							//dump($_SESSION['cart']);
							foreach($_SESSION['cart'] as $k=>$v){
								$code = $k;
								$pid=$v['productid'];
								$q=$v['qty'];
								$pgia=$v['gia'];
								$psize=$v['size'];
								$color=$v['mausp'];
								$pname=get_product_name($pid);
								$weight = get_product_kl($pid)*$q;
								$_SESSION['trongluong'] = $_SESSION['trongluong'] + $weight;
								if($color){
										// $d->reset();
										// $sql_detail = "select * from #_mausp where id_product='".$pid."'";
										// $d->query($sql_detail);
										// $row_mausp = $d->result_array();
								}
								$sizes = get_size2($pid); 
								$gias = get_gia2($pid); 
								$sizesp = explode('|',$sizes);
								$giasp = explode('|',$gias);
								if($q==0) continue;
								?>
								<div class="row_cart"> 
									<div class="col1 col1-row-cart">
										<div class="pro_img"><a href="san-pham/<?=changeTitle($pname)?>.html"><img src="upload/product/<?=get_thumb2($pid)?>" onerror="this.src='http://placehold.it/115x150';" /></a></div>
										<div class="group_item_info">
											<div class="pro_name"> <a href="san-pham/<?=changeTitle($pname)?>.html" title="<?=$pname?>"><?=strip_tags(($pname))?> </a></div>
											<div class="w_size_mausac">
												<?php if ($color!='' && $color !='0') {?>
													<div class="color">Màu: 
														<select class="change_mau" name="mausacsp<?=$code?>">
															<?php 
															$colors = get_color2($pid);
																// $arr_mausac = explode('|', $colors);
															for($i=0;$i<count($colors);$i++){
																?>
																<option value="<?=$colors[$i]["ten_vi"]?>" 
																	<?php if($colors[$i]["ten_vi"] == $color){?> 
																		selected="selected" <?php } ?>>
																		<?=$colors[$i]["ten_vi"]?>
																	</option>
																<?php } ?>
															</select>
														</div>
													<?php }?>
													<?php if ($psize!="" && $psize > 0) {?>
														<div class="pro_thuoctinh">Size: 
															<select class="change_size" name="sizesp<?=$code?>">
																<?php//$sizegh =get_size($pid,$psize)?>
																<?php for($i=0;$i<count($sizesp);$i++){?>
																	<option data-gia="<?=$giasp[$i]?>" value="<?=$i+1?>" 
																		<?php if($i+1 == $psize){?> 
																			selected="selected" <?php } ?>>
																			<?=$sizesp[$i]?>
																		</option>
																	<?php } ?>
																</select>
																<input type="hidden" value="<?=$pgia?>" class="giasize" name="giasp<?=$code?>">
															</div>
														<?php }?>
													</div>
													<div class="w_qty_gh">
														<input type="button" class="minus" value="-">
														<input class="input-text qty sluong1 text" title="Qty" size="4" value="<?=$q?>" name="<?=$code?>" id="soluong" max="50" min="1" step="1">
														<input type="button" class="plus" value="+">
													</div>
													<div class="thaotac_cart">
														<span class="update_cart" onclick="update_cart()">Cập nhật</span>
														<span class="delete_cart" onclick="xoa('<?=$code?>')">Xóa</span>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="get_gia"><?=number_format(get_gia($pid,$pgia),0, ',', '.')?>&nbsp;đ</div>
											</div>
											<div class="col3">                
												<div class="tonggia"><?=number_format(get_gia($pid,$pgia)*$q,0, ',', '.')?>&nbsp;đ</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<a href="javascript:void(0)" class="tieptucmua" onclick="window.history.back();">Tiếp tục mua hàng</a>
							</div>
							<div class="r_thanhtoan">
								<div class="p_stick">
									<div class="tit_thanhtoan">Thông tin vận chuyển</div>
									<div class="content_vanchuyen">
										<div class="row_input">
											<label>Họ tên:</label>
											<input type="text" tabindex="1" maxlength="250" value="<?=$thanhvien_tv['ten']?>" placeholder="Họ và tên" name="ten" required="" id="ten" title="Họ tên" autocomplete="name" class="form_control">
										</div>
										<div class="row_input">
											<label>Email:</label>
											<input type="email" tabindex="1" maxlength="250" value="<?=$thanhvien_tv['email']?>" placeholder="Email" name="email" required="" id="email" title="E-mail" autocomplete="name" class="form_control">
										</div>
										<div class="row_input">
											<label>Điện thoại:</label>
											<input type="text" tabindex="3" value="<?=$thanhvien_tv['dienthoai']?>" placeholder="Số điện thoại" name="dienthoai" required="" id="dienthoai" title="Số điện thoại" maxlength="12"  autocomplete="tel" class="form_control">
										</div>
										<div class="row_input">
											<label>Tỉnh/ Thành:</label>
											<select name="id_tinh_nhan" required="" class="form_control tinhthanh-slt " id="id_tinh_nhan">
												<option value="" disabled selected>Chọn Tỉnh/Thành Phố</option>
												<?php 	
										//Load tinh thanh
												$d->reset();
												$sql="select ten from #_place_city where id order by stt,id asc";
												$d->query($sql);
												$tinh = $d->result_array();
												for($i=0,$count_tinh=count($tinh);$i<$count_tinh;$i++) { ?>
													<?php $selected = ($_SESSION['city'] == $tinh[$i]['ten']) ? 'selected="selected"' : '';?>
													<option  value="<?=$tinh[$i]['ten']?>" <?=$selected?> ><?=$tinh[$i]["ten"]?></option>
												<?php } ?>
											</select>
										</div><!--end col-left-tinhthanh-->
										<div class="row_input">
											<label>Quận/ Huyện:</label>
											<select required="" name="id_huyen_nhan" class="form_control pick-street quanhuyen-slt" id="id_huyen_nhan">
												<option value="">Quận/Huyện</option>
											</select>
										</div><!--end col-right-quanhuyen-->
										<div class="row_input">
											<label>Địa chỉ:</label>
											<input type="text" value="<?=$thanhvien_tv['diachi']?>" placeholder="Nhập địa chỉ" name="diachi" required="" id="diachi" autocomplete="tel" class="form_control">
										</div>
										<div class="bottom_r_thanhtoan">
											<div class="row_thanhtoan row_pvc">
												<span>Phí vận chuyển:</span>
												<span class="load_vanchuyen showship"><?=$_SESSION['phiship'] ? $_SESSION['phiship']:" Miễn phí"?></span>
											</div>
											<div class="row_thanhtoan row_total">
												<span>Tổng tiền hàng</span>
												<span class="showtotal"> <?=number_format(get_order_total()+$_SESSION['numbphiship'],0, ',', '.')?> đ</span>
											</div>
										</div>
										<div class="w_bottom">
											<input type="hidden" id="tienship" name="tienship" value="<?=$_SESSION['numbphiship']?>">
											<input name="khoiluong" type="hidden" id="trongluong" value="<?=$_SESSION['trongluong']?>">	
											<input  id="submit_thanhtoan" title='Mua hàng' alt='tiếp tục' type="submit" value="Mua hàng" class="g_muatiep" name="thanhtoan"/>
											<input name="mod" type="hidden" id="mod3">
											<input type="hidden" name="phuongthuc" value="Thanh toán khi nhận hàng" class="phuongthuc">
											<div class="w_bottom2">
												<div class="payment_amt btn-w2">ATM</div>
												<div class="payment_cod btn-w2">COD</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</form>
				<?php }else{?>
					<div class="alert alert-danger" role="alert" style="font-family:'RobotoBold">
						Chưa có sản phẩm nào trong giỏ hàng!
					</div>
				<?php } ?>
				<?php
				if($ten_error!='')
				{
					echo "*".$ten_error;
					echo '<br/>';
				}
				if($dienthoai_error!='')
				{
					echo "*". $dienthoai_error;
					echo '<br/>';
				}
				if($diachi_error!='')
				{
					echo "*". $diachi_error;
					echo '<br/>';
				}
				if($email_error!='')
				{
					echo "*". $email_error;
					echo '<br/>';
				}
				if($noidung_error!='')
				{
					echo "*". $noidung_error;
					echo '<br/>';
				}
				if($phuongthuc_error!='')
				{
					echo "*". $phuongthuc_error;
					echo '<br/>';
				}
				?>
			</form>
		</div><!--end sanpham-->
	</div><!--end info-->
	<script language="javascript">
		function loadsh(){
			console.log('change');
			var id_city = $('#id_tinh_nhan').val();
			var id_dist = $('#id_huyen_nhan').val();
			var trongluong = $('#trongluong').val();
			var a_test = {id_city:id_city,id_dist:id_dist,trongluong:trongluong};
			console.log(a_test);
			if(id_city!="" && id_dist!=""){
				$.ajax({
					url: 'ajax/loadphiship.php',
					type: 'POST',
					data: {id_city:id_city,id_dist:id_dist,trongluong:trongluong},
					dataType:'json',
					success: function(data){
						$('.showship').html(data.phiship);
						$('.showtotal').html(data.tongorder);
						$('#tienship').val(data.numbphiship);
					}
				});
			}
		}

		$(document).ready(function(e) {
			
			$('#id_tinh_nhan').change(function(){
				var id = $(this).val();
				$.ajax({
					url: 'ajax/loaddist.php',
					type: 'POST',
					data: {id: id},
					success: function(data){
						$('#id_huyen_nhan').html(data);
					}
				});
			});
			if($('.tinhthanh-slt').val()!=''){
				var id = $('.tinhthanh-slt').val();
				$.ajax({
					url: 'ajax/loaddist.php',
					type: 'POST',
					data: {id: id},
					success: function(data){
						$('#id_huyen_nhan').html(data);
					}
				});
			}
			$('#id_huyen_nhan').change(function(event) {
				var obj = $(this);
				var id_dist = obj.val();
				var id_city = $('#id_tinh_nhan').val();
				var trongluong = $('#trongluong').val();
				$.ajax({
					url: 'ajax/loadphiship.php',
					type: 'POST',
					data: {id_city:id_city,id_dist:id_dist,trongluong:trongluong},
					dataType:'json',
					success: function(data){
					//$('.load_vanchuyen').html(data.phiship);
						$('.showship').html(data.phiship);
						$('.showtotal').html(data.tongorder);
						$('#tienship').val(data.numbphiship);
					// $('#tongtien').val(data.tongorder);
					}
				});
			});
			$('.payment_cod').confirm({
				boxWidth: '300px',
				useBootstrap: false,
				columnClass: 'small',
				title: 'Phương thức thanh toán',
				content: 
				'<div class="payment">'+
				'<div class="rowpayment checkout-radio-item" value="Thanh toán khi nhận hàng">'+
				'<i class="checkout-radio-icon fa fa-dot-circle-o"></i> <span>Thanh toán khi nhận hàng</span>'+
				'</div>'+
				'<div class="rowpayment checkout-radio-item" value="Chuyển khoản InternetBanking">'+
				'<i class="checkout-radio-icon fa fa-circle-o"></i> <span>Thanh toán Chuyển khoản</span>'+
				'</div>'+
				'</div>',
				type: 'blue',
				buttons: {
					Thoát: function(){
					}
				},
			});
			$('body').on('click', '.checkout-radio-item', function(){
				var v = $(this).attr('value');
				$('.checkout-radio-item').removeClass('active');
				$('.checkout-radio-item').find('i').removeClass('fa-dot-circle-o').addClass('fa-circle-o');
				$(this).addClass('active');
				$(this).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-dot-circle-o');
				$('.phuongthuc').val(v);
			});
			$('.change_size').change(function(){
				var option = $('option:selected', this).attr('data-gia');
				$('.giasize').val(option);
			});
			setTimeout(function(){ loadsh(); }, 1000);
			
	// 	$('#id_tinh_nhan').change(function(){
	// 	NProgress.start();
	// 	$matinh=$(this).val();
	// 	$.ajax({
	// 			url:'ajax/load_huyen_nhan.htm',
	// 			type:'post',
	// 			data:({matinh:$matinh}),
	// 			success:function(data){
	// 				//console.log(data);
	// 				$ojb=$.parseJSON(data);
	// 				$('#id_huyen_nhan option').not(":first").remove();
	// 				$.each($ojb.tinh,function(index,item){
	// 					$('#id_huyen_nhan').append("<option value="+item.ma_huyen+">"+item.ten+"</option>");
	// 				})
	// 				NProgress.done();
	// 			}
	// 		})
	// 	})
	// 	$('#id_huyen_nhan').change(function(){
	// 	$mahuyengui="0208";
	// 	$mahuyennhan=$('#id_huyen_nhan option:selected').val();
	// 	//$maDV=$('#maDV option:selected').val();
	// 	$maDV=53330;
	// 	$khoiluong=$("#khoiluong").val();
	// 	if ($khoiluong=="")
	// 	{
	// 		$Weight=100;
	// 	}
	// 	else 
	// 	{
	// 		$Weight=$khoiluong;
	// 	}
	// 	//alert($maDV);
	// 	$.ajax({
	// 			url:'ajax/ship-huyen.htm',
	// 			type:'post',
	// 			data:({mahuyengui:$mahuyengui,mahuyennhan:$mahuyennhan,Weight:$Weight,maDV:$maDV}),
	// 			success:function(data){
	// 				$ojb=$.parseJSON(data);
	// 				$("#row_order_shipping .price").html($ojb.ship);
	// 				$(".load_vanchuyen").html($ojb.ship);
	// 				$("#total_thanhtien").html($ojb.all);
	// 				$("#total_money_pay").html($ojb.all);
	// 				$("#tienship").val($ojb.tienship);
	// 				$("#tongtien").val($ojb.total_price);
	// 				$("#huyennhan").val($ojb.mahuyennhan);
	// 				NProgress.done();
	// 			}
	// 		})
	// })
		})
	</script>
	<script src="assets/plugins/nprogress-master/nprogress.js" type="text/javascript" ></script>
<?php /*
	<div class="frame_thanhtoan">
			<div class="payment col-left-PaymentDetail-info">
				<div class="title"><span class="icon">1</span>Địa chỉ nhận hàng</div>
				<div class="content_payment">
					<div class="field">
							<input type="text" tabindex="1" maxlength="250" value="<?=$thanhvien_tv['hoten']?>" placeholder="Họ và tên" name="ten" required="" id="ten" title="Họ và tên người nhận" autocomplete="name" class="form_control">
					</div>
					<div class="field">
							<input type="email" tabindex="1" maxlength="250" value="<?=$thanhvien_tv['email']?>" placeholder="E-mail" name="email" required="" id="email" title="E-mail" autocomplete="name" class="form_control">
					</div>
					<div class="field">
						<input type="text" tabindex="3" value="<?=$thanhvien_tv['dienthoai']?>" placeholder="Số điện thoại" name="dienthoai" required="" id="dienthoai" title="Số điện thoại" maxlength="12"  autocomplete="tel" class="form_control">
					</div>
					<div class="field">
							<div class="col-left-tinhthanh">
								<select name="id_tinh_nhan" required="" class="form_control tinhthanh-slt " id="id_tinh_nhan">
									<option value="">Chọn Tỉnh/Thành Phố</option>
								<?php 
									//Load tinh thanh
									 $d->reset();
									 $sql="select ten from #_place_city where id order by stt,id asc";
									$d->query($sql);
									$tinh = $d->result_array();
									 for($i=0,$count_tinh=count($tinh);$i<$count_tinh;$i++) { ?>
									<option  value="<?=$tinh[$i]['ten'] ?>" ><?=$tinh[$i]["ten"]?></option>
								<?php }?>
			                    </select>
							</div><!--end col-left-tinhthanh-->
							<div class="col-right-quanhuyen">
								   <select required="" name="id_huyen_nhan" class="form_control pick-street quanhuyen-slt" id="id_huyen_nhan">
			                          <option value="">Quận/Huyện</option>
			                        </select>
							</div><!--end col-right-quanhuyen-->
							<div class="clear"></div>
						</div><!--end field-->
					<?php /*	
					<div class="field">
					<select style="width:100%;" required="" name="maDV" class="form_control pick-street quanhuyen-slt" id="maDV">
			            <option value="53330">Hình thức vận chuyển</option>
						 <option value="53330">2 đến 3 ngày</option>
						<?php 
							$d->query("select ten_vi,maDV from #_hinhthucvanchuyen where hienthi=1 order by stt,id desc");
							foreach($d->result_array() as $k=>$v){
						?>
						<option  value="<?= $v['maDV'] ?>"><?= $v['ten_'.$lang] ?></option>
						<?php } ?>
					</select>
					</div>	
						<div class="field">
							<input tabindex="6" rows="2" placeholder="Số nhà, đường phố, tòa nhà, thôn, xã,..." value="<?=$thanhvien_tv['diachi']?>" required="" name="diachi" id="diachi" class="form_control">
						</div>
						<table width="100%" cellspacing="0" cellpadding="0" border="0" class="info_shipping">
                                 <tbody>
                                    <tr style="display: none;" id="loadingListCarrierShipping">
                                       <td>
                                          <div class="loading_data">Đang tải dữ liệu...</div>
                                       </td>
                                    </tr>
                                    <tr id="listCarrierShipping">
                                       <td>
                                          <div class="text " style="float:none;">Phí vận chuyển : <b class="load_vanchuyen"> 0 đ</b></div>
                                          <div class="listFeeShipping "><b style="font-size: 11px; color: #999;">Vui lòng chọn Tỉnh/thành để biết phí giao hàng</b></div>
                                       </td>
                                    </tr>
                                    <tr id="listCarrierShipping">
                                    </tr>
                                 </tbody>
                              </table>
                              <div class="clearfix"></div>
				</div><!--end content_payment-->	
			</div><!--end col-left-PaymentDetail-info-->
			<div class="payment col-center-payment_method">
			<div class="title"><span class="icon">2</span>Hình thức thanh toán</div>
				<div class="content_payment">
					<div id="select_payment">
							 <input type="radio" name="phuongthuc" value="Thanh toán khi nhận hàng" checked> Thanh toán khi nhận hàng<br><br>
							  <input type="radio" name="phuongthuc" value="Chuyển khoản InternetBanking"> Thanh toán Chuyển khoản<br><br>
							<div class="clear"></div>					
						<!--end Code BAOKIM-->
					</div><!--end select_payment-->
				</div><!--end content_payment-->
			</div><!--end col-center-payment_method-->
			<div class="payment col-right-payment_bill">
			<div class="title">
					<span class="icon"><i class="icon_bill"></i></span>Hóa đơn mua hàng
				</div>
				<div class="content_payment">
				<?php
				//print_r($_SESSION['cart']);
			if(is_array($_SESSION['cart'])){
            	echo '';
				$max=count($_SESSION['cart']);
				$trongluong=0;
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
						$q=$_SESSION['cart'][$i]['qty'];
						$pgia=$_SESSION['cart'][$i]['gia'];
						$psize=$_SESSION['cart'][$i]['size'];
						$color=$_SESSION['cart'][$i]['mausp'];
						$pname=get_product_name($pid);
						$weight = get_product_kl($pid)*$q;
						$trongluong = $trongluong + $weight;
					if($q==0) continue;
			?>
				<div class="item_cart">
                    <div class="pro_img"><a href="san-pham/<?=changeTitle($pname)?>.html"><img src="upload/product/<?=get_thumb($pid)?>" width="120"  /></a></div>
					<div class="group_item_info">
					<div class="pro_name"> <a href="san-pham/<?=changeTitle($pname)?>.html" title="<?=$pname?>"><?=strip_tags(($pname))?> </a></div>
					<?php if ($psize!="" || $psize>0) {?>
            		<div class="pro_thuoctinh"><?=get_size($pid,$psize)?></div>
					<?php }?>
					<?php if ( $color!=0) {?>
            		<div class="color"><?=$color?></div>
					<?php }?>
                    <div class="get_gia">Giá bán: <b><?=number_format(get_gia($pid,$pgia),0, ',', '.')?>&nbsp;vnđ</b></div>
                    <div class="quality">Số lượng: <b><?=$q?></b></div>                    
                    <div class="tonggia">Thành tiền: <b><?=number_format(get_gia($pid,$pgia)*$q,0, ',', '.')?>&nbsp;vnđ</b></div>
                     <div class="delete_cart"><img src="img/delete.png" border="0" onclick="xoa(<?=$pid?>)"  /></div>
            		</div>
					<div class="clear"></div>
				</div><!--end item_cart-->		
            <?php }?>
			<?php //echo ($khoiluong); ?>
              <div class="tonggia_donhang">
				  <div class="tonggia">
					  <b>Tổng giá : <?=number_format(get_order_total(),0, ',', '.')?> đ</b>
				 </div><!--end tonggia-->
             </div><!--end tonggia_donhang-->  
             <div class="showship-total">
             	<p class="showship">
				 	Phí vận chuyển: <span>0 đ</span>
				 </p>
				 <p class="showtotal">
				 	Tổng thanh toán: <span><?=number_format(get_order_total(),0, ',', '.')?> đ</span>
				 </p>
             </div> 
			<?php } else{
				echo "<tr bgColor='#FFFFFF'><td>Bạn Không có sản phẩm nào trong giỏ hàng</td>";
				}
			?>
				</div><!--end content_payment-->
			</div><!--end col-right-payment_bill-->
			<div class="clear"></div>
				<div class="btn_submit_thanhtoan">
				  	<input type="hidden" id="tienship" name="tienship" value="">
					<input name="khoiluong" type="hidden" id="trongluong" value="<?=$trongluong?>">	
					<input  id="submit_thanhtoan" title='tiếp tục' alt='tiếp tục' align="right" type="submit" name="next" value="Thanh Toán" style="cursor:pointer;" style="padding:2px;" class="g_muatiep"/>
					<input name="mod" type="hidden" id="mod3">
				</div><!--end btn_submit_thanhtoan-->
		</div><!--end frame_thanhtoan-->
*/?>