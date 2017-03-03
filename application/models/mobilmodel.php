<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobilmodel extends CI_Model {

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

	function GetMobil() {
        //$this->db->get('mobil');
        //return $this->db->order_by('type','ASC')->result();
        $this->db->from("mobil");
		$this->db->order_by("type", "ASC");
		$query = $this->db->get(); 
		return $query->result();
    }

    function GetData($id) {
    	//return $this->db->where('idmerk', $id)->get('merk')->result_array();
    	//echo "ID:".$id;
    	//$id = $this->uri->segment(3);
    	$id = $this->uri->segment(3);
    	return $this->db->get_where('mobil', array('idmobil'=> $id))->row();
    }

    public function getMerk(){
  		//return $this->db->from("merk")->order_by('namamerk', 'ASC')->result();

  		$this->db->from("merk");
		$this->db->order_by("namamerk", "ASC");
		$query = $this->db->get(); 
		return $query->result();

 	}

 	public function insert()
	{
		
		$type 		= $this->input->post('type');
		$idmerk 	= $this->input->post('idmerk');
		$tahun 		= $this->input->post('tahun');
		$plat 		= $this->input->post('plat');
		$kursi 		= $this->input->post('kursi');
		$tarif 		= $this->input->post('tarif');
		$lembur 	= $this->input->post('lembur');
		$rangka 	= $this->input->post('rangka');
		$foto 		= $this->input->post('foto');
		
		$sekarang	= $this->fungsi->hariini();

		$image_info = $this->upload->data();
		$file_name 	= $image_info['file_name'];

		$input = array (
			'date' 			=> $sekarang,
		    'type' 			=> $type,
		    'idmerk'  		=> $idmerk,
		    'tahunproduksi' => $tahun,
		    'platnomer'  	=> $plat,
		    'kursi'  		=> $kursi,
		    'tarif'  		=> $tarif,
		    'lembur'  		=> $lembur,
		    'norangka'  	=> $rangka,
		    'foto'  		=> $file_name
		);

		return $this->db->insert('mobil', $input);
	}

	public function delete($param) {
		return $this->db->delete('mobil', array('idmobil' => $param));
	}

}
