<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proyectosprioritarios extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
		$this->load->model('pp_model');
	}

	public function index($id=1)
	{
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('proyectosprioritarios');
		view_section('pp', 'proyectosprioritarios', $data);
	}
	public function get($tagname) {
		$pp = $this->pp_model->get_contents($tagname);
		$data['DIR'] = base_url();
		$data['TITULO'] = $pp['titulo'];
		$data['PREV'] = $pp['prev'];
		$data['NEXT'] = $pp['next'];
		$data['CONTENT'] = $pp['content'];
		$data['BANNERS'] = $this->site_model->getbanners('proyectosprioritarios');
		view_section('template', 'proyectosprioritarios', $data);
	}
}