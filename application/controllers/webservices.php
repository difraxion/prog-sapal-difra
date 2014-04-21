<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Webservices extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
		$this->load->model('historico_model');
	}
	public function map_estaciones_bajar(){
		$ubicacion = $this->input->get_post('ubicacion', TRUE); //variables por get
        $periodo = $this->input->get_post('periodo', TRUE); //variables por get
        $fechainicial = $this->input->get_post('finicio', TRUE); //variavles por get
        $fechafinal = $this->input->get_post('ffinal', TRUE);//variavles por get
		$this->load->helper('php-excel'); //vargo el helper de excel
        
        $fields = (
        $field_array[] = array("FECHA", "TEMP. M&Aacute;X. (&deg;c)", "TEMP. M&Iacute;N. (&deg;c)","PREC. ACUM. (mm)","INT. M&Aacute;X. (mm/h)","PREC. ANUAL (mm)","HUM. REL. M&Aacute;X. (%)","HUM. REL. M&Iacute;N. (%)","RAD. SOLAR M&Aacute;X. (W/m2)","PRES. BAR. M&Aacute;X. (hPa)","PRES. BAR. M&Iacute;N. (hPa)","VEL VIENTO M&Aacute;X (m/s)","VEL VIENTO M&Iacute;N (m/s)")
        ); // cabeceras
        $xls = new Excel_XML; //objeto de la clase
        $xls->addArray($field_array); // cabeceras
        $xls->addArray($this->historico_model->consulta_hitorica($ubicacion, $periodo, $fechainicial, $fechafinal)); //contenido
        $xls->generateXML("CONSULTA_HISTORICA".date("d-m-Y_h-i-s")); //genero*/
	}
    public function map_estaciones() {
    	$url='http://intranet.sapal.gob.mx:2948/estaciones/wsestmet2v.asp';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$data = curl_exec($ch); // execute curl request
		curl_close($ch);
		$xml = simplexml_load_string($data);
		print_r(json_encode($xml));
		
	}
	public function map_historico() {
		$post = $this->input->post(); 
		$ubicacion = $post['ubicacion'];
		$periodo = $post['periodo'];
		$fechainicial= $post['finicio'];
		$fechafinal = $post['ffinal'];
    	$url='http://intranet.sapal.gob.mx:2948/Estaciones/wshistorico2v.asp?ubicacion='.$ubicacion.'&periodo='.$periodo.'&fechainicial='.$fechainicial.'&fechafinal='.$fechafinal;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$data = curl_exec($ch); // execute curl request
		curl_close($ch);
		
		$datos['BANNERS'] = $this->site_model->getbanners('est-meteorologicas');
		$datos['DIR'] = base_url();
		//$datos['TITULO'] = $var;
		$datos['CONTENT'] = $this->historico_model->historico($data,$this->estaciones($ubicacion));

		
		view_section('est-historico', '', $datos);
	}

	public function temp_actual_gral() {
    	$url="http://intranet.sapal.gob.mx:2948/Estaciones/wsestmet.asp";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);   
		$data = curl_exec($ch); // execute curl request
		$error = curl_error ($ch);
		curl_close($ch);
		if($data) {
			$xml = simplexml_load_string($data);
			$num_estaciones = 0;
			$temp = 0;
			foreach ($xml as $est) {
				if($this->isDecimal($est->TemperaturaAire1)) {
					$num_estaciones++;
					$temp = $temp + $est->TemperaturaAire1;
				}
			}
			$gral = $temp/$num_estaciones;
			echo 'Act: '.number_format($gral, 2).'° c';
		}
		else
			echo $error;
	}
	public function gettemps() {
		$estaciones = $this->validar_estaciones();
		if($estaciones[0]!='error') {
			$v['maxs'] = '';
			$v['mins'] = '';
			for ($i=0; $i < count($estaciones); $i++) {
				$temps = $this->temps($estaciones[$i]);
				if($i==0) {
					$v['maxs'] .= $temps['maxs'];
					$v['mins'] .= $temps['mins'];
				}
				else {
					$v['maxs'] .= '|'.$temps['maxs'];
					$v['mins'] .= '|'.$temps['mins'];
				}				
			}
			echo 'Max: '.max(explode('|', $v['maxs'])).'° c | Min: '.min(explode('|', $v['mins'])).'° c';
		} else 
			echo $estaciones[1];
	}
	public function temps($e='', $p='') {
		$d = date('d-m-Y');
		$url="http://intranet.sapal.gob.mx:2948/Estaciones/wshistorico.asp?ubicacion=".$e."&Periodo=D&FechaInicial=".$d."&FechaFinal=".$d;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);   
		$data = curl_exec($ch); // execute curl request
		curl_close($ch);
		$xml = simplexml_load_string($data);
		$v['maxs'] = '';
		$v['mins'] = '';
		for ($i=0; $i < count($xml->registro); $i++) { 
			if($i==0) {
				$v['maxs'] .= $xml->registro[$i]->temperaturamaxima;
				$v['mins'] .= $xml->registro[$i]->temperaturaminima;
			}
			else {
				$v['maxs'] .= '|'.$xml->registro[$i]->temperaturamaxima;
				$v['mins'] .= '|'.$xml->registro[$i]->temperaturaminima;
			}
		}
		$v['maxs'] = max(explode('|', $v['maxs']));
		$v['mins'] = min(explode('|', $v['mins'])); 
		if($p=='')
			return $v;
		elseif($p=='print')
			print_r($v);
	}
	public function validar_estaciones($p='') {
		$url="http://intranet.sapal.gob.mx:2948/Estaciones/wsestmet.asp";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);   
		$data = curl_exec($ch); // execute curl request
		$error = curl_error ($ch);
		curl_close($ch);
		$estaciones = array();
		if($data) {
			$xml = simplexml_load_string($data);
			if($xml->EstMetAmalias->AlarmaConexion1==0) array_push($estaciones, 'Amalias');
			if($xml->EstMetColombia->AlarmaConexion1==0) array_push($estaciones, 'Colombia');
			if($xml->EstMetPiedrero->AlarmaConexion1==0) array_push($estaciones, 'Piedrero');
			if($xml->EstMetJerez->AlarmaConexion1==0) array_push($estaciones, 'Jerez');
			if($xml->EstMetMaravillas->AlarmaConexion1==0) array_push($estaciones, 'Maravillas');
			if($xml->EstMetElPalote->AlarmaConexion1==0) array_push($estaciones, 'ElPalote');
			if($xml->EstMetVillasDeSanJuan->AlarmaConexion1==0) array_push($estaciones, 'VillasDeSanJuan');
			if($xml->EstMetTurbioStaR->AlarmaConexion1==0) array_push($estaciones, 'TurbioStaR');
			if($xml->EstMetMuraPBombeo->AlarmaConexion1==0) array_push($estaciones, 'MuraPBombeo');
		}
		else {
			array_push($estaciones, 'error');
			array_push($estaciones, $error);
		}
		if($p=='')
			return $estaciones;
		elseif($p=='print')
			print_r($estaciones);
	}
	private function isDecimal($value) {
		return ((float) $value !== floor($value));
	}
	public function print_ws($id, $cuenta) {
		$xml = ws($id, array('cuenta'=>$cuenta));
		print_r($xml);
		echo '<br />';
		foreach ($xml->registro as $registro) {
			echo '<br>'.$registro->concepto.' '.$registro->prediofac.' '.$registro->monto.' '.$registro->iva.' '.$registro->saldo.'<br>';
		}
	}
	private function estaciones($ubicacion) {
		switch ($ubicacion) {
			case 'Amalias': return 'Sur - Poniente A'; break;
			case 'Colombia': return 'Centro'; break;
			case 'Piedrero': return 'Piedrero'; break;
			case 'Jerez': return 'Sur - Oriente'; break;
			case 'Maravillas': return 'Nor - Oriente';
			case 'ElPalote': return 'Norte'; break;
			case 'MuraPBombeo': return 'Sur'; break;
			case 'TurbioStaR': return 'Sur - Poniente SR';
			case 'VillasDeSanJuan': return 'Oriente';
			
		}
	}
}