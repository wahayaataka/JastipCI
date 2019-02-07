<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

	public function addKat()
	{
		$this->form_validation->set_rules('kode', 'kode_kategori', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama_kategori', 'trim|required');
		$object = array(
					'kode_kategori' => $this->input->post('kode'),
					'nama_kategori' => $this->input->post('nama'));
		return $this->db->insert('kategori', $object);
	}

	public function getKat()
	{
		return $this->db->get('kategori')->result();
	}

	public function detKat($a)
	{
		return $this->db->where('kode_kategori', $a)->get('kategori')->row();
	}

	public function ubahKat()
	{
		$this->form_validation->set_rules('kode', 'kode_kategori', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama_kategori', 'trim|required');
		$object = array(
					'kode_kategori' => $this->input->post('kode'),
					'nama_kategori' => $this->input->post('nama'));
		return $this->db->where('kode_kategori',$this->input->post('kodeLama'))->update('kategori', $object);
	}

	public function delKat($a='')
	{
		return $this->db->where('kode_kategori',$a)->delete('kategori');
	}
	

}

/* End of file m_kategori.php */
/* Location: ./application/models/m_kategori.php */