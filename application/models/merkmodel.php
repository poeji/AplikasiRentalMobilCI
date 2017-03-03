<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merkmodel extends CI_Model {

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

	function GetMerk() {
        return $this->db->get('merk')->result();
    }

    function GetData($id) {
    	//return $this->db->where('idmerk', $id)->get('merk')->result_array();
    	return $this->db->get_where('merk', array('idmerk'=> $id))->row();
    }

	public function insert()
	{
		
		$merk = $this->input->post('merk');
		$merk_seo  = $this->fungsi->seo_title($merk);

		$input = array (
		    'namamerk' => $merk,
		    'namamerk_seo'  => $merk_seo
		);

		return $this->db->insert('merk', $input);
	}

	public function delete($param) {
		return $this->db->delete('merk', array('idmerk' => $param));
	}

}
