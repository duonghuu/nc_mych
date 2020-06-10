 var myLazyLoad = new LazyLoad({
  elements_selector: ".lazy"
});

 function js_submit(){
   if(isEmpty(document.getElementById('email'), "Xin nhập email.")){
     document.getElementById('email').focus();
     return false;
   }
   
   if(isEmpty(document.getElementById('pass'), "Xin nhập Password .")){
     document.getElementById('pass').focus();
     return false;
   }
     
   if(!isEmpty(document.dangky.password) && document.dangky.password.value.length<5){
     alert("Mật khẩu phải nhiều hơn 4 ký tự.");
     document.dangky.password.focus();
     return false;
   }
   
   if(!isEmpty(document.dangky.password) && document.dangky.password.value!=document.dangky.renew_pass.value){
     alert("Nhập lại mật khẩu mới không chính xác.");
     document.dangky.renew_pass.focus();
     return false;
   }
             
   if(isEmpty(document.getElementById('ten'), "Xin nhập họ tên .")){
     document.getElementById('ten').focus();
     return false;
   }

   if(isEmpty(document.getElementById('dienthoai'), "Xin nhập Số điện thoại.")){
     document.getElementById('dienthoai').focus();
     return false;
   }
   
   if(!isPhone(($('#dienthoai').val()), "Số điện thoại không hợp lệ.")){
     document.getElementById('dienthoai').focus();
     return false;
   }

   if(isEmpty(document.getElementById('diachi'), "Xin nhập địa chỉ .")){
     document.getElementById('diachi').focus();
     return false;
   }
           
   document.dangky.submit();
 }
 function js_submit_dn(){
   if(isEmpty(document.getElementById('username'), "Xin nhập tên đăng nhập.")){
     document.getElementById('username').focus();
     return false;
   }
   if(isEmpty(document.getElementById('password'), "Xin nhập password.")){
     document.getElementById('password').focus();
     return false;
   }
   document.form_login.submit();
 }

 function delete_mini(codecart){
   if(codecart){
    $.ajax({
     url: 'ajax/load_gh_mini.php',
     type: 'POST',
     async:false,
     dataType: 'json',
     data: {delete:1,codecart:codecart},
     success: function(data) {
       $('#box-gh-mini').html(data.result);
     }
   });
  }
}

