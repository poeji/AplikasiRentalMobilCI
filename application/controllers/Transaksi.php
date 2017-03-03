<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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
		$this->load->model('transaksimodel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	
		//$s = "";
		$data['transaksi'] = $this->transaksimodel->Gettransaksi();
		//$data['supir'] = $this->transaksimodel->GetSupirView($s);
		//$this->transaksimodel->GetSupirView($s);
		//$data['product'] = $this->product->get_product($product_id);

		//$data['clips'] = $this->clips->get_data($cue_sheets);
		// $data['product'] = $this->product->get_product($product_id);
		$data['content'] = "transaksi/view";
		$this->load->view('template/template', $data);
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
	}

	public function add()
	{

		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('namapelanggan', 'Field Nama Pelanggan', 'required');
				$this->form_validation->set_rules('noktp', 'Field No. KTP', 'required');
				$this->form_validation->set_rules('nohp', 'Field No. HP', 'required');
				$this->form_validation->set_rules('alamat', 'Field Alamat', 'required');
				$this->form_validation->set_rules('tglsewa', 'Field Tanggal Sewa', 'required');
				$this->form_validation->set_rules('idmobil', 'Field Mobil', 'required');
				$this->form_validation->set_rules('idsupir', 'Field Supir', 'required');

				if ($this->form_validation->run() == FALSE)
		                {
		                	//$data['transaksi'] = $this->transaksimodel->status();
		                    //return $this->fungsi->status();
		                    $data['mobil'] = $this->transaksimodel->getMobil();
							$data['supir'] = $this->transaksimodel->getSupir();
							$data['content'] = "transaksi/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {			
		                			
					                $insert 	= $this->transaksimodel->insert();
				                    if($insert) 
										{
											//cek id mobil
											$this->updatestmbl($this->input->post('idmobil'), 'jalan');
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('transaksi');
										}			                    
		                }

			} else {
				$data['mobil'] = $this->transaksimodel->getMobil();
				$data['supir'] = $this->transaksimodel->getSupir();
				$data['content'] = "transaksi/add";
				$this->load->view('template/template', $data);
			}

		
	
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{
				$id 		 	= $this->input->post('id');
				$namapelanggan 	= $this->input->post('namapelanggan');
				$noktp 			= $this->input->post('noktp');
				$nohp 			= $this->input->post('nohp');
				$alamat 		= $this->input->post('alamat');
				$tglsewa 		= $this->input->post('tglsewa');
				$tglkembali		= $this->input->post('tglkembali');
				$idmobil 		= $this->input->post('idmobil');
				$idsupir 		= $this->input->post('idsupir');
				$selisih 		= $this->input->post('selisih');
				$total 			= $this->input->post('total');
				$sttransaksi 	= $this->input->post('sttransaksi');
				$sekarang		= $this->fungsi->hariini();

				$field = array (
					'date' 			=> $sekarang,
					'namapelanggan' => $namapelanggan,
				    'noktp' 		=> $noktp,
				    'nohp'  		=> $nohp,
				    'alamat' 		=> $alamat,
				    'tglsewa'  		=> $tglsewa,
				    'idmobil'  		=> $idmobil,
				    'idsupir'  		=> $idsupir,
				    'tglkembali'  	=> $tglkembali,
				    'selisih'  		=> $selisih,
				    'total'  		=> $total,
				    'sttransaksi'  	=> $sttransaksi
				);

				$this->db->where('idtransaksi', $id);
				$this->db->update('transaksi', $field);

				if($tglkembali != NULL && $tglkembali != '0000-00-00') {
					$this->updatestatus($id);
				}

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('transaksi');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('transaksi');
				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->transaksimodel->GetData($id);
				$data['mobil'] = $this->transaksimodel->getMobil();
				$data['supir'] = $this->transaksimodel->getSupir();
				$data['content'] = "transaksi/edit";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->transaksimodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('transaksi');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('transaksi');
		}
	}

	public function updatestatus($id)
	{
		$this->transaksimodel->updatest($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil diupdate');
			redirect('transaksi');
		} else {
			$this->session->set_flashdata('info', 'Data gagal diupdate');
			redirect('transaksi');
		}
	}

	public function pdf($id) {

		$this->load->library('M_pdf');
		$this->load->library('fungsi');
		//load mPDF library

$next=$id;
#menhitung jumlah karakter
$idnya=strlen($id);
 
if($idnya==1)
{ $nol='0000'; }
elseif($idnya==2)
{ $nol='0000'; }
elseif($idnya==3)
{ $nol='000'; }
elseif($idnya=4)
{ $nol='00'; }
elseif($idnya=5)
{ $nol='0'; }
elseif($idnya=6)
{ $nol=''; }
#Pembuatan nim baru
$kode=$nol.$next;

$this->db->select('transaksi.`idtransaksi`, transaksi.`namapelanggan`, transaksi.`nohp`, transaksi.`noktp`, transaksi.`tglsewa`, transaksi.`tglkembali`, transaksi.`selisih`, transaksi.`idmobil`, transaksi.`idsupir`, 
mobil.`tarif` AS tarifmobil, supir.`tarif` AS tarifsupir, transaksi.`alamat`, mobil.type, supir.namasupir, transaksi.total');
		$this->db->from('transaksi');
		$this->db->join('mobil', 'mobil.idmobil = transaksi.idmobil', 'left');
		$this->db->join('supir', 'supir.idsupir = transaksi.idsupir', 'left');
		$this->db->where('idtransaksi', $id);
		$query = $this->db->get()->row();

		$id 			= $query->idtransaksi;
		$namapelanggan 	= $query->namapelanggan;
		$nohp 			= $query->nohp;
		$noktp 			= $query->noktp;
		$tglsewa 		= $query->tglsewa;
		$tglkembali 	= $query->tglkembali;
		$selisih 		= $query->selisih;
		$supir 			= $query->namasupir;
		$mobil 			= $query->type;
		$tarifmobil 	= $query->tarifmobil;
		$tarifsupir 	= $query->tarifsupir;
		$alamat 		= $query->alamat;
		$total 			= $query->total;

		if($supir != "") {
			$supirnya = $supir;
			$totalsupir = $tarifsupir * $selisih;
		} else {
			$supirnya = "Lepas Kunci";
			$totalsupir = 0;
		}

		$totalmobil = $tarifmobil * $selisih;


$this->data['html'] = '
<div class="content-wrapper" style="margin-left: 15px; margin-right: 15px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; align:center">
        Invoice #'.$kode.'
        </p>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <h3>Nama Pelanggan:</h3>
          <address>
            <b>'.$namapelanggan.'</b><br>
            '.$noktp.'<br>
            '.$alamat.'<br>
            '.$nohp.'<br>
          </address>
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Mobil</th>
              <th>Supir</th>
              <th>Tgl. Ambil</th>
              <th>Tgl. Kembali</th>
              <th>Jumlah Hari</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>'.$mobil.' ['.number_format($tarifmobil).']</td>
              <td>'.$supirnya.' ['.number_format($tarifsupir).']</td>
              <td>'.$this->fungsi->DateToIndo($tglsewa).'</td>
              <td>'.$this->fungsi->DateToIndo($tglkembali).'</td>
              <td>'.$selisih.'</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-5">
        <br>
          <p class="lead">Pembayaran Melalui:</p>
          <img src="assets/dist/img/credit/visa.png" alt="Visa">
          <img src="assets/dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="assets/dist/img/credit/american-express.png" alt="American Express">
          <img src="assets/dist/img/credit/paypal2.png" alt="Paypal">
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <br>
            <table class="table">
              <tr>
                <th>Biaya Sewa Mobil '.$selisih.' hari:</th>
                <td>'.number_format($totalmobil).'</td>
              </tr>
              <tr>
               <th>Biaya Jasa Supir '.$selisih.' hari:</th>
                <td>'.number_format($totalsupir).'</td>
              </tr>
              <tr>
                <th>Total:</th>
                <th>'.number_format($total).'</th>
              </tr>
            </table>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
';
//$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__ . '/../../..';
//require_once $path . '/vendor/autoload.php';
//$mpdf = new \Mpdf\Mpdf(['mode' => 'c']);
//$mpdf->WriteHTML($html);
//$mpdf->Output();
		 //now pass the data //
 
		
		$html=$this->load->view('pdf/vpdf',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		$pdfFilePath ="invoice-".$kode."-".$this->fungsi->seo_title($namapelanggan).".pdf";
 
		
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!

		$stylesheet = file_get_contents(base_url().'assets/bootstrap/css/bootstrap.min.css');
		$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");

	}

	//update status mobil menjadi 
	public function updatestmbl($id, $st) {
		$field = array (
							'stmobil'	=> $st
						);

		$this->db->where('idmobil', $id);
		$this->db->update('mobil', $field);
		return $this->db->affected_rows();
	}

}
