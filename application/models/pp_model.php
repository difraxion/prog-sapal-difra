<?php

class Pp_model extends CI_Model {
	function get_contents($tagname) {
		$prev=$next='';
		$data['DIR'] = base_url();
		$this->db->limit(1);
		$query = $this->db->get_where('sap_proyectoprioritarios', array('tagname'=>$tagname));
		if($query->num_rows()>0) {
			$row = $query->row();
			$data['titulo'] = $row->titulo;
			$data['content'] = $row->contenedor;
			$qprev = $this->db->query("SELECT * FROM sap_proyectoprioritarios WHERE id_pp = (SELECT MAX(id_pp) FROM sap_proyectoprioritarios WHERE id_pp < ".$row->id_pp.");");
			$qnext = $this->db->query("SELECT * FROM sap_proyectoprioritarios WHERE id_pp = (SELECT MIN(id_pp) FROM sap_proyectoprioritarios WHERE id_pp > ".$row->id_pp.");");
			if($qprev->num_rows()>0) $prev = $qprev->row();
			if($qnext->num_rows()>0) $next = $qnext->row();
			$data['prev'] = ($prev==''?'':'<a href="'.base_url().'proyectosprioritarios/'.$prev->tagname.'" class="lc"><span>Anterior</span></a>');
			$data['next'] = ($next==''?'':'<a href="'.base_url().'proyectosprioritarios/'.$next->tagname.'" class="rc"><span>Siguiente</span></a>');
		}
		return $data;
	}
}