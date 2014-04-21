<?php

class Site_model extends CI_Model {
	private $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	private $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	function fecha(){
		$fecha=date("d/m/Y").', '.date("H:i:s");
		return $fecha;
	}
	function getsitename()
	{
		$this->db->select('nombre_sitio');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->nombre_sitio)
			return $row->nombre_sitio;
		else
			return 'tmp2.0';
	}
	function gettituloprincipal()
	{
		$this->db->select('titulo_principal');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->titulo_principal)
			return $row->titulo_principal;
		else
			return 'SAPAL';
	}
	function gettitutlo($s='')
	{
		$this->db->select('titulo');
		$this->db->where('nombre', $s);
		$query = $this->db->get('sap_secciones');
		$row = $query->row();
		if($row)
			return $this->gettituloprincipal().' - '.$row->titulo;
		else
			return 'SAPAL'.($s=='template'?' - Proyectos Prioritarios':'');
	}
	function getdescripcion()
	{
		$this->db->select('descripcion');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->descripcion)
			return $row->descripcion;
		else
			return '';
	}
	function getkeywords()
	{
		$this->db->select('palabras_claves');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->palabras_claves)
			return $row->palabras_claves;
		else
			return '';
	}
	function getanalytics()
	{
		$this->db->select('analytics');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->analytics)
			return $row->analytics;
		else
			return '';
	}
	function getfavicon()
	{
		$this->db->select('favicon');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->favicon)
			return $row->favicon;
		else
			return 'favicon.ico';
	}
	function getimagesite()
	{
		$this->db->select('image_site');
		$query = $this->db->get('sap_datosgrals');
		$row = $query->row();
		if($row->image_site)
			return $row->image_site;
		else
			return '';
	}
	function id_secciones($s='')
	{
		$id_secciones = 0;
		if($s!='') {
			$query = $this->db->query("SELECT * FROM sap_secciones WHERE nombre = '".$s."'");
			$row = $query->row();
			$id_secciones = $row->id_secciones;
		}
		return $id_secciones;
	}
	function getbanners($s) {
		$salto=array("\n");
		$banners = '';
		$query = $this->db->query("SELECT * FROM sap_banner WHERE id_secciones = ".$this->id_secciones($s)." ORDER BY id_banner DESC");
		if($query->num_rows()>0) {
			if ($this->agent->browser() == 'Internet Explorer' and $this->agent->version() <= 8) {
				$i = 0;
				foreach ($query->result_array() as $banner) {
					$banners .= '<div style="background-image: url('.base_url().'media/images/'.$banner['imagen'].');" class="item-slide"><div class="label wrapper pr"><h1 class="pa titlebaner">'.str_replace($salto,'<br/>', $banner['titulo']).'</h1><h2 class="pa">'.str_replace($salto,'<br/>', $banner['subtitulo']).'</h2></div></div>';
				}
			}
	        else {	
	        	foreach ($query->result_array() as $banner) {
	        		if($banner['url']=='') 
	        			$banners .= '<div style="background-image: url('.base_url().'media/images/'.$banner['imagen'].');" class="item-slide bkg-cover"><div class="label wrapper pr"><h1 class="pa titlebaner">'.str_replace($salto,'<br/>', $banner['titulo']).'</h1><h2 class="pa">'.str_replace($salto,'<br/>', $banner['subtitulo']).'</h2></div></div>';
	        		else
	        			$banners .= '<div style="background-image: url('.base_url().'media/images/'.$banner['imagen'].');" class="item-slide bkg-cover"><a href="'.$banner['url'].'" target="'.$banner['target'].'" class="db"><div class="label wrapper pr"><h1 class="pa titlebaner">'.str_replace($salto,'<br/>', $banner['titulo']).'</h1><h2 class="pa">'.str_replace($salto,'<br/>', $banner['subtitulo']).'</h2></div></a></div>';
	        	}
	        }
        }
        return $banners;
	}
	function licitaciones()
	{
		$licitaciones = '';
		$query = $this->db->query("SELECT * FROM sap_licitaciones ORDER BY fecha DESC");
		if($query->num_rows()>0) {
			$i = 1;
			foreach ($query->result_array() as $licitacion) {
				$licitaciones .= '<ul class="ul_hoz pointer" onclick="window.location.href=\''.base_url().'licitaciones/'.$licitacion['id_licitaciones'].'\'"><li class="r1">'.$i.'</li><li class="r2">'.$licitacion['titulo'].'</li><li class="r3">'.$this->dias[date('w', strtotime($licitacion['fecha']))].', '.date('d', strtotime($licitacion['fecha'])).' '.$this->meses[date('n', strtotime($licitacion['fecha']))].' '.date('Y', strtotime($licitacion['fecha'])).'</li></ul>';		
				$i++;
			}	
		}
		return $licitaciones;
	}
	function licitaciones_byid($id='') {
		$licitacion = '';
		if($id!='') {
			$query = $this->db->query("SELECT * FROM sap_licitaciones WHERE id_licitaciones = ".$id);
			if ($query->num_rows()>0) {
				$row = $query->row();
				$licitacion .= '<h1 class="tac">'.$row->titulo.'</h1>';
				$licitacion .= '<div class="forcenter tac"><iframe frameborder="0" id="frm_licitaciones" class="forcenter" src="'.base_url().'media/files/'.$row->archivo.'" width="900"></iframe></div>';
			}
		}
		return $licitacion;
	}
	function licitaciones_update() {
		$last_date = '';
		$query = $this->db->query("SELECT * FROM sap_licitaciones ORDER BY fecha DESC LIMIT 1");
		if ($query->num_rows()>0) {
			$row = $query->row();
			$last_date = date('d/m/Y', strtotime($row->fecha));
		}
		return $last_date;
	}
	function descargas() {
		$descargas = '';
		$query = $this->db->query("SELECT * FROM sap_descargas ORDER BY id_descargas DESC");
		if($query->num_rows()>0) {
			foreach ($query->result_array() as $descarga) {
				$descargas .= '<div class="pr"><div class="lrow img">'.$this->tipo_enlace($descarga['id_descargas'], $descarga[
					'tipo'], $descarga['archivo'], $descarga['enlace'], $descarga['contenido']).'<img src="'.base_url().'media/images/'.img_validate($descarga['thumb'], 'descargas', $descarga['tipo']).'" alt="'.$descarga['titulo'].'"/></a></div><div class="rrow">'.$this->tipo_enlace($descarga['id_descargas'], $descarga[
					'tipo'], $descarga['archivo'], $descarga['enlace'], $descarga['contenido']).'<h2 class="tal">'.$descarga['titulo'].'</h2></a>'.$descarga['texto'].'</div><div class="clear"></div><ul class="controls ul_hoz"><li class="a_download db">'.$this->tipo_enlace($descarga['id_descargas'], $descarga[
					'tipo'], $descarga['archivo'], $descarga['enlace'], $descarga['contenido']).'</a></li><li><a href="" class="a_mail db"></a></li></ul></div>';
			}
		}
		return $descargas;
	}
	private function tipo_enlace($id, $tipo, $archivo='', $enlace='', $contenido='') {
		switch ($tipo) {
			case '1': //Archivo
				return '<a href="'.base_url().'media/files/'.$archivo.'" target="_blank">';
				break;
			case '2': //Imagen
				return '<a href="'.base_url().'media/files/'.$archivo.'" class="fancy_img">';
				break;
			case '3': //Video
				return '<a href="'.$enlace.'" class="fancy_video">';
				break;
			case '4': //Enlace
				return '<a href="'.$enlace.'" target="_blank">';
				break;
		}
	}
}