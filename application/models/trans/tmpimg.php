<?php
$data = array(
    'MODIFICACION' => $this->modified(),
    'TITULO' => $acceso['nombre'],
    'DIR' => $DIR,
    'IMG' => $acceso['img']
    );
$accesos .= $this->parser->parse('transparencia/'.$tmp_1.'', $data, TRUE);
?>