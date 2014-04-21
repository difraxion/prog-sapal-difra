<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> 
<html lang="es" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{TITLE}</title>
	<!--Este sitio ha sido desarrollado por Difraxion Group.
	Tel. +52 01 (477) 198 09 65
	E-mail: ventas@reed.com.mx
	www.difraxion.com
	León, Gto-->
	<meta name="description" content="{META}">
	<meta name="keywords" content="{KEYWORDS}">
	<meta name="author" content="Difraxion">
	<meta name="robots" content="all">
	<meta name="geo.placename" content="México">
	<meta name="viewport" content="width=1024">
	<meta property="og:title" content="{MAIN_TITLE}">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="{SITE}">
	<meta property="og:description" content="{META}">
	<meta property="og:image" content="{IMAGE_SITE}">
	<meta property="og:url" content="{DIR}">
	<meta name="google-site-verification" content="qQ817XIiw1EUZDHdnXKczWdDo8GOhyG-Ocsz4SRPJ5w" />
	<link rel="stylesheet" href="{DIR}css/normalize.css" type="text/css">
	<link rel="stylesheet" href="{DIR}css/main.css" type="text/css">
	<link rel="stylesheet" href="{DIR}css/nprogress.css" type="text/css">
	<link rel="shortcut icon" href="{DIR}media/files/{FAVICON}" type="image/ico">
	<link rel="stylesheet" href="{DIR}js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script src="{DIR}js/libs/CreateHTML5Elements.js"></script>
	<script src="{DIR}js/jquery.min.js"></script>
	<script src="{DIR}js/jquery-ui.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle.all.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle2.min.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle2.carousel.min.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle2.swipe.min.js"></script>
	<script src="{DIR}js/applications.js"></script>
	<script src="{DIR}js/nprogress.js"></script>
	<script src="{DIR}js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script src="{DIR}js/libs/iealert.min.js"></script>
	<script src="{DIR}js/jquery.ui.datepicker-es.js"></script>
	<script src="{DIR}js/jquery.form.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<!--[if (gte IE 6)&(lte IE 8)]>
	  <script type="text/javascript" src="{DIR}js/selectivizr.js"></script>
	  <noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
	<![endif]-->

</head>
	<script type="text/javascript">

	$(document).ready(function() {
  		$("body").iealert({	  
			support: "ie7",	  
			title: "Advertencia!",	  
			text: "Por favor, actualiza tu navegador a IE8 o superior para una mejor experiencia en el sitio.",	  
			upgradeLink: "http://windows.microsoft.com/es-co/internet-explorer/ie-10-worldwide-languages",	  
			overlayClose: false,
			upgradeTitle: "Descargar",	  
			closeBtn: false	});	
		});
		
	</script>
<body>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=566469696778835";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		$('.smalls').cycle({
	        prev:   '#prev',
	        next:   '#next',
	        timeout: 0
	    });
	</script>
	<input type="hidden" value="{DIR}" id="hdn_baseurl">
	<div id="pagoturecibo" class="content">
		<div class="wrapper mt15">
			<form id="frm_pagoconregistro">
				<h1>INICIAR SESIÓN</h1>
				<ul class="ul_hoz">
					<li>
						<p>
							<label for="usuario">Usuario:</label>
							<input type="text" id="usuario" name="usuario" class="text upper" />
						</p>
						<p>
							<label for="psw">Contraseña:</label>
							<input type="password" id="psw" name="psw" class="text" />
						</p>
					</li>
					<li>
						
							<input type="button" value="PAGAR" class="btn" id="btn_pagocon" />
							<div class="dib" id="msj_conreg"></div>
							<br />
							<a href="{DIR}sac/recuperarcontrasena">Recupera tu contraseña</a>&nbsp;<span>o</span>&nbsp;<a href="{DIR}sac/registrate">Regístrate aquí</a>
						
					</li>
				</ul>
				<p></p>
			</form>
		</div>
		<hr>
		<div class="wrapper">
			<form id="frm_pasosinregsitro">
				<ul class="ul_hoz">
					<li>
						<h1>PAGO SIN REGISTRO</h1>
					</li>
					<li>&nbsp;<a href="{DIR}img/img-recibo.jpg" class="help"></a></li>
				</ul>
				<ul class="ul_hoz">
					<li>
						<p>
							<label for="cuenta">Número de cuenta:</label>
							<input type="text" id="cuenta" name="cuenta" class="text upper" />
						</p>
						<p>
							<label for="clave">Clave:</label>
							<input type="text" id="clave" name="clave" class="text upper" />
						<p>
					</li>
					<li>
						<input type="button" value="PAGAR" class="btn" id="btn_pagosin" />
						<div class="dib" id="msj_sinreg"></div>
					</li>
				</ul>
			</form>
		</div>
		<a href="" id="close">CERRAR</a>
	</div>
	<div class="content">
	  <header class="wrapper">
	    <div class="logo l"><a href="{DIR}" class="db"><img src="{DIR}img/img-logo.jpg" alt="SAPAL"></a></div>
	    <nav class="r">
	      <ul class="ul_hoz">
	        {MENU}
	      </ul>
	    </nav>
	    <ul class="ul_hoz r">
	      <li>
	        <form id="frm_buscar" action="{DIR}buscar" method="get">
	          <input type="text" name="s" placeholder="Buscar">
	        </form>
	      </li>
	      <li class="tar">
	      	<span class="dib" id="temp_actual"><img src="{DIR}img/270.GIF" alt="Cargando..."></span>
	      	<!--<span class="dib" id="temp_maxmin"><img src="{DIR}img/270.GIF" alt="Cargando..."></span>-->
	      	<a href="{DIR}est-meteorologicas" class="db"><span>Ver por zonas</span></a>
	      </li>
	      <li><a href="{DIR}est-meteorologicas" class="db"><img src="{DIR}img/img-clima.jpg" alt="Clima"></a></li>
	    </ul>
	    <div class="clear"></div>
	  </header>
	  {CONTENT}
	  {FIX_BUTTON}
	  <footer>
	    <div class="content-footer">
	      <div class="first dib pr">
	      	<img src="{DIR}img/img-073-footer.jpg" alt="073 Línea Directa" class="r">
	      	<a href="https://twitter.com/Sapalleon" title="twitter" id="lnk-tt" class="db pa" target="_blank">
	      		<img src="{DIR}img/img-tt.png" alt="twiiter sapal">
	      	</a>
	      	<a href="https://www.facebook.com/SapalLeon" title="facebook" id="lnk-fb" class="db pa" target="_blank">
	      		<img src="{DIR}img/img-fb.png" alt="facebook sapal">
	      	</a>
	        <div class="clear"></div>
	      </div>
	      <div class="second dib">
	        <div class="sitemap">{FMENU}</div>
	      </div>
	    </div>
	    <address class="tac">
	    <span class="db">Sistema de Agua Potable y Alcantarillado de León © 2014.</span><span class="db">Todos los derechos reservados.</span>
	    </address>
	  </footer>
	</div>
	<script src="{DIR}js/main.js"></script>
	<script src="{DIR}js/sac.js"></script>
	<script>{ANALYTICS}</script>
</body>
</html>