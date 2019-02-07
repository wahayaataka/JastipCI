<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategori','kat');
	}

	public function index()
	{
		if ($this->session->userdata('login')!=TRUE) {		
			redirect('akun','refresh');
		}
		elseif ($this->session->userdata('level')!="admin") {
			redirect('akun','refresh');
		}
		$data['tampil'] = $this->kat->getKat();
		$data['content'] = "kategori";
		$this->load->view('template',$data);
	}

	public function add()
	{
		if ($this->input->post('submit')) {
			if ($this->kat->addKat()) {
				$this->session->set_flashdata('pesan', 'Data Kategori Berhasil Ditambah');
				redirect('kategori','refresh');
			}
			else{
				$this->session->set_flashdata('pesan', 'Data Kategori Gagal Ditambah');
				redirect('kategori','refresh');
			}
		}
	}

	public function detail($a)
	{
		$data = $this->kat->detKat($a);
		echo json_encode($data);
	}

	public function update()
	{
		if ($this->input->post('submit')) {
			if ($this->kat->ubahKat()) {
				$this->session->set_flashdata('pesan', 'Data Kategori Berhasil Diubah');
				redirect('kategori','refresh');
			}
			else{
				$this->session->set_flashdata('pesan', 'Data Kategori Gagal Diubah');
				redirect('kategori','refresh');
			}
		}
	}

	public function delete($a='')
	{
		if ($this->kat->delKat($a)) {
			$this->session->set_flashdata('pesan', 'Data Kategori Berhasil Dihapus');
			redirect('kategori','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Data Kategori Gagal Dihapus');
			redirect('kategori','refresh');
		}
	}

}

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */