<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends CI_Controller {

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
		$this->load->model('supirmodel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	
		$data['supir'] = $this->supirmodel->Getsupir();
		$data['content'] = "supir/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{

		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('namasupir', 'Field of Type supir', 'required');
				$this->form_validation->set_rules('tgllahir', 'Field of Merk supir', 'required');
				$this->form_validation->set_rules('alamat', 'Field of Tahun supir', 'required');
				$this->form_validation->set_rules('noktp', 'Field of No. Plat supir', 'required');
				//$this->form_validation->set_rules('foto', 'Field of Foto supir', 'required');

				if ($this->form_validation->run() == FALSE)
		                {
		                	$data['supir'] = $this->supirmodel->status();
		                    return $this->fungsi->status();
							$data['content'] = "supir/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {
			                    $config['upload_path']          = './img/';
				                $config['allowed_types']        = 'gif|jpg|png';
				                //$config['max_size']             = 100;
				                //$config['max_width']            = 1024;
				                //$config['max_height']           = 768;
				                $this->load->library('upload', $config);

				                if (!$this->upload->do_upload('foto')) {
					                // jika validasi file gagal, kirim parameter error ke index
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
					                // jika berhasil upload ambil data dan masukkan ke database
					                $upload_data = $this->upload->data();
					 				$file_name 	=   $upload_data['file_name'];
					 				
					                $insert = $this->supirmodel->insert();
				                    if($insert) 
										{
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('supir');
										} else {
											$this->session->set_flashdata('info', 'Data gagal disimpan');
											redirect('supir');
										}
					            }
			                    
		                }

			} else {
				$data['content'] = "supir/add";
				$this->load->view('template/template', $data);
			}

		
	
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{
				//var_dump($this->input->post());
				$id 		= $this->input->post('id');
				$namasupir 	= $this->input->post('namasupir');
				$tgllahir 	= $this->input->post('tgllahir');
				$alamat 	= $this->input->post('alamat');
				$noktp 		= $this->input->post('noktp');

						$field = array (
							'tgllahir' 		=> $tgllahir,
						    'namasupir' 	=> $namasupir,
						    'alamat'  		=> $alamat,
						    'noktp' 		=> $noktp
						);

				$this->db->where('idsupir', $id);
				$this->db->update('supir', $field);

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('supir');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('supir');
				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->supirmodel->GetData($id);
				$data['content'] = "supir/edit";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->supirmodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('supir');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('supir');
		}
	}

}
