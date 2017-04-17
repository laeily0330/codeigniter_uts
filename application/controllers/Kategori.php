<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index($id)
	{
		$this->load->model('barang_model');
		$data["kategori_list"] = $this->barang_model->getKategorii($id);
		$this->load->view('kategori_view',$data);	
	}

	public function lihat()
	{
		$this->load->model('barang_model');
		$data["kategori_list"] = $this->barang_model->getDataKategori();
		$this->load->view('kategori_view',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('barang_model');
		if($this->form_validation->run()==FALSE){
			$this->load->view('kategori_create_view');
		}else{
			$this->barang_model->insertKategori();
			$data["kategori_list"] = $this->barang_model->getDataKategori();	
			$this->load->view('kategori_view', $data);
		}
	}

	public function update($id)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('barang_model');
		$data['kategori']=$this->barang_model->getKategori($id);
		if($this->form_validation->run()==FALSE){
			$this->load->view('kategori_edit_view',$data);
		}else{
			$this->barang_model->updateById($id);
			$data["kategori_list"] = $this->barang_model->getDataKategori();	
			$this->load->view('kategori_view', $data);
		}
	}
	public function delete($id)
	{
		$this->load->model('barang_model');
		$this->barang_model->deleteKategori($id);
		$data["kategori_list"] = $this->barang_model->getDataKategori();	
		$this->load->view('kategori_view', $data);
	}
}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */
?>