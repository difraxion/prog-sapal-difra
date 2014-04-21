<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('site'))
{
	function view_section($s='', $c='', $data_objects)
	{
		$section = ($c!=''?$c.'/'.$s:$s);
		$CI = get_instance();
		$data['DIR'] = base_url();
		$data['META'] = $CI->site_model->getdescripcion();
		$data['TITLE'] = $CI->site_model->gettitutlo($s);
		$data['MAIN_TITLE'] = $CI->site_model->gettituloprincipal();
		$data['SITE'] = $CI->site_model->getsitename();
		$data['IMAGE_SITE'] = $CI->site_model->getimagesite();
		$data['KEYWORDS'] = $CI->site_model->getkeywords();
		$data['FAVICON'] = $CI->site_model->getfavicon();
		$data['ANALYTICS'] = $CI->site_model->getanalytics();
		$data['MENU'] = menu($s);
		$data['FMENU'] = menu_footer($s);
		$data['CONTENT'] = $CI->parser->parse($section, $data_objects, true);
		$data['FIX_BUTTON'] = fixbutton($s);
		$CI->parser->parse('site', $data);
	}

	function fixbutton($s) {
		$CI = get_instance();
		if($s=='leydetransparencia'||$s=='leygeneraldecontabilidad') {
			$data['DIR'] = base_url();
			return $CI->parser->parse('fixbutton', $data, true);
		}
	}

	function menu($s) {
		$menu = '<li><a href="'.base_url().'" class="dib'.($s=='inicio'? ' activate':'').'">INICIO<span></span></a></li>';
		$menu .= '<li><a id="lnk_pagaturecibo" href="#" class="dib'.($s=='recibo'? ' activate':'').'">PAGA TU RECIBO<span></span></a></li>';
		$menu .= '<li><a href="'.base_url().'servicios" class="dib'.($s=='servicios'? ' activate':'').'">SERVICIOS<span></span></a></li>';
		$menu .= '<li><a href="'.base_url().'media/files/indicadores.pdf" class="dib" target="_blank">INDICADORES<span></span></a></li>';
		$menu .= '<li><a href="'.base_url().'transparencia" class="dib'.($s=='transparencia'? ' activate':'').'">TRANSPARENCIA<span></span></a></li>';
		$menu .= '<li><a href="'.base_url().'sac" class="dib'.($s=='sac'? ' activate':'').'">SAC<span></span></a></li>';
		return $menu .= '<li class="last-child"><a href="'.base_url().'noticias" class="dib'.($s=='noticias'? ' activate':'').'">NOTICIAS<span></span></a></li>';
	}

	function menu_footer($s) {
		$menu = '<a href="'.base_url().'quees" class="l db'.($s=='quees'?' active':'').'"><span>¿QUÉ ES SAPAL?</span></a>';
		$menu .= '<a href="#" class="l db" target="_blank"><span>AVISO DE PRIVACIDAD</span></a><div class="clear"></div>';
		//$menu .= '<a href="'.base_url().'media/files/AVISODEPRIVACIDAD.pdf" class="l db" target="_blank"><span>AVISO DE PRIVACIDAD</span></a><div class="clear"></div>';
		$menu .= '<a href="'.base_url().'consejodirectivo" class="l db'.($s=='consejodirectivo'?' active':'').'"><span>CONSEJO DIRECTIVO</span></a>';
		$menu .= '<a href="'.base_url().'media/files/guia.pdf" class="l db" target="_blank"><span>GUÍA DEL CLIENTE</span></a><div class="clear"></div>';
		$menu .= '<a href="'.base_url().'hmv" class="l db'.($s=='hmv'?' active':'').'"><span>HISTORIA, MISIÓN Y VISIÓN</span></a>';
		$menu .= '<a href="'.base_url().'licitaciones" class="l db'.($s=='licitaciones'?' active':'').'"><span>LICITACIONES</span></a><div class="clear"></div>';
		$menu .= '<a href="'.base_url().'organigrama" class="l db'.($s=='organigrama'?' active':'').'"><span>ORGANIGRAMA</span></a>';
		return $menu .= '<a href="'.base_url().'descargas" class="l db'.($s=='descargas'?' active':'').'"><span>DESCARGAS</span></a><div class="clear"></div>';
	}
	function extract_text($string, $limit, $break=".", $pad="…") {
		if(strlen($string) <= $limit)
 			return $string;
 		if(false !== ($breakpoint = strpos($string, $break, $limit))){
 			if($breakpoint < strlen($string)-1) {
 				$string = substr($string, 0, $breakpoint) . $pad;
 			}	
 		}
 		return $string;
	}
	function chk_session() {
		$CI = get_instance();
		if(!$CI->session->userdata('usuario')) 
			return false;
		else 
			return true;
	}
	function chk_cuenta() {
		$CI = get_instance();
		if(!$CI->session->userdata('cuenta')) 
			return false;
		else 
			return true;
	}
	function ws($id_ws, $data) {
		$CI = get_instance();
		$query = $CI->db->get_where('sac_wss', array('id_ws'=>$id_ws),1);
		$ws = $query->row();
		$postdata = http_build_query($data);
    	$post = array('http' =>
    		array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
    		)
		);
    	$context  = stream_context_create($post);
    	$result = file_get_contents($ws->url, false, $context);
    	return simplexml_load_string($result);
    }

    function img_validate($img, $section='', $tipo='') {
		$img_path = './media/images/'.$img;

		if ($img!=''&&file_exists($img_path)) {
		    return $img;
		} else {
		    switch ($section) {
		    	case 'noticias':
		    		return 'img-news-default.jpg'; 
		    		break;
		    	case 'descargas':
		    		switch ($tipo) {
		    			case '1': return 'archivo-default.jpg'; break;
		    			case '2': return 'img-default.jpg'; break;
		    			case '3': return 'video-default.jpg'; break;
		    			case '4': return 'enlace_default.jpg'; break;
		    		}
		    		break;
		    }
		}
	}

}