<?php
$query_grupos = $this->db->query('SELECT grupos, id FROM trans_acc_informacion where category='.$acceso['category'].' group by (grupos) order by id DESC');
	foreach ($query_grupos->result_array() as $grupo) {
		$query_links = $this->db->query('SELECT titulo, link, archivo, id FROM trans_acc_informacion where category='.$acceso['category'].' and grupos="'.$grupo['grupos'].'" order by id DESC');
		if($grupo['grupos']==='Convocatorias'){
			$texto .='<div>';
			$texto .='<h2>'.$grupo['grupos'].'</h2>';
			$texto .='<ul>';
				foreach ($query_links->result_array() as $link) {
					$texto .='<li><a href="'.base_url().'media/files/'.$link['archivo'].'" target="_blank" ><img src="'.$DIR.'/img/transparencia/archive-pdf.png"><span>'.$link['titulo'].'</span></a></li>';
				}
			$texto .='</ul>';
			$texto .='</div>';

		}else{
			$anidar .='<div>';
			$anidar .='<h3>'.$grupo['grupos'].'</h3>';
			$anidar .='<ul>';
				foreach ($query_links->result_array() as $link) {
					$anidar .='<li><a href="'.base_url().'media/files/'.$link['archivo'].'" target="_blank" ><img src="'.$DIR.'/img/transparencia/archive-pdf.png"><span>'.$link['titulo'].'</span></a></li>';
				}
			$anidar .='</ul>';
			$anidar .='</div>';
		}
	}
		$data = array(
	        'MODIFICACION' => $this->modified(),
	        'TITULO' => $acceso['nombre'],
	        'DIR' => $DIR,
	        'GRUPOS' => $anidar,
	        'CONVOCATORIAS' => $texto
	        );
	$accesos .= $this->parser->parse('transparencia/'.$tmp_7.'', $data, TRUE);
	?>