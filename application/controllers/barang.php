<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategori','kat');
		$this->load->model('m_barang','barang');
	}

	public function index()
	{
		if ($this->session->userdata('login')!=TRUE) {		
			redirect('akun','refresh');
		}
		elseif ($this->session->userdata('level')!="admin") {
			redirect('akun','refresh');
		}
		$data['barang'] = $this->barang->getBarang();
		$data['kategori'] = $this->kat->getKat();
		$data['content'] = "barang";
		$this->load->view('template',$data);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_barang', 'barang', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kode_kategori', 'trim|required');
		$this->form_validation->set_rules('merek', 'merek', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '5000';
			$config['max_width']  = '3000';
			$config['max_height']  = '3000';
			
			if ($_FILES['gambar']['name']!="") {
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('gambar')){
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
				}
				else{
					if ($this->barang->addBarang($this->upload->data('file_name'))) {
						$this->session->set_flashdata('pesan', 'Data Barang Berhasil Ditambahkan');
					}
					else{
						$this->session->set_flashdata('pesan', 'Data Barang Gagal Ditambahkan');
					}
					redirect('barang','refresh');
				}
			}
			else{
				if ($this->barang->addBarang('')) {
					$this->session->set_flashdata('pesan', 'Data Barang Berhasil Ditambahkan');
				}
				else{
					$this->session->set_flashdata('pesan', 'Data Barang Gagal Ditambahkan');
				}
				redirect('barang','refresh');
			}
		} else {
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('barang','refresh');
		}

	}

	public function detail($a)
	{
		$data = $this->barang->detBarang($a);
		echo json_encode($data);
	}

	public function update()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
			$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
			$this->form_validation->set_rules('harga', 'harga', 'trim|required');
			$this->form_validation->set_rules('kategori', 'kode_kategori', 'trim|required');
			$this->form_validation->set_rules('merek', 'merek', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if ($_FILES['gambar']['name']=="") {
					if ($this->barang->updateNoGambar()) {
						$this->session->set_flashdata('pesan', 'Data Barang Berhasil Diperbarui');
					}else{
						$this->session->set_flashdata('pesan', 'Data Barang Gagal Diperbarui');
					}
					redirect('barang','refresh');
				}else{
					$config['upload_path'] = './assets/upload/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']  = '5000';
					$config['max_width']  = '3000';
					$config['max_height']  = '3000';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('gambar')){
						$this->session->set_flashdata('pesan', $this->upload->display_errors());
					}
					else{
						if ($this->barang->updateGambar($this->upload->data('file_name'))) {
							$this->session->set_flashdata('pesan', 'Data Barang Berhasil Diperbarui');
						}
						else{
							$this->session->set_flashdata('pesan', 'Data Barang Gagal Diperbarui');
						}
						redirect('barang','refresh');
					}

				}
			} else {
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('barang','refresh');
			}
			
		}
	}

	public function delete($a='')
	{
		if ($this->barang->delBarang($a)) {
			$this->session->set_flashdata('pesan', 'Data Barang Berhasil Dihapus');
			redirect('barang','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Data Barang Gagal Dihapus');
			redirect('barang','refresh');
		}
	}

}

/* End of file barang.php */
/* Location: ./application/controllers/barang.php */