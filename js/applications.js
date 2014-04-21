$(function() {
		$('.Catmuebles').css('display','none');
		$('.CatInmuebles').css('display','none');
		$('.CatInven').css('display','none');
		$('.Menuback').css('display','none');
	$('.ley-content-1').css('display', 'block');
	$('.btn-info-publi').click(function(event) {
		$('.form-info').slideToggle('slow');
	});
	$('.ley-trans-1>ul>li').click(function(event) {
		$('.ley-trans-1>ul>li').removeClass('btn-active');
		$(this).addClass('btn-active');
		var item =$(this).data('item');
		$('.ley-content').css('display', 'none');
		$('.ley-content-'+item).fadeIn('slow', function() {
		});	
	});
	historico();
});

function catalogo(item){
	switch(item) {
		case 1:
				$('.MenuCat').css('display','none');
				$('.Catmuebles').css('display','block');
				$('.Menuback').css('display','block');
			break;
		case 2:
			$('.MenuCat').css('display','none');
				$('.CatInmuebles').css('display','block');
				$('.Menuback').css('display','block');
			break;
		case 3:
			$('.MenuCat').css('display','none');
				$('.CatInven').css('display','block');
				$('.Menuback').css('display','block');
			break;
		case 4:
				$('.CatAll').css('display','none');
				$('.Menuback').css('display','none');
				$('.MenuCat').css('display','block');
			break;
		
		}

}
function historico(){
	$("#filters :checkbox").click(function() {
       $("." + $(this).val()).hide();
	   $('.detached').css("width", $(".detach").width());

       $("#filters :checkbox:checked").each(function() {
           $("." + $(this).val()).show();
           $('.detached').css("width", $(".detach").width());
       });
    });
}

 $(window).load(function(){
    $(".detach-container").each(function() {
     var elduplIcate = $(".detach", this);
     elduplIcate
     .before(elduplIcate.clone())
     .css("width", elduplIcate.outerWidth())
     .addClass("detached");
     console.log(elduplIcate.width());
   });
 })
 .scroll(function(){
      jQuery(".detach-container").each(function() {       
           detached = jQuery(".detached", this);
           if ((jQuery(window).scrollTop() > jQuery(this).offset().top) && (jQuery(window).scrollTop() < jQuery(this).offset().top + jQuery(this).outerHeight())) {
            detached.css({
                          "visibility": "visible"
                        });
           } 
           else {
            detached.css({
                          "visibility": "hidden"
                        });      
           };
      });
 });

     
     