<?php

header('Content-type: application/xml');
echo file_get_contents("http://intranet.sapal.gob.mx:2948/Estaciones/wsestmet.asp");

?>