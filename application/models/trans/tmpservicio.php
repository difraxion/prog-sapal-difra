<?php
$query_grupos = $this->db->query('SELECT grupos, archivo, id FROM trans_acc_informacion where category='.$acceso['category'].' group by (grupos) order by id DESC');
	foreach ($query_grupos->result_array() as $grupo) {
		if ($grupo['archivo']!=NULL || $grupo['archivo']!=""){
			$query_links = $this->db->query('SELECT titulo, link, archivo, texto, id FROM trans_acc_informacion where category='.$acceso['category'].' and grupos="'.$grupo['grupos'].'" order by id DESC');
				$anidar .='<div>';
				$anidar .='<h2>'.$grupo['grupos'].'</h2>';
				$anidar .='<ul>';
					foreach ($query_links->result_array() as $link) {
							$anidar .='<li><a href="'.base_url().'media/files/'.$link['archivo'].'" target="_blank" ><img src="'.$DIR.'/img/transparencia/archive-pdf.png"><span>'.$link['titulo'].'</span></a></li>';
					}
				$anidar .='</ul>';
				$anidar .='</div>';
	}else
	{
			$query_links = $this->db->query('SELECT titulo, link, archivo, texto, id FROM trans_acc_informacion where category='.$acceso['category'].' and grupos="'.$grupo['grupos'].'" order by id DESC');
				$texto .='<div>';
				$texto .='<h2>'.$grupo['grupos'].' </h2>';
					foreach ($query_links->result_array() as $link) {
							$texto .= $link['texto'];
					}
				$texto .='</div>';
	}
}

		$data = array(
            'MODIFICACION' => $this->modified(),
            'TITULO' => $acceso['nombre'],
            'DIR' => $DIR,
            'GRUPOS' => $anidar,
            'TEXTO' => $texto
            );
	$accesos .= $this->parser->parse('transparencia/'.$tmp_6.'', $data, TRUE);
	?>