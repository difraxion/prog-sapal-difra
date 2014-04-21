<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dead extends CI_Controller {
	public function __construct()
	{
		parent:: __construct ();
	}

	public function index()
	{
		$data['DIR'] = base_url();
		$data['TITLE']= "404 Page Not Found";
		$this->parser->parse('404', $data);
	}	
}

