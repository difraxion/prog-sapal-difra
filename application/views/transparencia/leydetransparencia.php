<div data="transparencia">
	<div data-cycle-fx="scrollHorz" data-cycle-slides="&gt; div" data-cycle-timeout="4000" data-cycle-speed="1000" data-cycle-swipe="true" data-cycle-pager=".cycle-pager" data-cycle-pager-template="&lt;span&gt;&lt;/span&gt;" class="cycle-slideshow">
		{BANNERS}
	</div>
	<div class="cycle-pager pa tac wrapper"></div>
	<div class="wrapper">	
	{MENU}	
	<?php require_once 'mod/formInformate.php'; ?>
		<section data="titleleytrans" >
			<h1>Visitas: {VISITAS}<br />información Actualizada al: {MODIFICACION}</h1>
		</section>
		<section data="content-general">
			<article data="leytrans">
				{MENUACCESO}
				
			</article>
		</section>
		<div class="clear"></div>
		<div class="tar">
			<a class="lnk-back dib pr lnkbottom" href="{DIR}transparencia"><span class="pa db"></span>Regresar</a>
		</div>
		<?php include 'mod/sectionAvisos.php'; ?>
	</div>
</div>