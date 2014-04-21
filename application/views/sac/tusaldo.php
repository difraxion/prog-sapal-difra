<div class="sac_dashboard">
	<h1 id="gral" class="tac wrapper tu-saldo">{TITLE} </h1>
	<div id="gralBox">
		<h1 class="tac">TU ENLACE DIRECTO CON SAPAL</h1>
		<div class="tac">
			<h2 class="dib"><a href="{DIR}sac/pagaturecibo/">Paga</a> o&nbsp;</h2>
			<form action="http://mapas.sapal.gob.mx/recibos/index.php" method="post" name="miforma" target="_blank" class="dib">
				<input type="hidden" name="cuenta" value="{CUENTA}" id="cuenta"/>
				<a href="#" onclick="miforma.submit();return false;" class="lnk_descarga">Descarga tu recibo</a>
			</form>
		</div>
		<table class="tb1">
			<thead>
				<tr>
					<th>CUENTA</th>
					<th>TOTAL A PAGAR</th>
					<th>VENCIMIENTO</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>{CUENTA}</td>
					<td>{TOTAL_A_PAGAR}</td>
					<td>{VENCIMIENTO}</td>
				</tr>
				<tr>
					<td colspan="3"><hr/></td>
				</tr>
				<tr>
					<td colspan="3">
						<span class="l">{NOMBRE}</span>
						<br class="clear"/>
						<span class="l">GIRO:&nbsp;{GIRO}</span>
						<div class="clear"></div>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr/></td>
				</tr>
				<tr>
					<td colspan="3"><label>DOMICILIO DE LA TOMA</label>
						<div class="clear"></div>
						<span class="l">{CALLE}</span>
						<br class="clear"/>
						<span class="l">{COLONIA}</span>
						<br class="clear"/><span class="l">LEÓN, GTO.</span>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="tb1">
			<thead>
				<tr>
					<th>MES DE FACTURACIÓN</th>
					<th>CONSUMO PROMEDIO</th>
					<th>LECTURA ANTERIOR</th>
					<th>MESES DE ADEUDO</th>
					<th>TOMAS</th>
					<th>TARIFA</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="6"></td>
				</tr>
				<tr>
					<td>{MES_FACTURA}</td>
					<td>{CONSUMO_PROMEDIO}</td>
					<td>{LECTURA_ANTERIOR}</td>
					<td>{MESES_ADEUDO}</td>
					<td>{TOMAS}</td>
					<td>{TARIFA}</td>
				</tr>
			</tbody>
		</table>
		<table class="tb1">
			<thead>
				<tr>
					<th>MEDIDOR</th>
					<th>CONTROL</th>
					<th>ESTATUS</th>
					<th>CORTADO</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td>{MEDIDOR}</td>
					<td>{CONTROL}</td>
					<td>{ESTATUS}</td>
					<td>{CORTADO}</td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
			</tbody>
		</table>
		<table class="tb1">
			<thead>
				<tr>
					<th>CONCEPTO DEL COBRO</th>
					<th>IMPORTE</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<span class="l">CONSUMO AGUA</span>
						<br class="clear"/>
						<span class="l">I. V. A. </span>
						<br class="clear"/>
						<span class="l">SUMA TOTAL</span>
					</td>
					<td>
						<span class="r">{TOTAL_A_PAGAR}</span>
						<br class="clear"/>
						<span class="r">0.00</span>
						<br class="clear"/>
						<span class="r">{TOTAL_A_PAGAR}</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60"></td>
				</tr>
				<tr>
					<td>
						<strong class="l">TOTAL A PAGAR</strong>
					</td>
					<td>
						<strong class="r">{TOTAL_A_PAGAR}</strong>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>