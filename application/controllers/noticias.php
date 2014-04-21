<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Noticias extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
		$this->load->model('noticias_model');
		$this->load->library("pagination");
	}

	public function index($page='')
	{
		$listado = $this->listado($page); 
		$data['DIR'] = base_url();
		$data['PAGINADO'] = $listado['PAGINADO'];
		$data['LISTADO'] = $listado['CONTENIDO'];
		$data['DESTACADOS'] = $this->noticias_model->get_destacados();
		$data['VISITADO'] = $this->noticias_model->get_count();
		$data['BANNERS'] = $this->site_model->getbanners('noticias');
		view_section('noticias', 'noticias', $data);
	}
	
	private function listado($page) {
		$config = array();
		$config["base_url"] = base_url().'noticias';
		$config["total_rows"] = $this->noticias_model->getall_noticias();
		$config["per_page"] = 5;
		$config["uri_segment"] = 2;
		$this->pagination->initialize($config);
		$array_return = array('CONTENIDO' => $this->noticias_model->get_noticias($config["per_page"], $page), 'PAGINADO' => $this->pagination->create_links());
		return $array_return;
	}

	public function detalle($id='', $page='0') {
		$data['DIR'] = base_url();
		$data['PAGE'] = ($page==0?'':$page);
		$data['NOTICIA'] = $this->noticias_model->get_noticia($id, $page);
		$data['DESTACADOS'] = $this->noticias_model->get_destacados();
		$data['VISITADO'] = $this->noticias_model->get_count();
		$data['BANNERS'] = $this->site_model->getbanners('noticias');
		view_section('detalle', 'noticias', $data);
	}
	public function pdf($id='') {
		$this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
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
        $pdf->SetFont('Helvetica', '', 12, '', true);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
        //$pdf->Write(5, 'Ejemplo');
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $this->noticias_model->pdf($id), $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('sapalcomunicado-'.$id.'.pdf', 'I');

	}

}