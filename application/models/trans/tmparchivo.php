<?php
$query_archivo = $this->db->query('SELECT titulo, archivo, id FROM trans_acc_informacion where category='.$acceso['category'].' order by id DESC');
	$anidar .='<ul>';
	foreach ($query_archivo->result_array() as $archivo) {
				$anidar .='<li><a href="'.base_url().'media/files/'.$archivo['archivo'].'" target="_blank" ><img src="'.$DIR.'/img/transparencia/archive-pdf.png"><span>'.$archivo['titulo'].'</span></a></li>';
	}
	$anidar .='</ul>';
//$data['MODIFICACION']
$data = array(
    'MODIFICACION' => $this->modified(),
    'TITULO' => $acceso['nombre'],
    'DIR' => $DIR,
    'ARCHIVE' => $anidar
    );
$accesos .= $this->parser->parse('transparencia/'.$tmp_4.'', $data, TRUE);
?>