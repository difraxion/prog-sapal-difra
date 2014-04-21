<?php

class Servicios_model extends CI_Model {
	private $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	private $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	function insertar_proveedores($post) {
		$this->db->query("INSERT INTO sap_proveedores (nombre,empresa,email,productos) VALUES ('".$post['prov_nombre']."','".$post['prov_empresa']."','".$post['prov_email']."','".$post['prov_productos']."');");
	}
	function insertar_proveedores_file($post, $file_name) {
		$this->db->query("INSERT INTO sap_proveedores (nombre,empresa,email,productos,archivo) VALUES ('".$post['prov_nombre']."','".$post['prov_empresa']."','".$post['prov_email']."','".$post['prov_productos']."','".$file_name."');");
	}
	function avisos() {
		$avisos = '';
		$j=1;
		$fechas = $this->db->query("SELECT DISTINCT fecha, motivo FROM sap_avisos_suspension ORDER BY fecha DESC");
		if($fechas->num_rows()>0) {
			foreach ($fechas->result_array() as $fecha) {
				$horarios = $this->db->query("SELECT * FROM sap_avisos_suspension WHERE fecha = '".$fecha['fecha']."' AND motivo = '".$fecha['motivo']."'");
				if($horarios->num_rows()==1) {
					$h = $horarios->row();
					$avisos .= '<tr'.($j%2==0?' style="background:#eaeaea;"':'').'><td class="br">'.$this->dias[date('w', strtotime($fecha['fecha']))].', '.date('d', strtotime($fecha['fecha'])).' '.$this->meses[date('n', strtotime($fecha['fecha']))].' '.date('Y', strtotime($fecha['fecha'])).'</td>';
					$avisos .= '<td>'.$this->colonias($h->colonia).'<span>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span></td>';
					$avisos .= '<td>'.$h->hora_desde.' - '.$h->hora_hasta.'</td>';
					$avisos .= '<td class="bl">'.$h->motivo.'</td></tr>';
				}
				if($horarios->num_rows()>1) {
					$h = $horarios->result_array();
					$avisos .= '<tr'.($j%2==0?' style="background:#eaeaea;"':'').'><td class="br" rowspan="'.$horarios->num_rows().'">'.$this->dias[date('w', strtotime($fecha['fecha']))].', '.date('d', strtotime($fecha['fecha'])).' '.$this->meses[date('n', strtotime($fecha['fecha']))].' '.date('Y', strtotime($fecha['fecha'])).'</td>';
					$avisos .= '<td>'.$this->colonias($h[0]['colonia']).'<span>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span></td>';
					$avisos .= '<td>'.$h[0]['hora_desde'].' - '.$h[0]['hora_hasta'].'</td>';
					$avisos .= '<td class="bl" rowspan="'.$horarios->num_rows().'">'.$fecha['motivo'].'</td></tr>';
					for ($i=1; $i < count($h); $i++) { 
						$avisos .= '<tr'.($j%2==0?' style="background:#eaeaea;"':'').'><td>'.$this->colonias($h[$i]['colonia']);
						if(($i+1)<count($h)) 
							$avisos .= '<span>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span></td>';
						else
							$avisos .= '</td>';
						$avisos .= '<td>'.$h[$i]['hora_desde'].' - '.$h[$i]['hora_hasta'].'</td></tr>';
					}
				$j++;
				}	
			}
		}
		return $avisos;
	}
	function consumo() {
		$consumo = '';
		$query = $this->db->query("SELECT archivo FROM sap_costos_consumo LIMIT 1");
		if($query->num_rows()==1) {
			$row = $query->row();
			$consumo .= '<a href="'.base_url().'media/files/'.$row->archivo.'" target="_blank" class="lnk_pdf dib"> <span>Ver Tarifas </span></a>';
		}
		return $consumo;
	}
	function contratacion() {
		$contratacion = '';
		$query = $this->db->query("SELECT * FROM sap_costos_contratacion");
		if($query->num_rows()>0) {
			foreach ($query->result_array() as $c) {
				$contratacion .= '<tr><td>'.$c['concepto'].'</td><td>$ '.number_format($c['monto'], 2).'</td></tr>';
			}
		}
		return $contratacion;
	}
	private function colonias($c='') {
		$colonias = '';
		$arr = explode(',', $c);
		for ($i=0; $i < count($arr); $i++) { 
			$colonias .= '<span>'.$arr[$i].'</span>';
		}
		return $colonias;
	}
}