<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

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

	function __construct(){
		parent::__construct();		
		$this->load->model('sitemodel');
		$this->load->model('loginmodel');

	}

	public function index()
	{
		if($this->session->userdata('status') == "login"){
			$data['mobil'] = $this->sitemodel->GetMobil();
			$data['content'] = "content";
			$this->load->view('template/template', $data);
		} else {
			$this->load->view('login');
		}
	}

	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->loginmodel->cek_login("user",$where)->num_rows();
		if($cek > 0){

			$data_session = array(
				'username' 	=> $username,
				'status'	=> 'login'
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("site"));

		}else{
			$this->session->set_flashdata('info', 'Username atau password salah! <br>Silahkan untuk dicoba kembali');
			redirect('site');
			//echo "Username dan password salah !";
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('site'));
	}
}
