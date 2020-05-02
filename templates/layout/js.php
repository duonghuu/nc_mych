
<script src="js/bootstrap/js/bootstrap.min.js"></script> 

<?php /* <script type="text/javascript" src="js/jquery.lazyload.pack.js"></script>
<script src="js/owl.carousel/owl-carousel-sp/owl.carousel.js"></script> */?>
<script type="text/javascript" src="js/fancybox3/jquery.fancybox.min.js?v=2.1.5"></script>

<script src="js/lazyload.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script> 
<?php /* <script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script> */?>
<?php if($source!="index"){ ?>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>  
<?php } ?>
<?php if($template=="product_detail" || $source=="thanhtoan"){ ?>
  <script type="text/javascript" src="plugins/confirm/jquery-confirm.js"></script>
<?php } ?>

<?php if($template=="product_detail"){ ?>
  <script type="text/javascript" src="js/rate/jquery.rater.js"></script>
<?php } ?>
<script type="text/javascript">

  var myLazyLoad = new LazyLoad({
   elements_selector: ".lazy"
 });
   
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
  // (function(d, s, id) {
  //   var js, fjs = d.getElementsByTagName(s)[0];
  //   if (d.getElementById(id)) return;
  //   js = d.createElement(s); js.id = id;
  //   js.async=true;
  //   js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11";
  //   fjs.parentNode.insertBefore(js, fjs); 
  // }(document, 'script', 'facebook-jssdk'));
   $(document).ready(function() {
    setTimeout(function(){
      $("#loader-wrapper").fadeOut(500);
    },400);
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
    //$(".item_index img").lazyload({ placeholder : "images/gif-load.gif",effect : "fadeIn",threshhold:500});
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
     // load_slick();
    //  $( window ).resize(function() {
    //   load_slick();
    // });
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
     
     
     
     
    <?php if($template=="product_detail"){ ?>
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
    <?php } ?>

     
     <?php if($source=='index'){ ?>
      <?php if($product_list_index){?>
      $('.chay_box_list').slick({
        vertical:false, slidesToShow:10,  swipeToSlide:true,  autoplay:false, autoplaySpeed:3000, speed:1000, arrows:true, dots:false, responsive: [
        {breakpoint: 992, settings: {arrows: false, slidesToShow:4, slidesToScroll:4, } },
        {breakpoint: 700, settings: {arrows: false, slidesToShow:4, slidesToScroll:4, } },
        {breakpoint: 500, settings: {arrows: false, slidesToShow:4, slidesToScroll:4, } },
        ]
      });
    <?php } ?>
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
     <?php }else{ ?>
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
     <?php } ?>
  });
</script>



<?php if($source=='index'){?>
  <?php if($thoigiantu <= time() && $thoigianden >= time() ) { ?>

    <script type='text/javascript'>

      var upgradeTime = '<?=$thoigan?>';
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
      //console.log(hours);
        document.getElementById('countdown').innerHTML = chuoi + "<a>" +remainingSeconds + "</a>";
        if (seconds == 0) {
          clearInterval(countdownTimer);  
          $('#deal_giasoc').fadeOut();
        } else {
          seconds--;
        }

      }
      var countdownTimer = setInterval('timer()', 1000);
    </script>

  <?php } }?>
  
 <script src="https://www.google.com/recaptcha/api.js?render=<?=$config_recaptcha?>" ></script>
 <script>
  grecaptcha.ready(function () {
    grecaptcha.execute('<?=$config_recaptcha?>', { action: 'contact' }).then(function (token) {
      var recaptchaResponse = document.getElementById('recaptchaResponse');
      if(recaptchaResponse){recaptchaResponse.value = token;}
      var recaptchaResponse_dk = document.getElementById('recaptchaResponse_dk');
      if(recaptchaResponse_dk){recaptchaResponse_dk.value = token;}
      var recaptchaResponse_cn = document.getElementById('recaptchaResponse_cn');
      if(recaptchaResponse_cn){recaptchaResponse_cn.value = token;}
    });
  });
</script>

<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cde7c89b09f36e5"></script>

