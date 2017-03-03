<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {

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

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('merkmodel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	
		$data['merk'] = $this->merkmodel->GetMerk();
		$data['content'] = "merk/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('merk', 'Field of Merk Mobil', 'required');
				if ($this->form_validation->run() == FALSE)
		                {
		                    $data['content'] = "merk/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {
			                    $insert = $this->merkmodel->insert();
			                    if($insert) 
									{
										$this->session->set_flashdata('info', 'Data berhasil disimpan');
										redirect('merk');
									} 
		                }

			} else {
				$data['content'] = "merk/add";
				$this->load->view('template/template', $data);
			}

		
	}

	public function edit($id)
	{	
		if($this->input->post('submit')) 
			{
				$id = $this->input->post('id');
				$merk = $this->input->post('merk');
				$merk_seo  = $this->fungsi->seo_title($merk);

				$field = array (
				    'namamerk' => $merk,
				    'namamerk_seo'  => $merk_seo
				);

				$this->db->where('idmerk', $id);
				$this->db->update('merk', $field);

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('merk');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('merk');
				}

			} else {
				$data['edit'] = $this->merkmodel->GetData($id);
				$data['content'] = "merk/edit";
				$this->load->view('template/template', $data);
			}
	}

	public function hapus($id)
	{
		$this->merkmodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('merk');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('merk');
		}
	}

}
