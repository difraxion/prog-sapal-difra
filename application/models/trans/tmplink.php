<?php
$query_grupos = $this->db->query('SELECT id, grupos FROM trans_acc_informacion where category='.$acceso['category'].' group by (grupos) order by id DESC');
	foreach ($query_grupos->result_array() as $grupo) {
		$query_links = $this->db->query('SELECT id, titulo, link FROM trans_acc_informacion where category='.$acceso['category'].' and grupos="'.$grupo['grupos'].'" order by id DESC');

			$anidar .='<div>';
			$anidar .='<h2>'.$grupo['grupos'].'</h2>';
			$anidar .='<ul>';
				foreach ($query_links->result_array() as $link) {
					$anidar .='<li><a href="'.$link['link'].'" target="_blank">'.$link['titulo'].'</a></li>';
				}
			$anidar .='</ul>';
			$anidar .='</div>';
		
	}
		$data = array(
	        'MODIFICACION' => $this->modified(),
	        'TITULO' => $acceso['nombre'],
	        'DIR' => $DIR,
	        'GRUPOS' => $anidar
	        );
	$accesos .= $this->parser->parse('transparencia/'.$tmp_3.'', $data, TRUE);
?>