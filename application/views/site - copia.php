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
	León, Guanajuato-->
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
	<link rel="stylesheet" href="{DIR}css/normalize.css" type="text/css">
	<link rel="stylesheet" href="{DIR}css/main.css" type="text/css">
	<link rel="shortcut icon" href="{DIR}media/files/{FAVICON}" type="image/ico">
	<link rel="stylesheet" href="{DIR}js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script src="{DIR}js/libs/CreateHTML5Elements.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle.all.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle2.min.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle2.carousel.min.js"></script>
	<script src="{DIR}js/cycle/jquery.cycle2.swipe.min.js"></script>
	<script src="{DIR}js/applications.js"></script>
	<script type="text/javascript" src="{DIR}js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script src="{DIR}js/tabs.js"></script>
</head>
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
	        <form id="frm_buscar">
	          <input type="text" namr="buscar" placeholder="Buscar">
	        </form>
	      </li>
	      <li class="tar"><span class="dib">Act. 18</span><span class="dib">Max: 28</span><span class="dib">Min: 13</span><a href="" class="db"><span>Ver por zonas</span></a></li>
	      <li><img src="{DIR}img/img-clima.jpg" alt="Clima"></li>
	    </ul>
	    <div class="clear"></div>
	  </header>
	  {CONTENT}
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
	<div id="dialog" class="dialog" style="display:none"></div>
	<div id="overlay" style="display:none"></div>
	<div id="dom" class="dom wrapper" style="display:none">
		<div>
			<span class="cerrar-pop"><a href="">CERRAR</a></span>
		</div>
		<ul id="sidebarTabs" class="tabs">
			<li id="tab1" class="selected"  onclick="tabs(this);"><a href="#">INICIAR SESIÓN</a></li>
			<li id="tab2" onclick="tabs(this);"><a href="#">¿USUARIO NUEVO...? REGISTRATE AQUÍ</a></li>
		</ul>
		<div id="tabContent" class="cont_sesion">
			<section  class="iniciar">
				<p>
					<label for="usuario">Usuario:</label>
					<input type="text" id="usuario" name="usuario">
					<input type="submit" value="INICIAR SESIÓN">
				</p>
				<p>
					<label for="psw">Contraseña:</label>
					<input type="password" id="psw" name="psw">
					<span>Recuperar tu contraseña <a href="#">AQUÍ</a></span>
				</p>
				<p>
				</p>
			</section>
		</div>
		<div id="tab1Content" style="display:none;" class="cont_sesion">
			<section  class="iniciar">
				<p>
					<label for="usuario">Usuario:</label>
					<input type="text" id="usuario" name="usuario">
					<input type="submit" value="INICIAR SESIÓN">
				</p>
				<p>
					<label for="psw">Contraseña:</label>
					<input type="password" id="psw" name="psw">
					<span>Recuperar tu contraseña <a href="#">AQUÍ</a></span>
				</p>
				<p>
				</p>
			</section>
		</div>
		<div id="tab2Content" style="display:none;">
			<section id="tab2" class="nuevo_u">
				<p>
					<label for="nusuario">NOMBRE DE USUARIO:</label>
					<input type="text" id="nusuario" name="nusuario">
				</p>
				<p>
					<label for="correo">CORREO:</label>
					<input type="text" id="correo" name="correo">
				</p>
				<p>
					<label for="contrasena">CONTRASEÑA:</label>
					<input type="password" id="contrasena" name="contrasena">
				</p>
				<p>
					<label for="cocontrasena">CONFIRMAR CONTRASEÑA:</label>
					<input type="password" id="cocontrasena" name="cocontrasena">
				</p>
				<p>
					<label for="nombre">NOMBRE:</label>
					<input type="text" id="nombre" name="nombre">
				</p>
				<p>
					<label for="apellidos">APELLIDOS:</label>
					<input type="text" id="apellidos" name="apellidos">
				</p>
				<p>
					<label for="ncuenta">NÚMERO DE CUENTA:</label>
					<input type="text" id="ncuenta" name="ncuenta"><span>* Ejemplo</span>
				</p>
				<p>
					<label for="clave">CLAVE PERSONAL:</label>
					<input type="text" id="clave" name="clave"><span>* Ejemplo</span>
				</p>
				<p>
					<label for="pregunta">PREGUNTA:</label>
					<select>
						<option>Pregunta 1</option>
						<option>Pregunta 2</option>
						<option>Pregunta 3</option>
					</select>
				</p>
				<p>
					<label for="respuesta">RESPUESTA SECRETA:</label>
					<input type="text" id="respuesta" name="respuesta">				
				</p>
				<p>
					<input type="submit" value="Registrarse">
				</p>
			</section>
		</div>
	</div>
	<script src="{DIR}js/boxes.js"></script>
	<script src="{DIR}js/main.js"></script>
	<script>
		{ANALYTICS}
	</script>
</body>
</html>