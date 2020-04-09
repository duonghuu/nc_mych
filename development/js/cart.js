function formatNumber(nStr)//format gia
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
$(document).ready(function() {
  $('.giohang-cl').click(function(event) {
    $('#giohang').removeClass('active');
  });
  $('.ttmh').click(function(event) {
    $('#giohang').removeClass('active');
  });
  $('.xoa_gh').click(function(){
    var root = $(this).parents('.dong_gh');
    var id = root.data('id');
    $.ajax({
      url:"ajax/cart.php",
      dataType:'json',
      type:"POST",
      data:{id:id,act:"delete"},
      success: function(kq){
        root.remove();
        $(".giohang_fix span").html(kq.sl);
        $(".tongtien_gh span").html(kq.tongtien);
      }
    })
  });
  $('.sl_gh').change(function(){
    var root = $(this).parents('.dong_gh');
    var soluong = root.find('.sl_gh').val();
    var vitri = root.data('vitri');
    var id = root.data('id');
    $.ajax({
      url:"ajax/cart.php",
      type:"POST",
      dataType:'json',
      data:{soluong: soluong,vitri:vitri,id:id,act:"update"},
      success: function(kq){
        root.find('.gia_gh').html(kq.tonggia);
        $(".tongtien_gh span").html(kq.tongtien);
      }
    })
  });
  $('.cus-radio-items .cus-radio').click(function(){
    $('.cus-radio-items .cus-radio').removeClass('active');
    $(this).addClass('active');
  });
      $('#thanhpho').change(function(){
        var id_city = $(this).val();
        $.ajax({
          type:'post',
          url:'ajax/place.php',
          data:{act:'dist',id_city:id_city},
          success:function(rs){
            $('#quan').html(rs);
          }
        });
      });
          // $("#quan").change(function(){
          //     $val = $(this).val();
          //     if($val!=''){
          //         $.ajax({
          //             type: "POST",
          //             url: "ajax/cart.php",
          //             dataType: "json",
          //             data: {id:$val, act:"tinhship"},
          //             success: function(data){
          //                 if(data!=''){
          //                     $("input#price_ship").val(data["price_ship"]);
          //                     var price_ship=data;
          //                     $(".show-price-ship").html("Phí vận chuyển: "+formatNumber(data["price_ship"])+' đ');
          //                     $(".tongtien_gh span").html(formatNumber(data["tonggia"])  + ' đ');
          //                     $("#tong_gia").val(data["tonggia"]);
          //                 }else{
          //                     $(".show-price-ship").html("Phí vận chuyển: Miễn phí");
          //                 }
          //                 $(".show-price-ship").show();
          //             }
          //         })
          //     }
          // });
      $('.click_ajax2').click(function(){
        if(isEmpty($('#httt').val(), lang_chonhinhthucthanhtoan))
        {
          $('#httt').focus();
          return false;
        }
        if(isEmpty($('#hoten').val(), lang_nhaphoten))
        {
          $('#hoten').focus();
          return false;
        }
        if(isEmpty($('#dienthoai').val(), lang_nhapsodienthoai))
        {
          $('#dienthoai').focus();
          return false;
        }
        if(isEmpty($('#thanhpho').val(), lang_chontinhthanhpho))
        {
          $('#thanhpho').focus();
          return false;
        }
        if(isEmpty($('#quan').val(), lang_chonquanhuyen))
        {
          $('#quan').focus();
          return false;
        }

        if(isEmpty($('#diachi').val(), lang_nhapdiachi))
        {
          $('#diachi').focus();
          return false;
        }

        if(isEmpty($('#email_lienhe').val(), lang_emailkhonghople))
        {
          $('#email_lienhe').focus();
          return false;
        }
        if(isEmpty($('#noidung').val(), lang_nhapnoidung))
        {
          $('#noidung').focus();
          return false;
        }
        frm_order.submit();
      });
  $('.size').click(function(){
    $('.size').removeClass('active_size');
    $(this).addClass('active_size');
  });
  $('.mausac').click(function(){
    $('.mausac').removeClass('active_mausac');
    $(this).addClass('active_mausac');
  });
  $('.cart_popup').click(function(){
    if($('.size').length && $('.active_size').length==false){
      alert(lang_chonsize);
      return false;
    }
    if($('.active_size').length){
      var size = $('.active_size').html();
    }
    else{
      var size = '';
    }
    if($('.mausac').length && $('.active_mausac').length==false){
      alert(lang_chonmau);
      return false;
    }
    if($('.active_mausac').length){
      var mausac = $('.active_mausac').html();
    }
    else{
      var mausac = '';
    }
    var act = "dathang";
    var id = $(this).data('id');
    var soluong = $('.soluong').val();
    if (soluong == undefined){
      soluong = 1;
    }
    if(soluong>0)
    {
      $.ajax({
       type:'post',
       url:'ajax/cart_popup.php',
       data:{id:id,size:size,mausac:mausac,soluong:soluong,act:act},
       beforeSend: function() {
        $('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
      },
      error: function(){
        alert(lang_hethongloi);
      },
      success:function(kq){
        $('body').append('<div class="wap_giohang"></div>');
        $('.wap_giohang').html(kq);
        $('.popup_donhang').fadeIn(300);
        $('body').append('<div id="baophu"></div>').fadeIn(300);
      }
    });
    }
    else
    {
      alert(lang_nhapsoluong);
    }
    return false;
  });
  $( "body" ).on( "click", ".muangay", function() {
    if($('.size').length && $('.active_size').length==false)
    {
      alert('Chọn size');
      return false;
    }
    if($('.active_size').length)
    {
      var size = $('.active_size').html();
    }
    else
    {
      var size = '';
    }
    if($('.mausac').length && $('.active_mausac').length==false)
    {
      alert('Chọn màu');
      return false;
    }
    if($('.active_mausac').length)
    {
      var mausac = $('.active_mausac').html();
    }
    else
    {
      var mausac = '';
    }
    var act = "dathang";
    var id = $(this).data('id');
    var soluong = $('.soluong').val();
    if(soluong==undefined){
      soluong = 1;
    }
    if(soluong>0)
    {
      $.ajax({
        type:'post',
        url:'ajax/cart.php',
        dataType:'json',
        data:{id:id,size:size,mausac:mausac,soluong:soluong,act:act},
        beforeSend: function() {
          $('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
        },
        error: function(){
          add_popup('Hệ thống bị lỗi, xin quý khách chuyển sang mục khác.');
        },
        success:function(kq){
          location.href = "gio-hang.html";
        }
      });
    }
    else
    {
      alert('Nhập số lượng');
    }
    return false;
  });
  $( "body" ).on( "click", ".dathang", function() {
    if($('.size').length && $('.active_size').length==false)
    {
      alert(lang_chonsize);
      return false;
    }
    if($('.active_size').length)
    {
      var size = $('.active_size').html();
    }
    else
    {
      var size = '';
    }
    if($('.mausac').length && $('.active_mausac').length==false)
    {
      alert(lang_chonmau);
      return false;
    }
    if($('.active_mausac').length)
    {
      var mausac = $('.active_mausac').html();
    }
    else
    {
      var mausac = '';
    }
    var act = "dathang";
    var id = $(this).data('id');
    var soluong = $('.soluong').val();
    if(soluong==undefined){
      soluong = 1;
    }
    if(soluong>0)
    {
      $.ajax({
        type:'post',
        url:'ajax/cart.php',
        dataType:'json',
        data:{id:id,size:size,mausac:mausac,soluong:soluong,act:act},
        beforeSend: function() {
          $('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
        },
        error: function(){
          add_popup(lang_hethongloi);
        },
        success:function(kq){
          // add_popup(kq.thongbao);
          $('.giohang_fix span').html(kq.sl);
          $('.giohang-left-cont').html(kq.thongtin);
          $('.giohang-left-tit span').html(soluong);
          $('.giohang-right-tit span').html(kq.sl);
          $('.giohang-thanhtien span, .giohang-right-tt .ghajax, .giohang-right-total .ghajax').html(kq.tongtien);
          $('#giohang').addClass('active');
        }
      });
    }
    else
    {
      alert(lang_nhapsoluong);
    }
    return false;
  });
});