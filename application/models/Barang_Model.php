<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_Model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function getDataKategori()
	{
		$this->db->select("id,nama");
		$query = $this->db->get('kategori');
		return $query->result();
	}

	public function insertKategori()
	{
		$object = array(
			'nama' => $this->input->post('nama'), 
		);
		$this->db->insert('kategori', $object);
	}

	public function getKategori($id)
	{
		$this->db->where('id', $id);	
		$query = $this->db->get('kategori',1);
		return $query->result();
	}

	public function updateById($id)
	{
		$data = array('nama' => $this->input->post('nama'));
		$this->db->where('id', $id);
		$this->db->update('kategori', $data);
	}

	public function deleteKategori($id)
	{
		$this->db->delete('kategori', array('id' => $id));
	}

	public function getDataBarang()
	{
		$this->db->select("id,nama as namabarang,kode,DATE_FORMAT(tanggal_beli,'%d-%m-%Y') as tanggal_beli, foto, fk_kategori");
		$query = $this->db->get('barang');
		return $query->result();
	}

	public function getBarangbyKategori($idKategori)
	{
		$this->db->select("kategori.id as idKategori, kategori.nama as nama, barang.id as idbarang, barang.nama as namabarang, barang.kode, barang.tanggal_beli, barang.foto");
		$this->db->where('fk_kategori', $idKategori);	
		$this->db->join('kategori', 'barang.fk_kategori = kategori.id', 'right');	
		$query = $this->db->get('barang');
		return $query->result();
	}

	public function getKategorii($id)
	{
		$this->db->where('id', $id);
		$query=$this->db->get('kategori');
		return $query->result();
	}

	public function deleteBarang($id)
	{
		$this->db->delete('barang', array('id' => $id));
	}

	public function insertBarang()
	{
		$object = array(
			'nama' => $this->input->post('namabarang'), 
			'kode'=>$this->input->post('kode'), 
			'tanggal_beli'=>$this->input->post('tanggal_beli'), 
			'foto' => $this->upload->data('file_name'),
			'fk_kategori'=>$this->input->post('kategori')
			
		);
		$this->db->insert('barang', $object);
	}	

	public function getBarangi($id)
	{
		$this->db->where('id', $id);	
		$query = $this->db->get('barang',1);
		return $query->result();
	}

	public function updateBarang($id)
	{
		$data = array('nama' => $this->input->post('nama'), 
			'kode' => $this->input->post('kode'),
			'tanggal_beli' => $this->input->post('tanggal_beli'),
			'foto' => $this->upload->data('file_name'),
			'fk_kategori'=>$this->input->post('kategori'));
		$this->db->where('id', $id);
		$this->db->update('barang', $data);
	}
}

/* End of file Barang_Model.php */
/* Location: ./application/models/Barang_Model.php */
?>