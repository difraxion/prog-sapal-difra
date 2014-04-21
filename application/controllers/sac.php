<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sac extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
	}
	public function index() {
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('sac');
		$data['SCRIPT'] = '';
		if(chk_session()) {
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$send = array(
				'DIR' => base_url(),
				'NOMBRE' => $this->sac_model->get_name($this->session->userdata('cuenta'),$this->session->userdata('usuario'))
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/inicio', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			$data['SESION'] = '<a href="" id="lnk-loading" class="db">INICIAR SESIÓN</a><a href="" id="lnk-pagosin" class="db">PAGO SIN REGISTRO</a>';
			$send = array(
				'DIR' => base_url(),
				'PREGUNTAS' => $this->sac_model->get_preguntas(),
				'LOGIN' => '',
				'NUEVO' => ''
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/login', $send, true);
			view_section('sac', 'sac', $data);
		}
	}
	public function pago_cookie() {
		$this->load->helper('cookie');     
		if(!$this->input->cookie($this->session->userdata('cuenta').'_P1')) {
			$cookie = array(
                'name'   => $this->session->userdata('cuenta').'_P1',
                'value'  => '1',
                'expire' =>  86400,
                'secure' => false
            );
            $this->input->set_cookie($cookie);
            return '1';
		} elseif (!$this->input->cookie($this->session->userdata('cuenta').'_P2')) {
			$cookie = array(
                'name'   => $this->session->userdata('cuenta').'_P2',
                'value'  => '2',
                'expire' =>  86400,
                'secure' => false
            );
            $this->input->set_cookie($cookie);
            return '2';
		} elseif(!$this->input->cookie($this->session->userdata('cuenta').'_P3')) {
			$cookie = array(
                'name'   => $this->session->userdata('cuenta').'_P3',
                'value'  => '3',
                'expire' =>  86400,
                'secure' => false
            );
            $this->input->set_cookie($cookie);
            return '3';
		} else 
			return '4';
	}
	public function login() {
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('sac');
		$data['SCRIPT'] = '<script>$(window).load(function(){$("html, body").animate({scrollTop: 1080}, 1200);});</script>';
		$data['SESION'] = '<a href="" id="lnk-loading" class="db">INICIAR SESIÓN</a><a href="" id="lnk-pagosin" class="db">PAGO SIN REGISTRO</a>';
		$send = array(
			'DIR' => base_url(),
			'PREGUNTAS' => $this->sac_model->get_preguntas(),
			'LOGIN' => 'activate',
			'NUEVO' => ''
		);
		$data['SUBCONTENT'] = $this->parser->parse('sac/login', $send, true);
		view_section('sac', 'sac', $data);
	}
	public function registrate() {
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('sac');
		$data['SCRIPT'] = '<script>$(window).load(function(){$("html, body").animate({scrollTop: 1140}, 1200);});</script>';
		$data['SESION'] = '<a href="" id="lnk-loading" class="db">INICIAR SESIÓN</a><a href="" id="lnk-pagosin" class="db">PAGO SIN REGISTRO</a>';
		$send = array(
			'DIR' => base_url(),
			'PREGUNTAS' => $this->sac_model->get_preguntas(),
			'LOGIN' => '',
			'NUEVO' => 'activate'
		);
		$data['SUBCONTENT'] = $this->parser->parse('sac/login', $send, true);
		view_section('sac', 'sac', $data);
	}
	public function inicio() {
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('sac');
		$data['SCRIPT'] = '<script>$(window).load(function(){$("html, body").animate({scrollTop: 940}, 1200);});</script>';
		$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
		$send = array(
			'DIR' => base_url(),
			'NOMBRE' => $this->sac_model->get_name($this->session->userdata('cuenta'),$this->session->userdata('usuario'))
		);
		$data['SUBCONTENT'] = $this->parser->parse('sac/inicio', $send, true);
		view_section('sac', 'sac', $data);
	}
	public function recuperarcontrasena() {
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('sac');
		$data['SCRIPT'] = '<script>$(window).load(function(){$("html, body").animate({scrollTop: 360}, 1200);});</script>';
		$data['SESION'] = '<a href="'.base_url().'sac/login" class="db">INICIAR SESIÓN</a><a href="" id="lnk-pagosin" class="db">PAGO SIN REGISTRO</a>';
		$send = array(
			'DIR' => base_url(),
			'PREGUNTAS' => $this->sac_model->get_preguntas(),
		);
		$data['SUBCONTENT'] = $this->parser->parse('sac/recuperarcontrasena', $send, true);
		view_section('sac', 'sac', $data);
	}
	public function pagosinregistro() {
		$data['DIR'] = base_url();
		$data['BANNERS'] = $this->site_model->getbanners('sac');
		$data['SESION'] = '<a href="'.base_url().'sac/login" class="db">INICIAR SESIÓN</a><a href="" id="lnk-pagosin" class="db">PAGO SIN REGISTRO</a>';
		if(chk_cuenta()) {
			$data['SCRIPT'] = '<script>$(window).load(function(){$("html, body").animate({scrollTop: 360}, 1200);});</script>';
			$xml = ws(1, array('cuenta'=>$this->session->userdata('cuenta')));
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'PAGA TU RECIBO',
				'CUENTA' => $this->number_pad(trim($xml->cuenta)),
				'TOTAL_A_PAGAR' => $xml->saldo,
				'MONTO' => str_replace(',', '', $xml->saldo),
				'VENCIMIENTO' => $xml->limitepago,
				'NOMBRE' => trim($xml->nombre),
				'GIRO' => $xml->giro,
				'CALLE' => $xml->calle,
				'COLONIA' => $xml->colonia,
				'MES_FACTURA' => $xml->mesfacturacion,
				'CONSUMO_PROMEDIO' => $xml->consumopromedio,
				'LECTURA_ANTERIOR' => $xml->lecturaanterior,
				'MESES_ADEUDO' => $xml->mesesadeudo,
				'TOMAS' => $xml->tomas,
				'TARIFA' => $xml->tarifa,
				'MEDIDOR' => $xml->nummedidor,
				'CONTROL' => $xml->ubicacionmedidor,
				'ESTATUS' => $this->sac_model->estatus($xml->estatus),
				'CORTADO' => $this->sac_model->cortado($xml->cortado),
				'DIRECCION' => $xml->calle.' COL. '.$xml->colonia,
				'TRANSM' => date('Y').$this->sac_model->mes($xml->limitepago).$this->number_pad(trim($xml->cuenta)),
				'PAGO_EXCEDIDO' => ($this->pago_cookie()=='4'?'Sólo se adminten 3 pagos por tarjeta al día':'')
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/recibo', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			$data['SCRIPT'] = '<script>$(window).load(function(){$("#pagoturecibo").animate({height:294}, 300, function(){$(".wrapper, hr").fadeIn("fast");});});</script>';
			$send = array(
				'DIR' => base_url(),
				'PREGUNTAS' => $this->sac_model->get_preguntas(),
				'LOGIN' => '',
				'NUEVO' => ''
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/login', $send, true);
			view_section('sac', 'sac', $data);
		}
	}
	public function pagaturecibo() {
		if(chk_session()) {
			$data['DIR'] = base_url();
			$data['BANNERS'] = $this->site_model->getbanners('sac');
			$data['SCRIPT'] = '<script>$(window).load(function(){$("html, body").animate({scrollTop: 360}, 1200);});</script>';
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$xml = ws(1, array('cuenta'=>$this->session->userdata('cuenta')));
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'PAGA TU RECIBO',
				'CUENTA' => $this->number_pad(trim($xml->cuenta)),
				'TOTAL_A_PAGAR' => $xml->saldo,
				'MONTO' => str_replace(',', '', $xml->saldo),
				'VENCIMIENTO' => $xml->limitepago,
				'NOMBRE' => trim($xml->nombre),
				'GIRO' => $xml->giro,
				'CALLE' => $xml->calle,
				'COLONIA' => $xml->colonia,
				'MES_FACTURA' => $xml->mesfacturacion,
				'CONSUMO_PROMEDIO' => $xml->consumopromedio,
				'LECTURA_ANTERIOR' => $xml->lecturaanterior,
				'MESES_ADEUDO' => $xml->mesesadeudo,
				'TOMAS' => $xml->tomas,
				'TARIFA' => $xml->tarifa,
				'MEDIDOR' => $xml->nummedidor,
				'CONTROL' => $xml->ubicacionmedidor,
				'ESTATUS' => $this->sac_model->estatus($xml->estatus),
				'CORTADO' => $this->sac_model->cortado($xml->cortado),
				'DIRECCION' => $xml->calle.' COL. '.$xml->colonia,
				'TRANSM' => date('Y').$this->sac_model->mes($xml->limitepago).$this->number_pad(trim($xml->cuenta)),
				'PAGO_EXCEDIDO' => ($this->pago_cookie()=='4'?'Sólo se adminten 3 pagos por tarjeta al día':'')
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/recibo', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			redirect(base_url().'sac/login');
		}
	}
	public function tusaldo() {
		if(chk_session()) {
			$data['DIR'] = base_url();
			$data['BANNERS'] = $this->site_model->getbanners('sac');
			$data['SCRIPT'] = '';
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$xml = ws(1, array('cuenta'=>$this->session->userdata('cuenta')));
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'TU SALDO',
				'CUENTA' => $this->number_pad(trim($xml->cuenta)),
				'TOTAL_A_PAGAR' => $xml->saldo,
				'VENCIMIENTO' => $xml->limitepago,
				'NOMBRE' => trim($xml->nombre),
				'GIRO' => $xml->giro,
				'CALLE' => $xml->calle,
				'COLONIA' => $xml->colonia,
				'MES_FACTURA' => $xml->mesfacturacion,
				'CONSUMO_PROMEDIO' => $xml->consumopromedio,
				'LECTURA_ANTERIOR' => $xml->lecturaanterior,
				'MESES_ADEUDO' => $xml->mesesadeudo,
				'TOMAS' => $xml->tomas,
				'TARIFA' => $xml->tarifa,
				'MEDIDOR' => $xml->nummedidor,
				'CONTROL' => $xml->ubicacionmedidor,
				'ESTATUS' => $this->sac_model->estatus($xml->estatus),
				'CORTADO' => $this->sac_model->cortado($xml->cortado),
				'DIRECCION' => $xml->calle.' COL. '.$xml->colonia,
				'TRANSM' => date('Y').$this->sac_model->mes($xml->limitepago).$this->number_pad(trim($xml->cuenta))
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/tusaldo', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			redirect(base_url().'sac/login');
		}
	}
	public function ultimosmovimientos() {
		if(chk_session()) {
			$data['DIR'] = base_url();
			$data['BANNERS'] = $this->site_model->getbanners('sac');
			$data['SCRIPT'] = '';
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$xml = ws(3, array('cuenta'=>$this->session->userdata('cuenta')));
			$tabla = '<table class="last-moves">
						<caption>Últimos Movimientos</caption>
						<thead>
						<tr>
							<th>DESCRIPCIÓN</th>
							<th>FECHA</th>
							<th>MONTO</th>
							<th>IVA</th>
							<th>SALDO</th>
						</tr>
					</thead>
					<tbody>';
			foreach ($xml->registro as $reg) {
				$tabla .= '<tr><td>'.$reg->concepto.'</td>';
				$tabla .= '<td>'.$reg->periodofac.'</td>';	
				$tabla .= '<td>'.$reg->monto.'</td>';	
				$tabla .= '<td>'.$reg->iva.'</td>';	
				$tabla .= '<td>'.$reg->saldo.'</td></tr>';	
			}
			$tabla .= '</tbody></table>';
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'ESTADO DE CUENTA',
				'TABLA' => $tabla
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/ultimosmovimientos', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			redirect(base_url().'sac/login');
		}
	}
	public function reportes() {
		if(chk_session()) {
			$data['DIR'] = base_url();
			$data['BANNERS'] = $this->site_model->getbanners('sac');
			$data['SCRIPT'] = '';
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'REPORTES',
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/reportes', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			redirect(base_url().'sac/login');
		}
	}
	public function seguimiento() {
		if(chk_session()) {
			$data['DIR'] = base_url();
			$data['BANNERS'] = $this->site_model->getbanners('sac');
			$data['SCRIPT'] = '';
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'REPORTES',
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/seguimiento', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			redirect(base_url().'sac/login');
		}
	}
	public function registrosdeconsumos() {
		if(chk_session()) {
			$data['DIR'] = base_url();
			$data['BANNERS'] = $this->site_model->getbanners('sac');
			$data['SCRIPT'] = '';
			$data['SESION'] = '<a href="'.base_url().'sac/pagaturecibo" class="db">PAGAR</a><a href="'.base_url().'sac/salir" class="db">CERRAR SESIÓN</a>';
			$xml = ws(2, array('cuenta'=>$this->session->userdata('cuenta')));
			$tabla = '<table class="last-moves">
						<caption>Registo de Consumo</caption>
						<thead>
						<tr>
							<th>PERIODO DE FACTURACIÓN</th>
							<th>CONSUMO</th>
							<th>LECTURA</th>
							<th>FECHA DE LECTURA</th>
						</tr>
					</thead>
					<tbody>';
			foreach ($xml->registro as $reg) {
				$tabla .= '<tr><td>'.$reg->periodofac.'</td>';
				$tabla .= '<td>'.$reg->consumo.'</td>';	
				$tabla .= '<td>'.$reg->lectura.'</td>';	
				$tabla .= '<td>'.$reg->fechalec.'</td></tr>';	
			}
			$tabla .= '</tbody></table>';
			$send = array(
				'DIR' => base_url(),
				'TITLE' => 'HISTORIAL',
				'TABLA' => $tabla
			);
			$data['SUBCONTENT'] = $this->parser->parse('sac/registrosdeconsumos', $send, true);
			view_section('sac', 'sac', $data);
		}
		else {
			redirect(base_url().'sac/login');
		}
	}
	private function number_pad($number) {
		return str_pad((int) $number,7,"0",STR_PAD_LEFT);
	}
	public function salir() {
		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('cuenta');
        redirect(base_url().'sac/login');
	}
	public function chk_cuenta() {
		if(chk_cuenta())
			echo 'true';
		else
			echo 'false';
	}
	public function chk_session() {
		if(chk_session())
			echo 'true';
		else
			echo 'false';
	}
	public function chk_pago() {
		if(chk_cuenta()) {
			$post = $this->input->post();
			if($post) {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('impuesto', 'Impuesto', 'required|decimal');
				if($this->form_validation->run() && $post)
					echo 'true';
				else 
					echo 'false';
			}
			else
				echo 'false'; 
		}
		else {
			$this->salir();
		}
	}
	public function chk_registro() {
		$msg = '';
		$salto=array("\r","\n","\r\n","\n\r");
		$post = $this->input->post();
		if($post) {
			$this->load->library('form_validation');
	    	$this->form_validation->set_rules('nusuario', 'Usuario', 'required|max_length[35]');
	    	$this->form_validation->set_rules('correo', 'Correo Electrónico', 'required|valid_email|max_length[50]');
	    	$this->form_validation->set_rules('contrasena','Contraseña','required|max_length[8]');
	    	$this->form_validation->set_rules('cocontrasena','Confirmar Contraseña','required|matches[contrasena]|max_length[8]');
	    	$this->form_validation->set_rules('nombre','Nombre','required|max_length[50]');
	    	$this->form_validation->set_rules('apellidos','Apellidos','required|max_length[50]');
	    	$this->form_validation->set_rules('direccion','Calle','required|max_length[50]');
	    	$this->form_validation->set_rules('domicilio','Colonia','required|max_length[50]');
	    	$this->form_validation->set_rules('ncuenta','Cuenta','required|integer|max_length[7]');
	    	$this->form_validation->set_rules('nclave','Clave','required');
	    	$this->form_validation->set_rules('pregunta','Pregunta','required');
	    	$this->form_validation->set_rules('respuesta','Respuesta','required|max_length[30]');
	    	
	    	if($this->form_validation->run() && $post){
	    		if($this->sac_model->validar_usu_existente($this->toUpper($post['nusuario']))==0) {
	    			if($this->sac_model->validar_cuenta_existente($this->toUpper($post['ncuenta']))==0) {
			    		$data_xml = array(
			    			'cuenta' => $this->toUpper($post['ncuenta']),
			    			'clave' => $this->toUpper($post['nclave'])
			    		);
			    		$xml = ws(4, $data_xml);
			    		if($xml->clavevalida=='S'&&$xml->mensaje=='') {
							$msg = 'Gracias por registarse al Servicio de Atención a Clientes de Sapal, por favor veirifique su correo electrónico para concluir con el registro.';
							$data = array(
								'USCTAU' => $this->toUpper($post['ncuenta']),
								'USW_NOMBRE' => $this->toUpper($post['nombre']),
								'USW_APELLIDOS' => $this->toUpper($post['apellidos']),
								'USW_DIRECCION' => $this->toUpper($post['direccion']),
								'USW_DOMICILIO' => $this->toUpper($post['domicilio']),
								'USW_CONTRASENA' => $post['contrasena'],
								'USW_CORREOE' => $post['correo'],
								'USW_RESPUESTA' => $this->toUpper($post['respuesta']),
								'USW_ESTATUS' => 0,
								'PRE_ID' => $this->toUpper($post['pregunta']),
								'USW_USERNAME' => $this->toUpper($post['nusuario'])
							);
							$this->sac_model->insertar_usuario($data);
							$send = array(
								'DIR' => base_url(),
								'NOMBRE' => $this->toUpper($post['nombre']).' '.$this->toUpper($post['apellidos']),
								'URL' => base_url().'sac/activacion/'.$this->toUpper($post['nusuario']).'='.$this->toUpper($post['ncuenta'])
							);
							$msj = $this->parser->parse('sac/mail_usu', $send, true);
							$this->load->library('email');
							$config['mailtype'] = 'html';
                			$this->email->initialize($config);
                			$this->email->from('activacionsac@sapal.gob.mx', 'Sapal');
			                $this->email->to($post['correo']);
			                $this->email->subject('Activación al Sistema de Atención a Clientes (SAC)');
			                $this->email->message($msj);
			                $this->email->send();
						}
						elseif($xml->clavevalida=='N'&&$xml->mensaje!='') 
							$msg = $xml->mensaje;
						else
			    			$msg = 'Ocurrión un error al momento de procesar la información.<br />Por favor inténtalo más tarde';
			    	}
			    	else
			    		$msg = 'Ya existe un usuario relacionado a la cuenta';
		    	} else
		    		$msg = 'Ya existe un usuario: '.$post['nusuario'].', por favor introduzca uno diferente';
			} else
				$msg = str_replace($salto,'',validation_errors());
		} else 
			$msg = 'Por favor introduzca la información requerida';
		echo strtoupper($msg);
	}
	private function toUpper($value) {
		$value = utf8_decode($value);
		$value = strtoupper(strtr($value, "àáâãäåçèéêëìíîïñòóôõöùüú", "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÜÚ"));
		return utf8_encode($value);
	}
	public function validar_usuario() {
		$post = $this->input->post();
        $salto=array("\r","\n","\r\n","\n\r");
        $msg='';
        if($post) {
    		$this->load->library('form_validation');
	    	$this->form_validation->set_rules('usuario', 'Usuario', 'required|max_length[35]');
	    	$this->form_validation->set_rules('password', 'Contraseña', 'required|max_length[8]');

	    	if($this->form_validation->run() && $post){

	    		$post['usuario'] = $this->toUpper($post['usuario']);
	    		$sq=$this->sac_model->validar_login($post);

		        if($sq->num_rows()){
	                foreach($sq->result() as $ud);
		            $this->session->set_userdata('usuario',$ud->USW_USERNAME);
		            $this->session->set_userdata('cuenta',$ud->USCTAU);
		            $msg = '<script>window.top.location.href="'.base_url('sac/'.$post['goto']).'"</script>';
	            } else
	                $msg = '<span class="alert">Información de acceso no válida</span>';  
			} else
	            $msg = '<span class="alert">Usuario y contraseña requeridos</span>'; 
	    } else 
	    	$msg = '<span class="alert">Usuario y contraseña requeridos</span>';
	    echo $msg;
    }
    public function validar_cuenta() {
    	$post = $this->input->post();
        $salto=array("\r","\n","\r\n","\n\r");
        $msg='';
        if($post) {
    		$this->load->library('form_validation');
	    	$this->form_validation->set_rules('cuenta', 'Número de Cuenta', 'required|integer|max_length[7]');
	    	$this->form_validation->set_rules('clave', 'Clave', 'required');

	    	if($this->form_validation->run() && $post){
	    		$post['cuenta'] = $this->toUpper($post['cuenta']);
	    		$post['clave'] = $this->toUpper($post['clave']);
	    		$xml = ws(4, $post);
	    		if($xml->clavevalida=='S'&&$xml->mensaje=='') {
	    			$data = array('cuenta'=>$post['cuenta'],'clave'=>$post['clave']);
	    			$this->session->set_userdata($data); 
	    			$msg = '<script>window.top.location.href="'.base_url('sac/pagosinregistro').'"</script>';
	    		}
	    		elseif($xml->clavevalida=='N'&&$xml->mensaje!='')
	    		    $msg ='<span class="alert">'.$xml->mensaje.'</span>'; 
	    		else
	    			$msg = '<span class="alert">Ocurrión un error al momento de procesar la información.<br />Por favor inténtalo más tarde</span>'; 
	    	} else
	            $msg = '<span class="alert">Número de cuenta y clave requeridas</span>';  
	    } else
	    	$msg = '<span class="alert">Número de cuenta y clave requeridas</span>'; 
	    echo $msg;
    }
    public function chk_recuperacion() {
    	$post = $this->input->post();
    	if($post) 
    		if($this->sac_model->validar_email($post))
    			echo $this->sac_model->validar_recuperacion($post);
    		else
    			echo 'Al parecer no hay un correo electrónico asocidado al registro por favor comunícate con nosotros al teléfono 073 o mándanos un correo a <a href="mailto:atencionsitio@sapal.gob.mx">atencionsitio@sapal.gob.mx</a>';
    	else
    		echo 'Por favor introduzca al menos el usuario o el número de cuenta';
    }
    public function chk_respuesta() {
    	$post = $this->input->post();
    	if($post) {
    		$usuario = $this->sac_model->validar_respuesta($post);
    		if(count($usuario)>0) {
    			$send = array(
					'DIR' => base_url(),
					'NOMBRE' => $usuario->USW_NOMBRE.' '.$usuario->USW_APELLIDOS,
					'USUARIO' => $usuario->USW_USERNAME,
					'PSWD' => $usuario->USW_CONTRASENA
				);
				$msj = $this->parser->parse('sac/mail_pswd', $send, true);
				$this->load->library('email');
				$config['mailtype'] = 'html';
    			$this->email->initialize($config);
    			$this->email->from('activacionsac@sapal.gob.mx', 'Sapal');
                $this->email->to($usuario->USW_CORREOE);
                $this->email->subject('Recuperación de la contraseña al Sistema de Atención a Clientes (SAC)');
                $this->email->message($msj);
                $this->email->send();
                echo '<script>javascript:paso3();</script>Su contraseña se ha enviado a su correo electrónico dado de alta en el registro, cualquier duda o comentario de este correo por favor comunícate con nosotros al teléfono 073 o mándanos un correo a <a href="mailto:atencionsitio@sapal.gob.mx">atencionsitio@sapal.gob.mx</a><br /><br /><a href="'.base_url().'sac/login" class="dib btn">INICIAR SESIÓN</a>';
    		} else
    			echo 'La respuesta a tu pregunta es incorrecta por favor vuelva a intentarlo si el problema continua por favor comunícate con nosotros al teléfono 073 o mándanos un correo a <a href="mailto:atencionsitio@sapal.gob.mx">atencionsitio@sapal.gob.mx</a>'; 
    	} else
    		echo 'Por favor seleccione una pregunta y escriba la respuesta';
    }
    public function activacion($string='') {
    	$arr = explode('=', $this->utf8_urldecode($string));
    	$data['DIR'] = base_url();
    	$data['BANNERS'] = $this->site_model->getbanners('sac');
    	$data['SCRIPT'] = '';
		$data['SESION'] = '<a href="'.base_url().'sac/login" class="db">INICIAR SESIÓN</a><a href="" id="lnk-pagosin" class="db">PAGO SIN REGISTRO</a>';
    	$send = array(
    		'DIR' => base_url(),
    		'MSJ' => $this->sac_model->activacion($arr[0],$arr[1])
    	);
    	$data['SUBCONTENT'] = $this->parser->parse('sac/activacion', $send, true);
    	view_section('sac', 'sac', $data);
    }
    public function mail() {
    	$data['DIR'] = base_url();
    	$this->parser->parse('transparencia/mod/mail_info', $data);
    }
    private function utf8_urldecode($str) {
    	$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    	return html_entity_decode($str,null,'UTF-8');;
  	}
}