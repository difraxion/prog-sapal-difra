$(document).ready(->
	$('#inicio .cycle-slideshow').on('cycle-before', (event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) ->
		$('.label > h1').hide('drop', {direction: 'up'}, 450)
		$('.label > h2').hide('drop', {direction: 'down'}, 450)
	)
	$('#inicio .cycle-slideshow').on('cycle-after', (event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) ->
		$('.label > h1').show('drop', {direction: 'up'}, 450)
		$('.label > h2').show('drop', {direction: 'down'}, 450)
	)
	$('#ul_servicios a').mouseenter ->
		a = $(this)
		ico = a.find('.ico')
		ico.css('background-position', '50% 40px')	
		txt = a.find('.txt')
		screen = a.find('.screen')
		screen.stop(true,true).animate({height: txt.height()+20}, 300)
	$('#ul_servicios a').mouseleave ->
		a = $(this)
		ico = a.find('.ico')
		ico.css('background-position', '50% 58px')
		screen = a.find('.screen')
		screen.stop(true,true).animate({height: '100%'}, 300)
	$('.tb2').on('click', ->
		if !$(this).hasClass 'active'
			tb2 = $(this)
			$('.tb2').removeClass 'active'
			$('.tb2').find('tbody').hide()
			tb2.addClass 'active'
			tb2.find('tbody').show(300, ->
				offset = tb2.offset()
				$('html, body').animate
					scrollTop: offset.top - 15
			    , 600
			)
	)
	#$('#ul_mini_listado > li').mouseenter ->
	#	$('#ul_mini_listado > li').removeClass 'activate'
	#	$(this).addClass 'activate'
)
