<div id="est-meteorologicas">
  <div id="gralCycle" data-cycle-fx="scrollHorz" data-cycle-slides="&gt; div" data-cycle-timeout="4000" data-cycle-speed="1000" data-cycle-swipe="true" data-cycle-pager=".cycle-pager" data-cycle-pager-template="&lt;span&gt;&lt;/span&gt;" class="cycle-slideshow">
    {BANNERS}
  </div>
  <div class="cycle-pager pa tac wrapper"></div>
</div>
<div class="wrapper">
	<div class="estaciones">
		<div>
			<h3>CONSULTA EL CLIMA EN TU ZONA EN TIEMPO REAL UBICANDO TU ESTACIÓN METEOROLÓGICA</h3>
		</div>
		<div>
			<article>
				<h3>instrucciones de uso</h3>
				<p>Para ver más información acerca de una estación en particular, da click sobre el nombre de la misma.  Si deseas consultar una fecha pasada, utiliza el cuadro de diálogo a la derecha. </p>
			</article>
			<article>
				<h3>consulta histórica</h3>
				<fieldset>
					<form action="{DIR}est-meteorologicas/historico" onSubmit="return validar(this)" method="post" accept-charset="utf-8">
						<label>UBICACIÓN:</label><select name="ubicacion" id="ubi">
									  <option value="Amalias">Sur - Poniente A</option>
									  <option value="Colombia">Centro</option>
									  <option value="Piedrero">Poniente</option>
									  <option value="Jerez">Sur - Oriente</option>
									  <option value="Maravillas">Nor - Oriente</option>
									  <option value="ElPalote">Norte</option>
									  <option value="MuraPBombeo">Sur</option>
									  <option value="TurbioStaR">Sur - Poniente SR</option>
									  <option value="VillasDeSanJuan">Oriente</option>
									</select>
						<label>PERIODO:</label><select name="periodo" id="per">
									  <option value="D">Diario</option>
									  <option value="M">Mensual</option>
									  <option value="A">Anual</option>
									</select>
						<label>FECHA DE INICIO:</label><input type="text" name="finicio" value="" placeholder="Seleccionar" id="dateinicio" class="txt_date">
						<label>FECHA FINAL:</label><input type="text" name="ffinal" value="" placeholder="Seleccionar" id="datefin" class="txt_date"></br>
						<div>
							<input type="submit" name="" value="ver" id="enviar">
							<input type="button" id="bajarconsulta" value="Descargar">
							<span id="alert"></span>
						</div>
					</form>
				</fieldset>
			</article>
			<article>
				<h3>estado</h3>
				<p>La última actualización se realizó el:</p>
				<h3>{FECHA}</h3>
				<p>Al momento</p>
			</article>
		</div>
	</div>
	</div>

	<div id="mapa" class="map"></div>
	<div class="wrapper">
		<div class="content-map">
			<section>
				<article class="nombre h82">
					<h1></h1>
					<h2 class="f08">sad</h2>
				</article>
				<article class="temperatura h82">
					<h1>asd</h1>
					<h2 class="f08">temperatura</h2>
				</article>
				<article class="anual h82">
					<h1>asd</h1>
					<h2 class="f08">PRECIPITACIÓN ACUMULADA ANUAL</h2>
				</article>
				<article class="lluvia h82">
					<h1>asd</h1>
					<h2 class="f08">intensidad de lluvia</h2>
				</article>
			</section>
			<section>
				<article class="datos">
					<h1>datos generales</h1>
					<p>contendido</p>
				</article>
				<article class="viento">
					<h1>dirección del viento</h1>
					<p>asd</p>
				</article>
				<article class="temperaturaG">
					<h1>temperatura</h1>
					<span>contendido</span>
				</article>
				<article class="precipitacion">
					<h1>precipitación</h1>
					<span>contendido</span>
				</article>
				<article class="informacion">
					<h1>más información</h1>
					<span>contendido</span>
				</article>
			</section>
	</div>
	<p><br /></p>
</div>
<script src="{DIR}js/libs/richmarker.js"></script>
<script type="text/javascript" src="{DIR}js/map.js"></script>