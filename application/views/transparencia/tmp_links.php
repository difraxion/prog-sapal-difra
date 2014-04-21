<div data="transparencia">
	<div data-cycle-fx="scrollHorz" data-cycle-slides="&gt; div" data-cycle-timeout="4000" data-cycle-speed="1000" data-cycle-swipe="true" data-cycle-pager=".cycle-pager" data-cycle-pager-template="&lt;span&gt;&lt;/span&gt;" class="cycle-slideshow">
		{BANNERS}
	</div>
	<div class="cycle-pager pa tac wrapper"></div>
	<div class="wrapper">	
		{MENU}	
		<section data="titleleytrans" >
			<h1>Visitas: {VISITAS}<br />información Actualizada al: {MODIFICACION}</h1>
		</section>
		<section data="content-general">
			<article data="sub-menu">
				<header>
					<h1>{TITULO}</h1>
				</header>
				<section>
					{GRUPOS}
				</section>
				<div>
					<a href="{DIR}transparencia/leydetransparencia"><span class="pa db"></span>Regresar al Menú</a>
					
				</div>
			</article>
		</section>
		<?php include 'mod/sectionAvisos.php'; ?>
	</div>
</div>