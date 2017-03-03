<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemodel extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this->load->library('fungsi');
	}

 	public function getMobil(){
  		$this->db->from("mobil");
		$this->db->order_by("type", "ASC");
		$query = $this->db->get(); 
		return $query->result();
 	}


 	public function getSupir(){
  		$this->db->from("supir");
		$this->db->order_by("namasupir", "ASC");
		$query = $this->db->get(); 
		return $query->result();
 	}

 	

	

	


}
