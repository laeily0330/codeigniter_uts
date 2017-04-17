<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function index()
	{
		$this->load->model('barang_model');
		$data["barang_list"] = $this->barang_model->getDataBarang();
		$this->load->view('barang_view', $data);
	}

	public function indexId($idKategori)
	{
		$this->load->model('barang_model');		
		$data["barang_list"] = $this->barang_model->getBarangbyKategori($idKategori);
		$this->load->view('barangbykat', $data);
	}

	public function delete($id)
	{
		$this->load->model('barang_model');
		$this->barang_model->deleteBarang($id);
		$data["barang_list"] = $this->barang_model->getDataBarang();	
		$this->load->view('barang_view', $data);
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim');
		$this->load->model('barang_model');
		$data["kategori_list"] = $this->barang_model->getDataKategori();
		//$this->load->view('barang_create_view', $data);
		if($this->form_validation->run()==FALSE){

			$this->load->view('barang_create_view',$data);

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('barang_create_view', $error);
			}
			else{
				$this->barang_model->insertBarang();
				$data["barang_list"] = $this->barang_model->getDataBarang();	
				$this->load->view('barang_view', $data);
			}
		}
	}

	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('barang_model');
		$data["kategori_list"] = $this->barang_model->getDataKategori();
		$data["barang"] = $this->barang_model->getBarangi($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('barang_edit_view',$data);

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
				//$this->load->view('barang_edit_view', $error);
			}
			else{
				$this->barang_model->updateBarang($id);
			$data["barang_list"] = $this->barang_model->getDataBarang();	
			$this->load->view('barang_view', $data);
			}
			
			//$this->load->view('edit_pegawai_sukses');

		}
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
?>