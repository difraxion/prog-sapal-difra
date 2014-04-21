<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent:: __construct ();
		$this->load->model('noticias_model');
	}
	public function index($s='inicio', $c='') {
		view_section($s, $c, $this->data($s));
	}
	private function data($s) {
		$data['DIR'] = base_url();
		$data['DATE'] = DATE('d M, Y, h:i a');
		$data['BANNERS'] = $this->site_model->getbanners($s);
		switch ($s) {
			case 'inicio':
				$data['NOTICIAS'] = $this->noticias_model->get_noticia_ini();
				break;
			case 'licitaciones':
				$data['LICITACIONES'] = $this->site_model->licitaciones();
				$data['LAST_DATE'] = $this->site_model->licitaciones_update();
				break;
			case 'descargas':
				$data['DESCARGAS'] = $this->site_model->descargas();
				break;
			case 'est-meteorologicas':
				$data['FECHA'] =  $this->site_model->fecha();
				break;
		}
		return $data;
	}
	public function licitaciones($id) {
		$data['DIR'] = base_url();
		$data['LICITACION'] = $this->site_model->licitaciones_byid($id);
		$data['BANNERS'] = $this->site_model->getbanners('licitaciones');
		view_section('licitacion', '', $data);
	}
	public function sendnew() {
		$post = $this->input->post();
		echo 'hola';
		//echo $post['email'].' '.$post['msg'].' '.$post['destino'];
	}
}

