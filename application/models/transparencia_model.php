<?php

class transparencia_model extends CI_Model {
	function get_infocontable($id=0) {
		$contables = '';
		if($id!=0) {
			$query = $this->db->query('select * from trans_ley_contable left join trans_category on trans_ley_contable.category = trans_category.id where trans_category.id='.$id.' order by trans_ley_contable.id DESC');
			$contables .='<ul>';
			if($id!=4){
				if($query->num_rows()>0) {			
					foreach ($query->result_array() as $contable) {
						$contables .= '<li>';
						$contables .= '<a href="'.base_url().'media/files/'.$contable['archivo'].'" target="_blank">'.$contable['titulo'].'</a>';
						$contables .='</li>';
					}
				}else{
					$contables .='<li><a >No hay datos disponibles</a></li>';
				}
				
			}else{
				$query = $this->db->query('select * from trans_ley_contable where grupo="Catálogo de bienes muebles" order by id DESC');
				foreach ($query->result_array() as $contable) {
						$contables .= '<li  class="Catmuebles CatAll">';
						$contables .= '<a  href="'.base_url().'media/files/'.$contable['archivo'].'"target="_blank">'.$contable['titulo'].'</a>';
						$contables .='</li>';
					}
				$query = $this->db->query('select * from trans_ley_contable where grupo="Catálogo de bienes inmuebles" order by id DESC');
				foreach ($query->result_array() as $contable) {
						$contables .= '<li  class="CatInmuebles CatAll">';
						$contables .= '<a  href="'.base_url().'media/files/'.$contable['archivo'].'"target="_blank">'.$contable['titulo'].'</a>';
						$contables .='</li>';
					}
				$query = $this->db->query('select * from trans_ley_contable where grupo="Inventarios" order by id DESC');
				foreach ($query->result_array() as $contable) {
						$contables .= '<li  class="CatInven CatAll">';
						$contables .= '<a  href="'.base_url().'media/files/'.$contable['archivo'].'"target="_blank">'.$contable['titulo'].'</a>';
						$contables .='</li>';
					}
					$contables.='<li class="Menuback" onClick="catalogo(4)"><a><span class="pa db"></span>Regresar al Menú</a></li>';
					$contables.='<li class="MenuCat" onClick="catalogo(1)"><a>Catálogo de bienes muebles</a></li>';
					$contables.='<li class="MenuCat" onClick="catalogo(2)"><a>Catálogo de bienes inmuebles</a></li>';
					$contables.='<li class="MenuCat" onClick="catalogo(3)"><a>Inventarios</a></li>';

			}
				   $contables .'<ul>';
		}
		return $contables;
	}
	function get_cat_acceso_publico($id=0) {
		$accesos = '';
		if($id!=0) {
			$query = $this->db->query("SELECT * FROM trans_category WHERE section = ".$id);
			//$this->db->where('section',$id);	
			//$query = $this->db->get('trans_category');
			if($query->num_rows()>0) {
				$accesos .= '<ul>';
				foreach ($query->result_array() as $acceso) {
					$accesos .= '<li>';
					$accesos .= '<a href="'.base_url().'transparencia/leydetransparencia/'.$acceso['tagname'].'?id='.$acceso['id'].'">';
					$accesos .= '<div style="background-image: url('.base_url().'media/images/'.$acceso['ico'].');"></div>';
					$accesos .= '<p>'.$acceso['nombre'].'</p>';
					$accesos .= '</a>';
					$accesos .= '</li>';
				}
			}else{
				$accesos .='<li><a >No hay datos disponibles</a></li>';
			}
			$accesos . '<ul>';
		}
		return $accesos;
	}
	function get_content_acceso_publico($id=0) {
		$DIR = base_url();
		$tmp_1='tmp_img';
		$tmp_2='tmp_texto';
		$tmp_3='tmp_links';
		$tmp_4='tmp_archivos';
		$tmp_5='tmp_sueldos';
		$tmp_6='tmp_servicios';
		$tmp_7='tmp_convocatorias';
		$tmp_8='tmp_directorio';
		$accesos = '';
		$templante = '';
		$anidar='';
		$texto='';
		if($id!=0) {
			$query = $this->db->query('select trans_category.id, trans_acc_informacion.id, trans_category.templante, trans_acc_informacion.category, trans_category.nombre, trans_acc_informacion.modified, trans_acc_informacion.img from trans_acc_informacion left join trans_category on trans_acc_informacion.category = trans_category.id where trans_category.id='.$id.' group by (trans_acc_informacion.category)');	
			if($query->num_rows()>0) {
				$accesos .= '<ul>';
				foreach ($query->result_array() as $acceso) {
					$templante=$acceso['templante'];
						switch ($templante) {
							case '1':
								require_once('trans/tmpimg.php');
								break;
							case '2':
								require_once('trans/tmptext.php');
								break;
							case '3':
								require_once('trans/tmplink.php');
								break;
							case '4':
								require_once('trans/tmparchivo.php');
								break;
							case '5':
								require_once('trans/tmpsueldo.php');
								break;
							case '6':
								require_once('trans/tmpservicio.php');
								break;
							case '7':
								require_once('trans/tmpconvocatoria.php');
								break;
							case '8':
								require_once('trans/tmpdirectorio.php');
								break;
							default:
								$accesos .= 'no entra existen datos '.$acceso['templante'];
								break;
						}
				}
			}else{
				$accesos .='Información no disponible';
			}
			$accesos . '<ul>';
			return $accesos;
		} else
			redirect(base_url().'dead');
	}
	function visitas() {
		$ip=$_SERVER['REMOTE_ADDR']; 
		$fecha = date("Y-m-d");
		$hora = date("H:i:s"); 

		$query = $this->db->query('SELECT * FROM trans_visitas where ip="'.$ip.'" and fecha ="'.$fecha.'"');
		if ($query->num_rows()==0) {
			$query =$this->db->query('select num_visitas from trans_visitas order by num_visitas DESC limit 1');
			$row = $query->row();
			$data = array(
				'num_visitas' =>$row->num_visitas + 1,
				'ip' => $ip,
				'fecha' => $fecha,
				'hora' => $hora
			);	
			//$this->db->insert('trans_visitas', $data); 
			$this->db->query("INSERT INTO trans_visitas (num_visitas,ip,fecha,hora) VALUES (".($row->num_visitas + 1).",'".$ip."','".$fecha."','".$hora."')");
			$this->db->query("DELETE FROM trans_visitas WHERE fecha < '".$fecha."'");
		} else {
			$query =$this->db->query('select num_visitas, hora from trans_visitas order by num_visitas DESC limit 1');
			$new = $query->row(); 
			if($this->segundos_a_hora($this->dif($hora,$new->hora))>=7200) {
				$data = array(
					'num_visitas' =>$new->num_visitas + 1,
					'ip' => $ip,
					'fecha' => $fecha,
					'hora' => $hora
				);	
				//$this->db->insert('trans_visitas', $data);
				$this->db->query("INSERT INTO trans_visitas (num_visitas,ip,fecha,hora) VALUES (".($new->num_visitas + 1).",'".$ip."','".$fecha."','".$hora."')");
				$this->db->query("DELETE FROM trans_visitas WHERE fecha < '".$fecha."'");
			}			
		}
		$query=$this->db->query('select num_visitas from trans_visitas order by num_visitas DESC limit 1 '); 
		$row = $query->row();
		return $row->num_visitas;
	}
	function dif($h1,$h2){
    	$h=((strtotime($h1)-strtotime($h2)))/3600;
    	$m=intval((($h)-intval($h))*60);
    	$s=intval((((($h)-intval($h))*60)-$m)*60);
    	return (intval($h)<10?'0'.intval($h):intval($h)).':'.($m<10?'0'.$m:$m).':'.($s<10?'0'.$s:$s);
    }
    function segundos_a_hora($hora) { 
        list($h, $m, $s) = explode(':', $hora); 
        return ($h * 3600) + ($m * 60) + $s; 
    }
    function dateDiff($start, $end) { 
        $start_ts = strtotime($start); 
        $end_ts = strtotime($end); 
        $diff = $end_ts - $start_ts; 
        return round($diff / 86400); 
    }
	function directoriopublico() {
		$menu='';
		$l = (isset($_GET['l'])&&$_GET['l']!=''?$_GET['l']:'A');
		$letras = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		for ($i=0; $i < count($letras); $i++) { 
			$menu .= '<li><a href="'.base_url().'transparencia/directoriopublico?l='.$letras[$i].'"'.($letras[$i]==$l?' class="temp"':'').'>'.$letras[$i].'</a></li>';	
		}
		$data_xml = array('letra' => $l);
		$xml = ws(5, $data_xml);
		$texto = '';
		if($xml) {
			if(count($xml->registro)>0) {
				foreach ($xml->registro as $empleado) {
					$texto .= '<div class="persona">
						<div>
							<img src="'.$empleado->foto.'" alt="'.$empleado->nombre.'">
							<p class="tg-directory"><span class="dib"></span>Funciones</p>
						</div>
						<div>
							<p>Nombre: <span>'.$empleado->nombre.'</span></p>
							<p>Puesto: <span>'.$empleado->puesto.'</span></p>
							<p>Área de adscripción: <span>'.$empleado->areadeadscripcion.'</span></p>
							<p>Fundamento legal: <span>'.$empleado->fundamentolegal.'</span></p>
							<p>Teĺéfono: <span>'.$empleado->telefono.'</span> Extensión: <span>'.$empleado->extension.'</span></p> 
							<p>Correo electrónico: <span>'.$empleado->correo.'</span></p>
						</div>
						<div class="clear"></div>
						<div class="tg-function"><span class="db"></span><p>'.$empleado->funciones.'</p></div>
					</div>';
				}
			}
		} else
			$texto = '<br /><br /><div class="tac"><p>Sin información</p></div>';
		$data['DIR'] = base_url();
		$data['TITULO'] = 'DIRECTORIO DE SERVIDORES PÚBLICOS DE SAPAL';
		$data['MODIFICACION'] = $this->modified();
		$data['MENU'] = $menu;
		$data['TEXTO'] = $texto;
		$data['SCRIPT'] = (isset($_GET['l'])&&$_GET['l']!=''?'<script>$(window).load(function(){$("html, body").animate({scrollTop: 460}, 1200);});</script>':'');
		return $this->parser->parse('transparencia/tmp_directoriop', $data, true);
	}
	function modified() {

			$query = $this->db->query("SELECT MAX(trans_acc_informacion.modified) As acc, MAX(trans_acc_informacion.created) As acc1, MAX(trans_category.modified) AS categoria, MAX(trans_category.created) AS categoria1, MAX(trans_directorio.modified) AS directorio, MAX(trans_directorio.created) AS directorio1, MAX(trans_ley_contable.modified) AS contable, MAX(trans_ley_contable.created) AS contable1 FROM trans_category,trans_acc_informacion,trans_directorio, trans_ley_contable");
			$row=$query->row();
			$rows_modified= array($row->acc,$row->categoria,$row->directorio,$row->contable,$row->acc1,$row->categoria1,$row->directorio1,$row->contable1);
			$fechaEsp = max($rows_modified);
			return strftime(" %d-%m-%Y", strtotime($fechaEsp));
	}
	function menu($home='',$seccion='',$item=''){
		$menu ='';
		$menu.='<nav class="menu-nav-trans">';
		if($home!='' && $seccion==='' && $item==='') {
			$menu.='<div><a href="#"><span class="icon-home"></span>HOME</a></div>';
		}else if($home!='' && $seccion!='' && $item==='') {
			$menu.='<div><a href="'.base_url().''.$home.'"><span class="icon-home"></span>HOME</a></div>';
			if($seccion=='leygeneraldecontabilidad'){
				$menu.='<div><a href="#"><span class="icon-uniE601"></span>LEY GENERAL DE CONTABILIDAD GUBERNAMENTAL</a></div>';
			}else{
				$menu.='<div><a href="#"><span class="icon-uniE601"></span>LEY DE TRANSPARENCIA Y ACCESO A LA INFORMACIÓN PÚBLICA</a></div>';
			}
		}else if($home!='' && $seccion!='' && $item!='') {
			$query = $this->db->query("SELECT nombre FROM trans_category WHERE id = ".$item);
			$row=$query->row();
			$item=$row->nombre;
			$menu.='<div><a href="'.base_url().''.$home.'"><span class="icon-home"></span>HOME</a></div>';
			if($seccion=='leygeneraldecontabilidad'){
				$menu.='<div><a href="'.base_url().''.$home.'/'.$seccion.'"><span class="icon-uniE601"></span>LEY GENERAL DE CONTABILIDAD GUBERNAMENTAL</a></div>';
			}else{
				$menu.='<div><a href="'.base_url().''.$home.'/'.$seccion.'"><span class="icon-uniE601"></span>LEY DE TRANSPARENCIA Y ACCESO A LA INFORMACIÓN PÚBLICA</a></div>';
			}
			$menu.='<div><a href="#"><span class="icon-uniE601"></span>'.$item.'</a></div>';
		}
		$menu.='</nav>';
		return $menu;
	}
}
