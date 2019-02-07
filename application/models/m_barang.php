<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function addBarang($nama_file)
	{
		if ($nama_file=="") {
			$object = array(
						'nama_barang' => $this->input->post('nama_barang'),
						'tahun' => $this->input->post('tahun'),
						'harga' => $this->input->post('harga'),
						'kode_kategori' => $this->input->post('kategori'),
						'merek' => $this->input->post('merek'),
						'stok' => $this->input->post('stok'));

		}else{
			$object = array(
						'nama_barang' => $this->input->post('nama_barang'),
						'tahun' => $this->input->post('tahun'),
						'harga' => $this->input->post('harga'),
						'kode_kategori' => $this->input->post('kategori'),
						'foto_cover' => $nama_file,
						'merek' => $this->input->post('merek'),
						'stok' => $this->input->post('stok'));
		}
		return $this->db->insert('barang', $object);
	}	

	public function getBarang()
	{
		return $this->db->join('kategori','kategori.kode_kategori=barang.kode_kategori')->get('barang')->result();
	}

	public function delBarang($a='')
	{
		return $this->db->where('kode_barang',$a)->delete('barang');
	}

	public function detBarang($a)
	{
		return $this->db->join('kategori','kategori.kode_kategori=barang.kode_kategori')->where('kode_barang', $a)->get('barang')->row();
	}

	public function updateGambar($nama_foto)
	{
		$object = array(
						'nama_barang' => $this->input->post('nama_barang'),
						'tahun' => $this->input->post('tahun'),
						'harga' => $this->input->post('harga'),
						'kode_kategori' => $this->input->post('kategori'),
						'foto_cover' => $nama_foto,
						'merek' => $this->input->post('merek'),
						'stok' => $this->input->post('stok'));

		return $this->db->where('kode_barang',$this->input->post('kodebarang'))->update('barang', $object);
	}

	public function updateNoGambar()
	{
		$object = array(
						'nama_barang' => $this->input->post('nama_barang'),
						'tahun' => $this->input->post('tahun'),
						'harga' => $this->input->post('harga'),
						'kode_kategori' => $this->input->post('kategori'),
						'merek' => $this->input->post('merek'),
						'stok' => $this->input->post('stok'));

		return $this->db->where('kode_barang',$this->input->post('kodebarang'))->update('barang', $object);
	}

	public function jmlBarang()
	{
		$this->db->select('COUNT(kode_barang) as jumlah');
		$this->db->from('barang');
		return $this->db->get()->row()->jumlah;
	}

}

/* End of file m_barang.php */
/* Location: ./application/models/m_barang.php */