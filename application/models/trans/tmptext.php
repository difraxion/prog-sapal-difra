<?php
$query_texto = $this->db->query('SELECT texto, id FROM trans_acc_informacion where category='.$acceso['category'].' order by id DESC');
	$anidar .='<p>';
	foreach ($query_texto->result_array() as $texto) {
				$anidar .=$texto['texto'];
	}
	$anidar .='</p>';
$data = array(
    'MODIFICACION' => $this->modified(),
    'TITULO' => $acceso['nombre'],
    'DIR' => $DIR,
    'TEXTO' => $anidar
    );
$accesos .= $this->parser->parse('transparencia/'.$tmp_2.'', $data, TRUE);
?>