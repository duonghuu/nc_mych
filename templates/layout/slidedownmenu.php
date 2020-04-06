    <script>
  $(window).scroll(function () {

         if ($(window).scrollTop() > 234) {
          
             $('#timkiem').addClass('fixed');
         }
         else {
             $('#timkiem').removeClass('fixed');
         }
    });
</script>

<?php
  $d->reset();
  $sql = "select id,ten_$lang,tenkhongdau,type from #_product_list where hienthi=1 and type='product' order by stt,id desc";
  $d->query($sql);
  $row_list = $d->result_array();

  $d->reset();
  $sql = "select id,ten_$lang,tenkhongdau,type from #_baiviet_list where hienthi=1 and type='tintuc' order by stt,id desc";
  $d->query($sql);
  $tintuc_list = $d->result_array();
?>
<?php /*?>
<div id='cssmenu'>
  <ul itemprop='mainEntity' itemscope='itemscope' itemtype='http://schema.org/SiteNavigationElement'>
     <li><a  href='gioi-thieu.htm' title="Giới thiệu"><span>Giới thiệu</span></a></li>
     
     <li><a href='tin-tuc.htm' title="Tin tức"><span>Tin tức</span></a>
      <ul>
        <?php for($i=0;$i<count($tintuc_list);$i++){ ?>
          <li><a href="tin-tuc/<?=$tintuc_list[$i]['tenkhongdau']?>/" title="<?=$tintuc_list[$i]['ten_vi']?>"><?=$tintuc_list[$i]['ten_vi']?></a></li>
        <?php } ?>
      </ul>
     </li>
     <li><a href='lien-he.htm' title="Liên hệ"><span>Liên hệ</span></a></li>
  </ul>
  <div id="timkiem">
       <form action="index.php"  method="" name="frm2" >
          <input type="hidden" name="com" value="tim-kiem" />
            <input type="text" name="keywords" id="name_tk"  class="input"  placeholder="Tìm kiếm..." />
            <button type="submit" value="" class="nut_tim"></button>
        </form>
  </div>
</div>
<?php */?>