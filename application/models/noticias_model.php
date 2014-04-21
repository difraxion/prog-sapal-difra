<?php

class Noticias_model extends CI_Model {
	function getall_noticias() {
		$query = $this->db->get('sap_noticias');
		return $query->num_rows();
	}
	function get_noticias($limit, $start) {
		//$noticias = '<ul class="list-noticias">';
		$noticias = '';
		$this->db->limit($limit, $start);
		$this->db->order_by("fecha", "desc");
		$query = $this->db->get('sap_noticias');
		if($query->num_rows()>0) {
			$noticias.'<div>';
			foreach ($query->result_array() as $noticia) {
				$noticias .= '<ul class="list-noticias">';
				$noticias .= '<li class="pri-not"><a href="'.base_url().'noticia/'.$noticia['id_noticia'].'/'.$start.'"><h4>'.$noticia['titulo'].'</h4></a></li>';
				$noticias .= '<li class="fec-not"><label>'.date('d/m/Y', strtotime($noticia['fecha'])).'</label></li>';
				$noticias .= '<li class="fec-not"><label>'.$noticia['n_comunicado'].'</label><br/><br/></li>';
				$noticias .= '<li class="img-not"><img src="'.base_url().'media/images/'.img_validate('thumbnail_'.$noticia['imagen1'], 'noticias').'"></</li>';
				$noticias .= '<li class="exr-not taj">'.extract_text($noticia['comunicado'],50).'</li>';
				$noticias .= '</ul><a class="btn-not dib tar" href="'.base_url().'noticia/'.$noticia['id_noticia'].'/'.$start.'">Leer más</a>';
			}
			$noticias.'</div>';
		}
		//return $noticias.'</ul>';
		return $noticias;
	}
	
	function get_noticia_ini(){
		$noticias = '';
		$query = $this->db->query("SELECT * FROM sap_noticias WHERE imagen1 <> '' ORDER BY fecha DESC LIMIT 0,3");
		//$row = $query->row();
		if($query->num_rows()>0){
			$i = 0;
			foreach ($query->result_array() as $info) {
				if($i == 0){
					$noticias .= '<div class="l"><a href="'.base_url().'noticia/'.$info['id_noticia'].'" class="db pr top-news lnk-n"><span style="background-image: url('.base_url().'media/images/'.img_validate($info["imagen1"], 'noticias').')" class="db img bkg-cover"></span><span class="pa db txt">'.$info["titulo"].'</span><!--<span class="pa db more">Leer más ></span>--></a></div>';
				}else{
					$noticias .= '<div class="r">';
					$noticias .= '<ul class="ul_news">';
					$noticias .= '<li><a href="'.base_url().'noticia/'.$info['id_noticia'].'" class="db pr lnk-n"><span style="background-image: url('.base_url().'media/images/'.img_validate($info["imagen1"], 'noticias').')" class="db img bkg-cover"></span><span class="pa db date">'.$info["fecha"].'</span><span class="pa db txt">'.$info["titulo"].'</span></a></li>';
					//$noticias .= '<li><a href="{DIR}noticias" class="db pr"><span style="background-image: url({DIR}media/images/not-img3.jpg)" class="db img bkg-cover"></span><span class="pa db date">20/08/13</span><span class="pa db txt">Atiende gobierno Municipal Peticiones de ADICUR</span></a></li>';
					$noticias .= '</ul>';
					$noticias .= '</div>';
				}
				$i++;
			}
		}	
		return $noticias;
	}	
	function get_destacados(){
		$destacados='';
		$query = $this->db->get_where('sap_noticias',
			array('destacado' => 'si'),5);
		if($query->num_rows()>0) {
			foreach ($query->result_array() as $destacado) {
				$destacados .= '<p class="taj">';
				$destacados .= '<a href="'.base_url().'noticia/'.$destacado['id_noticia'].'">'.$destacado['titulo'].'</a>';
				$destacados.'</p>';
			}
		}
		return $destacados;
	}
	function get_count(){
		$noticia = '';
		$this->db->order_by('count','desc');
		$this->db->limit(5);
		$query = $this->db->get('sap_noticias');
		$row = $query->row();
		if($query->num_rows()>0) {
			foreach ($query->result_array() as $cuenta) {
				$noticia .= '<p class="taj">';
				$noticia .= '<a href="'.base_url().'noticia/'.$cuenta['id_noticia'].'">'.$cuenta['titulo'].'</a>';
				$noticia.'</p>';
			}
		}
		return $noticia;
	}
	function get_noticia($id, $page) {
		$prev=$next='';
		$count= 0;
		$noticia = '';
		$query = $this->db->get_where('sap_noticias',
			array('id_noticia' => $id),1);
		$row = $query->row();
		$count = $row->count + 1;
		$data = array('count'=>$count);
		$this->db->where('id_noticia',$id);
		$this->db->update('sap_noticias',$data);
		$qprev = $this->db->query("SELECT * FROM sap_noticias WHERE id_noticia = (SELECT MAX(id_noticia) FROM sap_proyectoprioritarios WHERE id_noticia < ".$id.");");
		$qnext = $this->db->query("SELECT * FROM sap_noticias WHERE id_noticia = (SELECT MIN(id_noticia) FROM sap_proyectoprioritarios WHERE id_noticia > ".$id.");");
		if($qprev->num_rows()>0) $prev = $qprev->row();
		if($qnext->num_rows()>0) $next = $qnext->row();
		$noticia.= '<div class="tar controls pps"><div class="r">';
		$noticia.= '<a href="'.base_url().'pdf/'.$row->id_noticia.'" target="_blank" class="rfalse a_pdf dib"></a>';
		//$noticia.= '<a href="" class="rfalse a_pdf dib"></a>';
		$noticia.= '<a href="javascript:imprSelec(\'rrow\')" class="rfalse a_print dib" ></a>';
		$noticia.= '<a href="#inline" class="rfalse a_mail dib modalbox"></a>';
		$noticia.= '<a href="mailto:?subject=Te recomiento esta nota! &amp;body=Ir: http://www.sapal.com.mx" title="Share by Email"></a></div></div>';
		$noticia.= '<h2 class="tal">'.$row->titulo.'</h2>';
		$noticia.= '<p class="taj">'.$row->n_comunicado.'</p>';
		$noticia.= '<p class="taj">'.$row->fecha.'</p>';
		$noticia.= '<p class="taj">'.$row->comunicado.'</p>';
		if($row->imagen1 != ""){
			$noticia.= '<ul class="ul_hoz cycle-slideshow smalls" data-cycle-fx="carousel" data-cycle-slides="li" data-cycle-timeout="0" data-cycle-next="#next" data-cycle-prev="#prev" data-cycle-carousel-visible=3 data-allow-wrap=false><li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen1.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen1.'" title=" '.$row->imagen1.' "></a></li>';
		}
		if($row->imagen2 != ""){
			$noticia.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen2.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen2.'" title=" '.$row->imagen2.' "></a></li>';
		}
		if($row->imagen3 != ""){
			$noticia.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen3.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen3.'" title=" '.$row->imagen3.' "></a></li>';
		}
		if($row->imagen4 != ""){
			$noticia.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen4.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen4.'" title=" '.$row->imagen4.' "></a></li>';
		}
		if($row->imagen5 != ""){
			$noticia.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen5.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen5.'" title=" '.$row->imagen5.' "></a></li>';
		}
		if($row->imagen6 != ""){
			$noticia.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen6.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen6.'" title=" '.$row->imagen6.' "></a></li></ul>';
		}
		if($prev!='') 
			$noticia .= '<div class="pag-thu"><a href="'.base_url().'noticia/'.$prev->id_noticia.'/'.$page.'" class="dib l">&lt;&nbsp;Noticia Anterior </a>';
		else
			$noticia .= '<div class="pag-thu">';
		if($next!='')
			$noticia .= '<a href="'.base_url().'noticia/'.$next->id_noticia.'/'.$page.'" class="dib r">Noticia Siguiente &gt;</a></div>';
		else
			$noticia .= '</div>';
		return $noticia;
	}

