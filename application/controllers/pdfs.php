<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pdfs_model');
    }
    
    public function index()
    {
        //$data['provincias'] llena el select con las provincias españolas
        $data['provincias'] = $this->pdfs_model->getProvincias();
        //cargamos la vista y pasamos el array $data['provincias'] para su uso
        $this->load->view('pdfs_view', $data);
    }

    public function generar() {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        //$pdf->SetDisplayMode('real', 'default');// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 14, '', true);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
        $pdf->Write(5, 'Ejemplo');
        $pdf->Output('some.pdf', 'I');
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
    }
    function horas() {
        echo $this->dif('17:00:00','12:01:00');
        echo '<br />';
        echo strtotime($this->dif('17:00:00','12:01:00'));    
        echo '<br />';
        echo strtotime($this->dif('17:00:00','12:00:00'));    
        echo '<br />';
        if(((float)strtotime($this->dif('16:59:59','12:00:00')))>=1395831600) 
            echo '<br />si<br/>';
        else
            echo '<br />no<br/>';
        $fecha = date("Y-m-d");
        if($this->dateDiff("2014-03-26", $fecha)==0)
            echo '<br />si<br/>';
        else
            echo '<br />no<br/>';
    }
    function dif($h1,$h2){
    $h=((strtotime($h1)-strtotime($h2)))/3600;
    $m=intval((($h)-intval($h))*60);
    $s=intval((((($h)-intval($h))*60)-$m)*60);
    return (intval($h)<10?'0'.intval($h):intval($h)).':'.($m<10?'0'.$m:$m).':'.($s<10?'0'.$s:$s);
    }
    function dateDiff($start, $end) { 
        $start_ts = strtotime($start); 
        $end_ts = strtotime($end); 
        $diff = $end_ts - $start_ts; 
        return round($diff / 86400); 
    } 
}