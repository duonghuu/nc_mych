<script type="text/javascript">
	<?php /*?>
	$(document).ready(function(e) {
		$(window).scroll(function(e) {
            var body = $("body");
			var top = body.scrollTop();
			if(top>0)
			{
				$('.top_index').css(display,'block');
			}
			else
			{
				$('.top_index').css(display,'none');
			}
        });
		
        $('.top_index').click(function(e) {
            $('html,body').animate({
				scrollTop: $('body').offset().top},'slow'
			);
        });
    });
<?php */?>
</script>
<div class="top_index" style="position:fixed; bottom:20px; cursor:pointer; right:5px; transition:0.5s">
	<img src="img/top.png" alt="Back To Top" />
</div>