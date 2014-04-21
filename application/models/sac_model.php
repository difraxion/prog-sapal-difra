<?php

class Sac_model extends CI_Model {
	function get_name($cuenta, $usuario) {
		$query = $this->db->get_where('sac_usuarios', array('USCTAU'=>$cuenta, 'USW_USERNAME'=>$usuario), 1);
		$row = $query->row();
		return $this->vacio($row->USW_NOMBRE).' '.$this->vacio($row->USW_APELLIDOS);
	}
	function get_preguntas() {
		$preguntas = '';
		$query = $this->db->get('sac_preguntas');
		foreach ($query->result_array() as $pregunta) {
			$preguntas .= '<option value="'.$pregunta['PRE_ID'].'">'.$pregunta['PRE_DESCRIPCION'].'</option>';
		}
		return $preguntas;
	}
	function estatus($est) {
		switch ($est) {
			case 'A': return 'ALTA'; break;
			case 'B': return 'BAJA'; break;
			case 'S': return 'SUSPENDIDO'; break;
		}
	}
	function cortado($cor) {
		switch ($cor) {
			case 'N': return 'NO'; break;
			case 'S': return 'SI'; break;
		}
	}
	function mes($fecha) {
		if (strpos($fecha, 'ENERO') !== false) return '01';
		if (strpos($fecha, 'FEBRERO') !== false) return '02';
		if (strpos($fecha, 'MARZO') !== false) return '03';
		if (strpos($fecha, 'ABRIL') !== false) return '04';
		if (strpos($fecha, 'MAYO') !== false) return '05';
		if (strpos($fecha, 'JUNIO') !== false) return '06';
		if (strpos($fecha, 'JULIO') !== false) return '07';
		if (strpos($fecha, 'AGOSTO') !== false) return '08';
		if (strpos($fecha, 'SEPTIEMBRE') !== false) return '09';
		if (strpos($fecha, 'OCTUBRE') !== false) return '10';
		if (strpos($fecha, 'NOVIEMBRE') !== false) return '11';
		if (strpos($fecha, 'DICIEMBRE') !== false) return '12';
    }
    function insertar_usuario($data) {
        $this->db->query("DELETE FROM sac_usuarios WHERE USCTAU = ".$data['USCTAU']." AND USW_ESTATUS = 0");
        $this->db->query("INSERT INTO sac_usuarios 
            (USCTAU,USW_NOMBRE,USW_APELLIDOS,USW_DIRECCION,USW_DOMICILIO,USW_CONTRASENA,USW_CORREOE,USW_RESPUESTA,USW_ESTATUS,PRE_ID,USW_USERNAME) 
            VALUES (".$data['USCTAU'].",UPPER('".$data['USW_NOMBRE']."'),UPPER('".$data['USW_APELLIDOS']."'),UPPER('".$data['USW_DIRECCION']."'),UPPER('".$data['USW_DOMICILIO']."'),'".$data['USW_CONTRASENA']."','".$data['USW_CORREOE']."',UPPER('".$data['USW_RESPUESTA']."'),".$data['USW_ESTATUS'].",".$data['PRE_ID'].",UPPER('".$data['USW_USERNAME']."'))");
    }
    function validar_login($post) {
        return $this->db->query("SELECT * FROM sac_usuarios WHERE USW_USERNAME = '".$post['usuario']."' AND USW_CONTRASENA = '".$post['password']."' AND USW_ESTATUS > 0");
    }
    function validar_status($post) {
        $query = $this->db->query("SELECT * FROM sac_usuarios WHERE USW_USERNAME = '".$post['usuario']."' AND USW_CONTRASENA = '".$post['password']."' USW_ESTATUS > 0");
        return $query->num_rows();
    }
    function validar_usu_existente($usu='') {
    	$query = $this->db->query("SELECT * FROM sac_usuarios WHERE USW_USERNAME = '".$usu."'");
    	return $query->num_rows();
    }
    function validar_cuenta_existente($cuenta='') {
    	$query = $this->db->query("SELECT * FROM sac_usuarios WHERE USCTAU = '".$cuenta."' AND USW_ESTATUS > 0");
    	return $query->num_rows();
    }
    function activacion($usuario='',$cuenta='') {
    	if($usuario!=''&&$cuenta!='') {
    		$query = $this->db->query("SELECT * FROM sac_usuarios WHERE USW_USERNAME = '".$usuario."' AND USCTAU = ".$cuenta);
    		if($query->num_rows()>0) {
    			$row = $query->row();
    			if($row->USW_ESTATUS==0) {
    				$this->db->query("UPDATE sac_usuarios SET USW_ESTATUS = 1 WHERE USW_USERNAME = '".$usuario."' AND USCTAU = ".$cuenta);
    				return '<p>TU REGISTRO HA SIDO ACTIVADO, AHORA PUEDES HACER USO DE LOS SERVICIOS DEL SISTEMA DE ATENCIÓN A CLIENTES</p><p><a href="'.base_url().'sac/login" class="btn dib">INICIAR SESIÓN</a></p>';
    			}
    			else
    				return '<p>EL REGISTRO YA HA SIDO ACTIVADO</p><p><a href="'.base_url().'sac/login" class="btn dib">INICIAR SESIÓN</a>&nbsp;<a href="'.base_url().'sac/recuperarcontrasena" class="btn dib">RECUPERAR CONTRASEÑA</a></p>';
    		}
    		else
    			return '<p>NO EXISTE NINGÚN REGISTRO PARA ACTIVAR</p><p><a href="'.base_url().'sac/registrate" class="btn dib">REGÍSTRATE AQUÍ</a></p>';
    	}
    	else
    		return '<p>NO EXISTE NINGÚN REGISTRO PARA ACTIVAR</p><p><a href="'.base_url().'sac/registrate" class="btn dib">REGÍSTRATE AQUÍ</a></p>';
    }
    function validar_recuperacion($post) {
    	$where = "";
    	$str_qry = "SELECT * FROM sac_usuarios WHERE USW_ESTATUS > 0";
    	if($post['usuario']!='')
    		$where .= " AND USW_USERNAME = '".$post['usuario']."'";
    	if($post['nocuenta']!='')
    		$where .= " AND USCTAU = ".$post['nocuenta'];
    	$query = $this->db->query($str_qry.$where);
    	if($query->num_rows()==1)
    		return '<script>javascript:paso2();</script>';
    	else
    		return 'El usuario o el número de cuenta no existen por favor vuelva a intentarlo si el problema continua por favor comunícate con nosotros al teléfono 073 o mándanos un correo a <a href="mailto:atencionsitio@sapal.gob.mx">atencionsitio@sapal.gob.mx</a>';
    }
    function validar_respuesta($post) {
    	$where = "";
    	$str_qry = "SELECT * FROM sac_usuarios WHERE USW_ESTATUS > 0";
    	if($post['usuario']!='')
    		$where .= " AND USW_USERNAME = '".$post['usuario']."'";
    	if($post['nocuenta']!='')
    		$where .= " AND USCTAU = ".$post['nocuenta'];
    	if($post['pregunta']!=''&&$post['respuesta']!='') 
    		$where .= " AND PRE_ID = ".$post['pregunta']." AND USW_RESPUESTA = '".$post['respuesta']."'";
    	$query = $this->db->query($str_qry.$where);
    	if($query->num_rows()==1)
    		return $query->row();
    }
    function validar_email($post) {
    	$where = "";
    	$str_qry = "SELECT USW_CORREOE FROM sac_usuarios WHERE 1=1";
    	if($post['usuario']!='')
    		$where .= " AND USW_USERNAME = '".$post['usuario']."'";
    	if($post['nocuenta']!='')
    		$where .= " AND USCTAU = ".$post['nocuenta'];
    	$query = $this->db->query($str_qry.$where);
    	if($query->num_rows()==1)
    		return true;
    	else
    		return false;
    }
    function vacio($value='') {
        $search = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã‘,Ã¿");
        $replace = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ñ,Ñ");
        $value = str_replace($search, $replace, $value);
        return (isset($value)&&$value!=''?$value:'');
    }
}