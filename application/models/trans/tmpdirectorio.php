<?php
$directorio = '';
$directorio .= '<div class="sueldos directorio tbl-dir">';
$directorio .= '<div class="tar"><a class="lnk_gral dib" href="'.$DIR.'transparencia/directoriopublico">Directorio de Servicios Públicos</a></div>';
$directorio .= '<table>';
$directorio .= '<thead class="f1">';
$directorio .= '<tr>';
$directorio .= '<th>Nombre</th>';
$directorio .= '<th>Cargo</th>';
$directorio .= '<th>Telefono</th>';
$directorio .= '<th>Ext.</th>';
$directorio .= '<th>Correo</th>';
$directorio .= '</tr>';
$directorio .= '</thead>';
$directorio .= '<tbody>';


$query_texto = $this->db->query('SELECT * FROM trans_directorio ORDER BY id ASC');
	foreach ($query_texto->result_array() as $texto) {
			$directorio .='<tr>';
				$directorio .='<td>'.$texto['nombre'].'</td>';
				$directorio .='<td>'.$texto['cargo'].'</td>';
				$directorio .='<td>'.$texto['telefono'].'</td>';
				$directorio .='<td>'.$texto['extencion'].'</td>';
				$directorio .='<td>'.$texto['correo'].'</td>';
				$directorio .='</tr>';
	}
$directorio .= '</tbody>';
$directorio .= '</table>';
$directorio .= '</div>';						
						
$data = array(
    'MODIFICACION' => $this->modified(),
    'TITULO' => $acceso['nombre'],
    'DIR' => $DIR,
    'DIRECTORIO' => $directorio
    );
$accesos .= $this->parser->parse('transparencia/'.$tmp_8.'', $data, TRUE);
?>