function load_list(id){
 $.ajax
 ({
   type: "POST",
   url: "ajax/ajax_loadcat.php",
   data: {id:id},
   success: function(msg)
   {
     $('.box-loadcat').html(msg);         
   }
 });
}
$(document).ready(function() {

  setTimeout(function(){
    $("#loader-wrapper").fadeOut(500);
  },400);
  $(window).scroll(function(){
    if($('body').width() > 992) {           
      if ($(this).scrollTop() > 80) {
        $(".nav-header-top").addClass("header-fixed");
      } else {
        $(".nav-header-top").removeClass("header-fixed");
      }              
    }            
    if($(this).scrollTop()!=0){$('#bttop1').fadeIn();}
    else { $('#bttop1').fadeOut();}
  });
  
  $('#bttop1').click(function(){$('body,html').animate({scrollTop:0},800);  });
  $('body').on('click', '.likebtn', function(e) {
    var s_id = $(this).data("id");
    $.ajax
    ({
      type: "POST",
      url: "ajax/ajax_like.php",
      dataType: 'json',
      data: {id:s_id},
      success: function(kq)
      {
        console.log('a_ds_like: '+kq.a_ds_like);
        console.log('key: '+kq.key);
        console.log('ds: '+kq.ds);
        $('.likebtn[data-id="'+ s_id +'"]').removeClass("active");
        $('.likebtn[data-id="'+ s_id +'"]').addClass(kq.class);
      }
    });

  });
  $('#tabs a').click(function(e) {
    var id = $(this).attr('href');
    $('#tabs li').removeClass('active');
    $(this).parent().addClass('active');
    $('#tab-1,#tab-2,#tab-3,#tab-4').hide(200);
    $('#'+id).slideDown(500);
    return false;
  });
  $('.sp_form').hover(function(){
    $(this).find('.sp_xemnhanh').fadeIn(550);
  },function(){
    $(this).find('.sp_xemnhanh').fadeOut(350);
  });
  $(window).scroll(function() {
    if($(window).scrollTop() != 0) {
      $('.top_index').fadeIn();
    } else {
      $('.top_index').fadeOut();
    }
  });
  $('.top_index').click(function() {
    $('html, body').animate({scrollTop:0},500);
  });
  $(window).scroll(function() {
    if($(window).scrollTop() > 160) {
      $('#header').addClass('fixheader');
    } else {
      $('#header').removeClass('fixheader');
    }
  }); 
    $(".phongto").fancybox({
      maxWidth : 1000,
     maxHeight : 750,
     fitToView : false,
     width   : '100%',
     height    : '75%',
     autoSize  : false,
     closeClick  : false,
     openEffect  : 'none',
     closeEffect : 'none'
    });
  $('.hien_menu').click(function(){
    $('#danhmuc_mb').toggleClass('active');
    if( $('#danhmuc_mb').hasClass('active')){
      $('.hien_menu i').removeClass('fa-bars');
      $('.hien_menu i').addClass('fa-times');
    }else{
      $('.hien_menu i').addClass('fa-bars');
      $('.hien_menu i').removeClass('fa-times');
    }
    return false;
  });
  if($('.item_list.active').length > 0){
    var id = $('item_list.active').attr('data-id');
    load_list(id);
  }
  $('.item_list').hover(function (){ 
    $('.item_list').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('data-id');
    load_list(id);
  });

  $('#load-page-index').click(function(event) {
    var obj = $(this);
    var p = parseInt(obj.attr('data-p'));
    var ia = parseInt(p + 1);
    var item = parseInt(obj.attr('data-item'));
    $('.loading-page1').removeClass('none');
    obj.addClass('none');
    $.ajax({
      url: 'ajax/load-page.php',
      type: 'POST',
      async:false,
      dataType: 'json',
      data: {
        p: p,
        item: item
      },
      success: function(data) {
        if (data.status == 1) {
          setTimeout(function() {
            obj.addClass('none');
            $('.loading-page1').addClass('none');
            obj.attr('data-p', ia);
            $('#project').append(data.result);
            myLazyLoad.update();
          }, 1000);
        } else {
          setTimeout(function() {
            $('.loading-page1').addClass('none');
            obj.attr('data-p', ia);
            obj.removeClass('none');
            $('#project').append(data.result);
            myLazyLoad.update();
          }, 1000);
        }
      }
    });
  });
  $('.cart').hover(function(event) {
    $.ajax({
      url: 'ajax/load_gh_mini.php',
      type: 'POST',
      async:false,
      dataType: 'json',
      data: {delete:0,codecart:''},
      success: function(data) {
        $('#box-gh-mini').html(data.result);
      }
    });
    delete_mini();
  });
  
  $(".btn_login").fancybox({
    beforeShow: function () {
      $('.box-login').addClass('active');
      $('.box-singup').removeClass('active');
    },
  });
  $('.pop-signup').click(function(event) {
    $('.w_user').removeClass('active');
    $('.box-singup').addClass('active');
  });
  $('.pop-login').click(function(event) {
    $('.w_user').removeClass('active');
    $('.box-login').addClass('active');
  });
  $('.click_daxem').click(function(event) {
   $('.daxem').toggle(200);
  });
  $('.close_dx').click(function(event) {
   $(this).parents('.box_daxem').hide();
  });
  $('.dangkymail button').click(function(event) {
   var email = $('.dangkymail input').val();
   if(email==''){
     alert('Bạn chưa nhập email');
     $('.dangkymail input').focus();
   } else {
     $.ajax ({
       type: "POST",
       url: "ajax/dangky_email.php",
       data: {email:email},
       success: function(result) { 
         if(result==0){
           $('.dangkymail input').attr('value','');
           alert('Đăng ký thành công ! ');
           $('.dangkymail input').attr('value','');
         } else if(result==1){
           alert('Email đã được đăng ký ! ');
           $('.dangkymail input').attr('value','');
         } else if(result==2){
           alert(' ! Đăng ký không thành công . Vui lòng thử lại ');
         }
         
       }
     });
   }
  });
  $('.banner_sl-main').slick({
    vertical:true, slidesToShow:2, slidesToScroll: 1, autoplay:true, autoplaySpeed:3000, speed:1000, arrows:true, dots:false

  });
  if(js_template=="product_detail"){
    $('.stat').rater();
   $('.list_thumb').slick({
     vertical:false, slidesToShow:4, slidesToScroll:1, autoplay:true, autoplaySpeed:3000, speed:1000, arrows:false, dots:false, responsive: [
     {breakpoint: 992, settings: {slidesToShow: 3, arrows: false, slidesToScroll: 1 } },
     {breakpoint: 700, settings: {slidesToShow: 2, arrows: false, slidesToScroll: 2 } },
     {breakpoint: 500, settings: {slidesToShow: 3, arrows: false, slidesToScroll: 1 } },
     ]
   });
   $('.chay_detail').slick({
     vertical:false, rows: 2, slidesPerRow: 6, slidesToShow:1, slidesToScroll:1, autoplay:false, autoplaySpeed:3000, speed:1000, arrows:true, dots:false, responsive: [
     {breakpoint: 992, settings: "unslick", },
     {breakpoint: 700, settings: "unslick", },
     {breakpoint: 500, settings: "unslick", },
     ]

   });
  }
   if(js_source=='index'){

    if(js_product_list_index){
    $('.chay_box_list').slick({
      vertical:false, slidesToShow:10,  swipeToSlide:true,  autoplay:false, autoplaySpeed:3000, speed:1000, arrows:true, dots:false, responsive: [
      {breakpoint: 992, settings: {arrows: false, slidesToShow:4, slidesToScroll:4, } },
      {breakpoint: 700, settings: {arrows: false, slidesToShow:4, slidesToScroll:4, } },
      {breakpoint: 500, settings: {arrows: false, slidesToShow:4, slidesToScroll:4, } },
      ]
    });
  }
  $('.bottom_slider').slick({
    vertical:false, slidesToShow:10, slidesToScroll: 1, autoplay:false, autoplaySpeed:3000, speed:1000, arrows:true, dots:false, responsive: [
    {breakpoint: 992, settings: "unslick", },
    {breakpoint: 700, settings: "unslick", },
    {breakpoint: 500, settings: "unslick", },
    ]

  });
  $('.chay_deal').slick({
    vertical:false, slidesToShow:6, slidesToScroll:6, autoplay:false, autoplaySpeed:3000, speed:1000, arrows:true, dots:false, responsive: [
    {breakpoint: 992, settings: {arrows: false, slidesToShow:3, slidesToScroll:3, } },
    {breakpoint: 700, settings: {arrows: false, slidesToShow:3, slidesToScroll:3, } },
    {breakpoint: 500, settings: {arrows: false, slidesToShow:3, slidesToScroll:3, } },
    ]
  });
  $('.chay_tkhd').slick({
    vertical:false, slidesToShow:6, slidesToScroll:6, autoplay:false, autoplaySpeed:3000, speed:1000, arrows:true, dots:false, responsive: [
    {breakpoint: 992, settings: {arrows: false, slidesToShow:3, slidesToScroll:3, } },
    {breakpoint: 700, settings: {arrows: false, slidesToShow:3, slidesToScroll:3, } },
    {breakpoint: 500, settings: {arrows: false, slidesToShow:3, slidesToScroll:3, } },
    ]

  });
    $(window).scroll(function(e){
      if($(this).scrollTop() > 280){
        $('#main .full_width').css({'position':'fixed'});
        $('#main .full_width').css({'z-index':'999'});
        
        $(".full_width").addClass("full_width_fixed");
        
        $(".bn_mid_left").addClass("logo_fixed");
        
        $('#left').css({'position':'fixed'});
        $('#left').css({'top':'0px'});
        $('#left').css({'z-index':'999'});
        $('#left .danhmuc').css({'display':'none'});
        $('#left').hover(function(){
          $('#left .danhmuc').css({'display':'block'});
        });
        
        $(".bn_mid_center").addClass("bn_mid_center_fixed");
        $(".top_header_cart").addClass("top_header_cart_fixed");
        
        
      }else{
        $('#main .full_width').css({'position':'absolute'});
        $('#main .full_width').css({'z-index':'-1'});
        $('#left').css({'position':'relative'});
        $('#left .danhmuc').css({'display':'block'});
        
         $(".full_width").removeClass("full_width_fixed");
         $(".bn_mid_left").removeClass("logo_fixed");
        
         $(".bn_mid_center").removeClass("bn_mid_center_fixed");
         $(".top_header_cart").removeClass("top_header_cart_fixed");
        
      }
    });
   }else{
    $(".tab-content").mCustomScrollbar({
    });
    $('#left .danhmuc').css({'display':'none'});
    $(window).scroll(function(e){
      if($(this).scrollTop() > 280){
        $('#main .full_width').css({'position':'fixed'});
        $('#main .full_width').css({'z-index':'999'});
        $('#left').css({'position':'fixed'});
        $('#left').css({'top':'0px'});
        $('#left').css({'z-index':'999'});
        $('#left .danhmuc').css({'display':'none'});
        $('#left').hover(function(){
          $('#left .danhmuc').css({'display':'block'});
        });
        
        
        $(".full_width").addClass("full_width_fixed");
        $(".bn_mid_left").addClass("logo_fixed");
        
        $(".bn_mid_center").addClass("bn_mid_center_fixed");
        $(".top_header_cart").addClass("top_header_cart_fixed");
        
      }else{
        $('#main .full_width').css({'position':'absolute'});
        $('#main .full_width').css({'z-index':'-1'});
        $('#left').css({'position':'relative'});
        $('#left .danhmuc').css({'display':'none'});
        
        $(".bn_mid_left").removeClass("logo_fixed");
        
        $(".full_width").removeClass("full_width_fixed");
        $(".bn_mid_center").removeClass("bn_mid_center_fixed");
         $(".top_header_cart").removeClass("top_header_cart_fixed");
      }
    });
   }
   if(js_source=='index'){
    jssor_1_slider_init(); 
     if(js_thoigiantu <= js_time && js_thoigianden >= js_time ) { 


         var upgradeTime = js_thoigan;
         var seconds = upgradeTime;
         function timer() {
           var dayLeft   = Math.floor((seconds));
           var day       = Math.floor(dayLeft/ (24*3600));
           var hoursLeft   = Math.floor((dayLeft - (day * 24 * 3600) ));
           var hours       = Math.floor(hoursLeft/3600);
           var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
           var minutes     = Math.floor(minutesLeft/60);
           var remainingSeconds = seconds % 60;
           var chuoi='';
           if (remainingSeconds < 10) {
             remainingSeconds = "0" + remainingSeconds; 
           }
           if(day !=0)
           {
             chuoi+=" <a class='day'>" + day + "</a>" + " ";
           }
           if(day > 0 || (day == 0 && minutes > 0 ))
           {
             chuoi+="<a class='gio'>" + hours + "</a>" + " ";
           }
           chuoi+="<a class='phut'>" + minutes + "</a>" + " ";
           document.getElementById('countdown').innerHTML = chuoi + "<a>" +remainingSeconds + "</a>";
           if (seconds == 0) {
             clearInterval(countdownTimer);  
             $('#deal_giasoc').fadeOut();
           } else {
             seconds--;
           }

         }
         /*var countdownTimer = setInterval('timer()', 1000);*/

     } }
});