	function pdf($id){
		$html = '';
		$query = $this->db->query('SELECT * FROM sap_noticias WHERE id_noticia = '.$id);
		if($query->num_rows()>0){
			$row=$query->row();
		$html.= '<h2 class="tal">'.$row->titulo.'</h2>';
		$html.= '<p class="taj">'.$row->n_comunicado.'</p>';
		$html.= '<p class="taj">'.$row->fecha.'</p>';
		$html.= '<p class="taj">'.$row->comunicado.'</p>';
		if($row->imagen1 != ""){
			$html.= '<ul class="ul_hoz cycle-slideshow smalls" data-cycle-fx="carousel" data-cycle-slides="li" data-cycle-timeout="0" data-cycle-next="#next" data-cycle-prev="#prev" data-cycle-carousel-visible=3 data-allow-wrap=false><li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen1.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen1.'" title=" '.$row->imagen1.' "></a></li>';
		}
		if($row->imagen2 != ""){
			$html.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen2.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen2.'" title=" '.$row->imagen2.' "></a></li>';
		}
		if($row->imagen3 != ""){
			$html.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen3.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen3.'" title=" '.$row->imagen3.' "></a></li>';
		}
		if($row->imagen4 != ""){
			$html.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen4.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen4.'" title=" '.$row->imagen4.' "></a></li>';
		}
		if($row->imagen5 != ""){
			$html.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen5.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen5.'" title=" '.$row->imagen5.' "></a></li>';
		}
		if($row->imagen6 != ""){
			$html.= '<li><a class="fancybox" rel="group" href="'.base_url().'media/images/'.$row->imagen6.'"><img src="'.base_url().'media/images/thumbnail_'.$row->imagen6.'" title=" '.$row->imagen6.' "></a></li></ul>';
		}
		}
		return $html;
	}
}
