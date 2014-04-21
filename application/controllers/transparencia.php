<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transparencia extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
		$this->load->model('transparencia_model');
	}

	public function index($id='transparencia')
	{
		$data['DIR'] = base_url();
		$data['VISITAS'] = $this->transparencia_model->visitas();
		$data['BANNERS'] = $this->site_model->getbanners('transparencia');
		$data['MODIFICACION'] = $this->transparencia_model->modified();
		$data['MENU'] = $this->transparencia_model->menu($home='transparencia',$seccion='',$item='');
		view_section($id, 'transparencia', $data);
	}
	public function leycontable($id)
	{
		$data['DIR'] = base_url();
		$data['CONTABLE'] = $this->transparencia_model->get_infocontable(1);
		$data['PRESUPUESTAL'] = $this->transparencia_model->get_infocontable(2);
		$data['PROGRAMÁTICA'] = $this->transparencia_model->get_infocontable(3);
		$data['BIENES'] = $this->transparencia_model->get_infocontable(4);
		$data['VISITAS'] = $this->transparencia_model->visitas();
		$data['BANNERS'] = $this->site_model->getbanners('leygeneraldecontabilidad');
		$data['MENU'] = $this->transparencia_model->menu($home='transparencia',$seccion='leygeneraldecontabilidad',$item='');
		$data['MODIFICACION'] = $this->transparencia_model->modified();
		view_section($id, 'transparencia', $data);
	}
	public function leyacceso($id)
	{
		$data['DIR'] = base_url();
		$data['MENUACCESO'] = $this->transparencia_model->get_cat_acceso_publico(1);
		$data['VISITAS'] = $this->transparencia_model->visitas();
		$data['BANNERS'] = $this->site_model->getbanners('leydetransparencia');
		$data['MENU'] = $this->transparencia_model->menu($home='transparencia',$seccion='leydetransparencia',$item='');
		$data['MODIFICACION'] = $this->transparencia_model->modified();
		view_section($id, 'transparencia', $data);
	}
	public function leydetransparencia($id)
	{
		$url = $this->input->get_post('id', TRUE);
		$data['CONTENTTEMPLANTE'] = $this->transparencia_model->get_content_acceso_publico($url);	
		$data['VISITAS'] = $this->transparencia_model->visitas();
		$data['BANNERS'] = $this->site_model->getbanners('leydetransparencia');
		$data['MENU'] = $this->transparencia_model->menu($home='transparencia',$seccion='leydetransparencia',$item=$url);
		$data['MODIFICACION'] = $this->transparencia_model->modified();
		view_section('contenedor', 'transparencia', $data);
	}
	public function directoriopublico() {
		$data['CONTENTTEMPLANTE'] = $this->transparencia_model->directoriopublico();	
		$data['VISITAS'] = $this->transparencia_model->visitas();
		$data['BANNERS'] = $this->site_model->getbanners('leydetransparencia');
		$data['MODIFICACION'] = $this->transparencia_model->modified();
		view_section('contenedor', 'transparencia', $data);
	}
	public function contacto() {
		$salto=array("\r","\n","\r\n","\n\r");
		$post = $this->input->post();
    	if($post) {
    		$this->load->library('form_validation');
	    	$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
	    	$this->form_validation->set_rules('asunto', 'Asunto', 'required');
	    	$this->form_validation->set_rules('mensaje', 'Mensaje', 'required');
	    	if($this->form_validation->run()){
    			$send = array(
					'DIR' => base_url(),
					'EMAIL' => $post['email'],
					'ASUNTO' => $post['asunto'],
					'MSJ' => $post['mensaje']
				);
    			$query=$this->db->query('select folio from trans_contacto order by folio DESC limit 1');
    			$row = $query->row();
    			$num= explode('/', $row->folio);  
    			$folioanterior=$num[0];
    			$fecha=date("y");
    			$folio='';
    			$folio.=$folioanterior+1;
    			$folio.='/';
    			$folio.=$fecha;	
    			$solicitud = array(
					'folio' => $folio,
					'asunto' => $post['email'],
					'email' => $post['asunto'],
					'mensaje' => $post['mensaje']
				);
				$this->db->insert('trans_contacto',$solicitud);
				$msj = $this->parser->parse('transparencia/mod/mail_info', $send, true);
				$this->load->library('email');
				$config['mailtype'] = 'html';
    			$this->email->initialize($config);
    			$this->email->from($post['email'],$post['email']);
                //$this->email->to('ing.daniel.venegas@gmail.com');
                $this->email->to('uacceso@sapal.gob.mx');
                $this->email->subject('Solicitud de Información Pública');
                $this->email->message($msj);
                $this->email->send();
                echo 'Su información ha sido enviada';
    		} else 
    			echo str_replace($salto,'',validation_errors());
    	} else
    		echo 'Solicitud vacía';
	}
}