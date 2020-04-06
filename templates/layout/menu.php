<?php
   $d->reset();
  $sql = "select ten_$lang as ten,tenkhongdau,id from #_product_list where hienthi=1 and type='product' order by stt,id desc";
  $d->query($sql);
  $row_list = $d->result_array();

  $d->reset();
  $sql = "select * from #_baiviet_list where hienthi=1 and type='dichvu' order by stt,id desc";
  $d->query($sql);
  $row_dichvu_list = $d->result_array();


?>
<script type="text/javascript">
  $(document).ready(function() {
      $('#menu_top li.fi').hover(function(event) {
          $(this).find('.sub_menu').css({ display:'block'});
      } ,function() {
          $('#menu_top li.fi .sub_menu').css({ display:'none'});
      }); //
	  
	  
	   $('.menu_top_main ul.vien').hover(function(event) {
		   
		     var id_cap1 = $(this).attr("id_cap1");
			  var id_menu = $('.menu_top_main li#menu_'+id_cap1+'.catalog_menu.active').attr("id_menu");
			
			 if (id_cap1 != undefined) {
				 
				 
                   if (id_menu!=id_cap1)
				   {
				
					     $('.menu_top_main li#menu_'+id_menu+'.catalog_menu.active').removeClass('active');
						  $('.menu_top_main li#menu_'+id_cap1+'.catalog_menu').addClass('active');
						
				   }
				   else 
				   {
					    $('.menu_top_main li#menu_'+id_menu+'.catalog_menu').removeClass('active');
				   }
		
                    return false;
                }
		   

	  
	 });
	  
  });
</script> 

<div class="menu_top_main">

  <nav id="smoothmenu1" class="ddsmoothmenu">
      <ul class="catalog_level1">
	  <?php foreach ($row_list as $i =>$v_list) {?>
          <li id_menu="<?=$v_list["id"]?>" id="menu_<?=$v_list["id"]?>" class="catalog_menu <?php if($v_list["id"]==$id_listhome){?>active<?php }?>"><a href="<?=$v_list['tenkhongdau']?>"><?=$v_list["ten"] ?></a>
            
		 <?php
             $d->reset();
             $sql = "select ten_$lang as ten,tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$v_list['id']."' and type='product' order by stt,id desc";
             $d->query($sql);
             $row_cat = $d->result_array();
			if (count($row_cat)>0){
         ?>
			<ul id_cap1="<?=$v_list["id"]?>" class="vien catalog_level2">
                <?php foreach ($row_cat as $j =>$v_cat){?>
               

                 <li class="cap1_pro" ><a href="<?=$v_list['tenkhongdau']?>/<?=$v_cat['tenkhongdau']?>"><?=$v_cat['ten']?></a>
                 
				  <?php 
                      $d->reset();
                      $sql = "select ten_$lang as ten,tenkhongdau,id from #_product_item where hienthi=1 and id_cat='".$v_cat['id']."' and type='product' order by stt,id desc";
                      $d->query($sql);
                      $row_item = $d->result_array();
					  if (count($row_item)>0){
                  ?>
				 
                 <?php /*?> <ul class="catalog_level3"><?php */?>
                 <?php foreach ($row_item as $k =>$v_item){?>
                     <li class="cap2_pro">
					 
					 <a href="<?=$v_list['tenkhongdau']?>/<?=$v_cat['tenkhongdau']?>/<?=$v_item['tenkhongdau']?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?=$v_item['ten']?></a></li>
				 <?php }?>
                  <?php /*?></ul><?php */?>
				<?php } ?>
				
                 </li>
                <?php } ?>
              </ul>
			<?php } ?>
          </li>
	  <?php }?>
      </ul>
      

  </nav>
</div> 



               
                
   