<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_zulladmin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_zulladmin');
	}


	public function index()
	{
		$data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
		$pengaduan = $this->db->get('pengaduan')->num_rows();
		$proses = $this->db->get_where('pengaduan', ['status' => 'proses'])->num_rows();
		$selesai = $this->db->get_where('pengaduan', ['status' => 'selesai'])->num_rows();

		$data = array(
			'pengaduan' => $pengaduan,
			'proses' => $proses,
			'selesai' => $selesai
		);

		$data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('template/V_zullheader');
		$this->load->view('template/V_zullsidebar', $data);
		$this->load->view('template/V_zulltopbar',  $data);
		$this->load->view('admin/V_zulldashboard', $data);
		$this->load->view('template/V_zullfooter');
	}


	public function kategori()
	{
		$data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->model('M_zulladmin');

		$data['kategori'] = $this->M_zulladmin->kategori()->result_array();
		// $data['kategori'] = $this->db->get('kategori');

		$data['subkategori'] = $this->M_zulladmin->subkategori()->result_array();

		$this->load->view('template/V_zullheader');
		$this->load->view('template/V_zullsidebar', $data);
		$this->load->view('template/V_zulltopbar', $data);
		$this->load->view('admin/V_zullkategori', $data);
		$this->load->view('template/V_zullfooter');
	}

	public function tambah_kategori()
	{
		$data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();

		$kategori = $this->input->post('kategori');

		$add = array(
			'kategori' => $kategori,
		);

		$this->load->model('M_zulladmin');
		$this->M_zulladmin->tambah_kategori($add);
		redirect('C_zulladmin/kategori');
	}


	// editkategori
	public function editkategori($id)
	{
		$data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();

		$kategori = $this->input->post('kategori');

		$update = array(
			'kategori' => $kategori,
		);

		$this->db->where('id', $id);
		$this->db->update('kategori', $update);

		redirect('C_zulladmin/kategori');
	}


	// deletekategori
	public function deletekategori($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kategori');
		redirect('C_zulladmin/kategori');
	}



	public function tambah_subkategori()
	{
		$kategori = $this->input->post('kategori');
		$sub_kategori = $this->input->post('subkategori');
		$data = array(

			'id_kategori' => $kategori,
			'subkategori' => $sub_kategori,
		);
		// $this->M_zulladmin->subkategori();
		$this->db->insert('subkategori', $data);
		redirect('C_zulladmin/kategori');
	}


	// editsubkategori
	public function editsubkategori($id)
	{
		$data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();

		$subkategori = $this->input->post('subkategori');

		$update = array(
			'subkategori' => $subkategori,
		);

		$this->db->where('id_subkategori', $id);
		$this->db->update('subkategori', $update);

		redirect('C_zulladmin/kategori');
	}


	// deletesubkategori
	public function deletesubkategori($id)
	{
		$this->db->where('id_subkategori', $id);
		$this->db->delete('subkategori');
		redirect('C_zulladmin/kategori');
	}


	public function masyarakat()
	{
		$data['user'] = $this->M_zulladmin->userData($this->session->userData('username'))->row_array();
		$data['masyarakat'] = $this->M_zulladmin->masyarakat()->result_array();



		$this->load->view('template/V_zullheader');
		$this->load->view('template/V_zullsidebar', $data);
		$this->load->view('template/V_zulltopbar', $data);
		$this->load->view('admin/V_zullmasyarakat', $data);
		$this->load->view('template/V_zullfooter');
	}


	public function suspendmasyarakat($id)
	{
		$suspendmasyarakat = [
			'active' => 'suspend',
		];

		$this->db->where('id', $id);
		$this->M_zulladmin->suspendmasyarakat($suspendmasyarakat);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Berhasil Mengsuspend akun ! 
		</div>');
		redirect('C_zulladmin/masyarakat');
	}


	public function unsuspendmasyarakat($id)
	{		
		$unsuspendmasyarakat = [
			'active' => 'active',
		];

		$this->db->where('id', $id);
		$this->M_zulladmin->unsuspendmasyarakat($unsuspendmasyarakat);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Berhasil Mengunsuspend akun ! 
		</div>');
		redirect('C_zulladmin/masyarakat');
	}


	public function petugas()
	{
		$data['user'] = $this->M_zulladmin->userData($this->session->userData('username'))->row_array();
		$data['petugas'] = $this->M_zulladmin->petugas()->result_array();



		$this->load->view('template/V_zullheader');
		$this->load->view('template/V_zullsidebar', $data);
		$this->load->view('template/V_zulltopbar', $data);
		$this->load->view('admin/V_zullpetugas', $data);
		$this->load->view('template/V_zullfooter');
	}


	public function editpetugas($id)
	{
		$nama_petugas = $this->input->post('nama_petugas');
		$username = $this->input->post('username');
		$telp = $this->input->post('telepon');
		$level = $this->input->post('level');


		$update = [
			'nama_petugas' => $nama_petugas,
			'username' => $username,
			'telpon' => $telpon,
			'level' => $level,
		];

		$this->db->where('id_petugas', $id);
		$this->M_zulladmin->editpetugas($update);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Berhasil Mengganti Data Petugas ! 
		</div>');
		redirect('C_zulladmin/petugas');
	}


	public function suspendpetugas($id)
	{
		$suspend = [
			'active' => 'suspend',
		];

		$this->db->where('id_petugas', $id);
		$this->M_zulladmin->suspendpetugas($suspend);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Berhasil Mengsuspend akun ! 
		</div>');
		redirect('C_zulladmin/petugas');
	}


	public function unsuspendpetugas($id)
	{
		$unsuspend = [
			'active' => 'active',
		];

		$this->db->where('id_petugas', $id);
		$this->M_zulladmin->unsuspendpetugas($unsuspend);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Berhasil Mengunsuspend akun ! 
		</div>');
		redirect('C_zulladmin/petugas');
	}


	public function pengadu()
	{
		$data['user'] = $this->M_zulladmin->userData($this->session->userData('username'))->row_array();
		$data['masyarakat'] = $this->M_zulladmin->masyarakat()->result_array();
		$data['pengaduan'] = $this->M_zulladmin->pengaduan()->result_array();

		$this->load->view('template/V_zullheader');
		$this->load->view('template/V_zullsidebar', $data);
		$this->load->view('template/V_zulltopbar', $data);
		$this->load->view('admin/V_zullpengaduan', $data);
		$this->load->view('template/V_zullfooter');
	}


	public function upload_pengaduan($id_pengaduan)
	{

		$data_petugas = $this->M_zulladmin->userData($this->session->userData('username'))->row_array();
		$upload_data = array(
			'id_pengaduan' => $id_pengaduan,
			'tgl_tanggapan' => date('Y-m-d'),
			'tanggapan' => $this->input->post('tanggapan'),
			'id_petugas' => $data_petugas['id_petugas'],
		);
		$this->db->insert('tanggapan', $upload_data);
		$update = array(
			'status' => $this->input->post('status'),
		);
		$this->db->where('id_pengaduan', $id_pengaduan);
		$this->db->update('pengaduan', $update);
		redirect('C_zulladmin/pengadu');
	}


	public function statusproses($id)
	{
		$data['user'] = $this->M_zulladmin->userData($this->session->userData('username'))->row_array();
		$data['masyarakat'] = $this->M_zulladmin->masyarakat()->result_array();
		$data['p'] = $this->M_zulladmin->detail_pengaduan($id)->row_array();
		$data['petugas'] = $this->M_zulladmin->petugas()->result_array();
		$data['tanggapanproses'] = $this->M_zulladmin->tanggapanproses($id)->result_array();

		$this->load->view('template/V_zullheader');
		$this->load->view('template/V_zullsidebar', $data);
		$this->load->view('template/V_zulltopbar', $data);
		$this->load->view('admin/V_zullproses', $data);
		$this->load->view('template/V_zullfooter');
	}



	public function laporan_pdf()
	{
		$data['user'] = $this->M_zulladmin->userData($this->session->userData('username'))->row_array();
		$data['masyarakat'] = $this->M_zulladmin->masyarakat()->result_array();
		$data['petugas'] = $this->M_zulladmin->petugas()->result_array();
		$pengaduan = $this->M_zulladmin->pengaduan()->result_array();

		$data = array(
			"dataku" => array(
				"nama" => "Petani Kode",
				"url" => "http://petanikode.com"
			),
			'pengaduan'=>$pengaduan,
		);

		$this->load->library('Pdf');
		$data['title'] = 'Laporan Pengaduan';
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = "laporan-petanikode.pdf";
		$this->pdf->load_view('admin/laporan_pdf', $data);
	}


	public function update_status_selesai($id_pengaduan){
		$update=[
			'status'=>'selesai'
		];
		$this->db->where('id_pengaduan',$id_pengaduan);
		$this->db->update('pengaduan',$update);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Berhasil Menyelesaikan laporan ! ');
		redirect('C_zulladmin/pengadu/'.$id_pengaduan);
	}
}
?>