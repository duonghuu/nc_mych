



<?php if($source!="index"){ ?>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>  
<?php } ?>
<?php if($template=="product_detail" || $source=="thanhtoan"){ ?>
  <script type="text/javascript" src="plugins/confirm/jquery-confirm.js"></script>
<?php } ?>


<script>
  var js_deviceType = '<?= $deviceType ?>';
  var js_source = '<?= $source ?>';
  var js_product_list_index = '<?= $product_list_index ?>';
  var js_template = '<?= $template ?>';
  var js_thoigiantu = '<?= $thoigiantu ?>';
  var js_thoigianden = '<?= $thoigianden ?>';
  var js_thoigianden = '<?= $thoigianden ?>';
  var js_thoigan = '<?= $thoigan ?>';
  var js_time = '<?= time() ?>';
</script>
<?php if($template=="product_detail"){ ?>
  <script type="text/javascript" src="js/rate/jquery.rater.js"></script>
  <script type="text/javascript" src="js/ImageTooltip.js"></script>
  <link href="js/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
  <script src="js/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
<?php } ?>
<script src="js/main.js"></script> 




  
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
<?php if($source!="index"){ ?>
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cde7c89b09f36e5"></script>
<?php } ?>

