<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supirmodel extends CI_Model {

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

	function Getsupir() {
        return $this->db->get('supir')->result();
    }

    function GetData($id) {
    	//return $this->db->where('idmerk', $id)->get('merk')->result_array();
    	//echo "ID:".$id;
    	//$id = $this->uri->segment(3);
    	$id = $this->uri->segment(3);
    	return $this->db->get_where('supir', array('idsupir'=> $id))->row();
    }

 	public function insert()
	{
		
		$namasupir 	= $this->input->post('namasupir');
		$tgllahir 	= $this->input->post('tgllahir');
		$alamat 	= $this->input->post('alamat');
		$noktp 		= $this->input->post('noktp');
		$foto 		= $this->input->post('foto');
		
		$sekarang	= $this->fungsi->hariini();

		$image_info = $this->upload->data();
		$file_name 	= $image_info['file_name'];

		$input = array (
			'date' 			=> $sekarang,
			'tgllahir' 		=> $tgllahir,
		    'namasupir' 	=> $namasupir,
		    'alamat'  		=> $alamat,
		    'noktp' 		=> $noktp,
		    'foto'  		=> $file_name
		);

		return $this->db->insert('supir', $input);
	}

	public function delete($param) {
		return $this->db->delete('supir', array('idsupir' => $param));
	}

}
