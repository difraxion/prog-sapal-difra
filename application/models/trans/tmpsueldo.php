<?php
$query_texto = $this->db->query('SELECT * FROM trans_sueldos ');
	foreach ($query_texto->result_array() as $texto) {
			$anidar .='<tr>';
				$anidar .='<th class="algo" id="sueld-'.$texto['nivel'].'">'.$texto['nivel'].'</th>';
				$anidar .='<td>'.$texto['suel_bruto'].'</td>';
				$anidar .='<td>'.$texto['suel_neto'].'</td>';
				$anidar .='<td>'.$texto['prima'].'</td>';
				$anidar .='<td>'.$texto['aguinaldo'].'</td>';
				$anidar .='<td>'.$texto['vales'].'</td>';
				$anidar .='<td>'.$texto['prevencion'].'</td>';
				$anidar .='<td>'.$texto['fondo'].'</td>';
				$anidar .='<td>'.$texto['vacaciones'].'</td>';
				$anidar .='<td>'.$texto['seguro'].'</td>';
		$anidar .='</tr>';
	}

$data = array(
    'MODIFICACION' => $this->modified(),
    'TITULO' => $acceso['nombre'],
    'DIR' => $DIR,
    'TEXTO' => $anidar
    );
$accesos .= $this->parser->parse('transparencia/'.$tmp_5.'', $data, TRUE);
?>