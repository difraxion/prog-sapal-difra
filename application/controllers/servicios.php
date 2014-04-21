<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Servicios extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
		$this->load->model('servicios_model');
	}
	public function index($servicio='listado') {
		$data['DIR'] = base_url();
		$data['SERVICIO'] = $this->parser->parse('servicios/'.$servicio, $this->data($servicio), true);
		$data['BANNERS'] = $this->site_model->getbanners('servicios');
		view_section('servicios', 'servicios', $data);
	}

	private function data($s) {
		$data['DIR'] = base_url();
		$data['MINI_LISTADO'] = $this->mini_listado($s);
		switch ($s) {
			case 'avisosdesuspension':
				$data['AVISOS'] = $this->servicios_model->avisos();
				break;
			case 'cuotasytarifas':
				$data['CONSUMO'] = $this->servicios_model->consumo();
				$data['CONTRATACION'] = $this->servicios_model->contratacion();
				break;
		}
		return $data;
	}

	private function mini_listado($serv) {
		$mini_listado = '<ul class="ul_hoz tac" id="ul_mini_listado">';
		$mini_listado .= '<li class="li-aguapotable'.($serv=='aguapotable'?' activate':'').'"><a href="'.base_url().'servicios/aguapotable" class="db min-serv min-agua" title="Agua Potable"></a></li>';
		$mini_listado .= '<li class="li-saneamiento'.($serv=='saneamiento'?' activate':'').'"><a href="'.base_url().'servicios/saneamiento" class="db min-serv min-saneamiento" title="Saneamiento"></a></li>';
		$mini_listado .= '<li class="li-alcantarillado'.($serv=='alcantarillado'?' activate':'').'"><a href="'.base_url().'servicios/alcantarillado" class="db min-serv min-alcantarillado" title="Alcantarillado"></a></li>';
		$mini_listado .= '<li class="li-sucursales'.($serv=='sucursalesyhorarios'?' activate':'').'"><a href="'.base_url().'servicios/sucursalesyhorarios" class="db min-serv min-sucursales" title="Sucursales y Horarios"></a></li>';
		$mini_listado .= '<li class="li-requisitos'.($serv=='requisitos'?' activate':'').'"><a href="'.base_url().'transparencia/leydetransparencia/serviciostramites?id=13" class="db min-serv min-requisitos rfalse" title="Requisitos"></a></li>';
		$mini_listado .= '<li class="li-cuotas'.($serv=='cuotasytarifas'?' activate':'').'"><a href="'.base_url().'servicios/cuotasytarifas" class="db min-serv min-cuotas rfalse" title="Cuotas y Tarifas"></a></li>';
		$mini_listado .= '<li class="li-reglamentos'.($serv=='reglamentos'?' activate':'').'"><a href="'.base_url().'transparencia/leydetransparencia/leyesyreglamentos?id=5" class="db min-serv min-reglamentos rfalse" title="Reglamentos"></a></li>';
		$mini_listado .= '<li class="li-suspension'.($serv=='avisosdesuspension'?' activate':'').'"><a href="'.base_url().'servicios/avisosdesuspension" class="db min-serv min-suspension" title="Avisos de Suspensión"></a></li>';
		$mini_listado .= '<li class="li-compras'.($serv=='sapalcompra'?' activate':'').'"><a href="'.base_url().'servicios/sapalcompra" class="db min-serv min-compra" title="SAPAL Compra"></a></li></ul>';
		$mini_listado .= $this->serv_header($serv);
		return $mini_listado;
	}

	private function serv_header($serv) {
		$sh = '';
		switch ($serv) {
			case 'aguapotable': return '<div class="mini-title mini-title-aguapotable tac"><h1 class="dib ico-aguapotable">&nbsp;AGUA POTABLE</h1></div>';
				break;
			case 'saneamiento': return '<div class="mini-title mini-title-saneamiento tac"><h1 class="dib ico-saneamiento">SANEAMIENTO</h1></div>';
				break;
			case 'alcantarillado': return '<div class="mini-title mini-title-alcantarillado tac"><h1 class="dib ico-alcantarillado">&nbsp;ALCANTARILLADO</h1></div>'; 
				break;
			case 'sucursalesyhorarios': return '<div class="mini-title mini-title-sucursales tac"><h1 class="dib ico-sucursales">&nbsp;SUCURSALES Y HORARIOS</h1></div>';
				break;
			case 'requisitos': return '<div class="mini-title mini-title-requisitos tac"><h1 class="dib ico-requisitos">REQUISITOS Y SOLICITUD DE CONTRATO</h1></div>';
				break;
			case 'cuotasytarifas': return '<div class="mini-title mini-title-cuotas tac"><h1 class="dib ico-cuotas">CUOTAS Y TARIFAS</h1></div>';
				break;
			case 'reglamentos': return '<div class="mini-title mini-title-reglamentos tac"><h1 class="dib ico-reglamentos">REGLAMENTOS</h1></div>';
				break;
			case 'avisosdesuspension': return '<div class="mini-title mini-title-suspension tac"><h1 class="dib ico-suspension">&nbsp;AVISOS DE SUSPENSIÓN</h1></div>';
				break;
			case 'sapalcompra': return '<div class="mini-title mini-title-compras tac"><h1 class="dib ico-compras">&nbsp;SAPAL COMPRA</h1></div>';
				break;
		}
	}
	public function proveedores() {
		$msg = '';
		$salto=array("\r","\n","\r\n","\n\r");
		$post = $this->input->post();
		if($post) {
			$this->load->library('form_validation');
	    	$this->form_validation->set_rules('prov_nombre', 'Nombre', 'required');
	    	$this->form_validation->set_rules('prov_empresa', 'Empresa', 'required');
	    	$this->form_validation->set_rules('prov_email', 'E-mail', 'required|valid_email');
	    	$this->form_validation->set_rules('prov_productos', 'Productos', 'required');
	    	if($this->form_validation->run()){
	    		if (isset($_FILES["file"])) {
	    			$config['upload_path'] = './media/files/';
					$config['allowed_types'] = 'jpg|png|doc|docx|xls|xlsx|ppt|pptx|pdf';
					$config['max_size']	= '2048';
					$config['overwrite'] = false;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);	
					if(! $this->upload->do_upload('file')) {
						$msg = $this->upload->display_errors();
					} else {
						$updata = $this->upload->data();
						$this->servicios_model->insertar_proveedores_file($post, $updata['file_name']);
						$data = array(
			    			'DIR' => base_url(),
			    			'NOMBRE' => $post['prov_nombre'],
			    			'EMPRESA' => $post['prov_empresa'],
			    			'EMAIL' => $post['prov_email'],
			    			'PRODUCTOS' => $post['prov_productos'],
			    			'FILE' => '<p><strong>Catálogo:</strong>&nbsp;<a href="'.base_url().'media/files/'.$updata['file_name'].'" target="_blank">'.$updata['file_name'].'</a></p>'
			    		);
			    		$msj = $this->parser->parse('servicios/mail_proveedores', $data, true);
			    		$this->load->library('email');
						$config['mailtype'] = 'html';
		    			$this->email->initialize($config);
		    			$this->email->from($post['prov_email'], $post['prov_empresa']);
		                $this->email->to('compras@sapal.gob.mx');
		                $this->email->subject('Registro de Proveedores de Sapal');
		                $this->email->message($msj);
						$this->email->send();
                		$msg = 'Tu registro ha sido enviado, Gracias';
					}
	    		} else {
	    			$this->servicios_model->insertar_proveedores($post);
		    		$data = array(
		    			'DIR' => base_url(),
		    			'NOMBRE' => $post['prov_nombre'],
		    			'EMPRESA' => $post['prov_empresa'],
		    			'EMAIL' => $post['prov_email'],
		    			'PRODUCTOS' => $post['prov_productos'],
		    			'FILE' => ''
		    		);
		    		$msj = $this->parser->parse('servicios/mail_proveedores', $data, true);
		    		$this->load->library('email');
					$config['mailtype'] = 'html';
	    			$this->email->initialize($config);
	    			$this->email->from($post['prov_email'], $post['prov_empresa']);
	                $this->email->to('compras@sapal.gob.mx');
	                $this->email->subject('Registro de Proveedores de Sapal');
	                $this->email->message($msj);
	    			$this->email->send();
                	$msg = 'Tu registro ha sido enviado, Gracias';
	    		}
	    	} else {
	    		$msg = str_replace($salto,'',validation_errors());
	    	}
	    } else {
	    	$msg = 'Información vacía';
	    }
	    echo $msg;
	}
}