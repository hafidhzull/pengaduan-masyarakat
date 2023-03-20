<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_zulluser extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_zulladmin');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $u = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();


        $proses = $this->db->get_where('pengaduan', ['status' => 'proses', 'nik' => $u['nik']])->num_rows();
        $pengaduan = $this->db->get_where('pengaduan', ['nik' => $u['nik']])->num_rows();
        $selesai = $this->db->get_where('pengaduan', ['status' => 'selesai', 'nik' => $u['nik']])->num_rows();
        $data['bar_graph'] = array(
            'proses' => $proses,
            'pengaduan' => $pengaduan,
            'selesai' => $selesai,
        );

        $this->load->view('template/V_zullheader');
        $this->load->view('template/V_zullsidebaruser');
        $this->load->view('template/V_zulltopbaruser', $data);
        $this->load->view('user/V_zulldashboard', $data);
        $this->load->view('template/V_zullfooteruser');
    }


    public function pengaduan()
    {
        $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengaduan'] = $this->M_zulluser->pengaduan()->result_array();

        $this->load->view('template/V_zullheader');
        $this->load->view('template/V_zullsidebaruser');
        $this->load->view('template/V_zulltopbaruser', $data);
        $this->load->view('user/V_zullpengaduan', $data);
        $this->load->view('template/V_zullfooteruser');
    }


    public function mengadu()
    {
        $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();


        $this->load->model('M_zulladmin');

        $data['subkategori'] = $this->M_zulladmin->subkategori()->result_array();

        $data['kategori'] = $this->M_zulladmin->kategori()->result_array();

        $this->load->view('template/V_zullheader');
        $this->load->view('template/V_zullsidebaruser');
        $this->load->view('template/V_zulltopbaruser', $data);
        $this->load->view('user/V_zullmengadu');
        $this->load->view('template/V_zullfooteruser');
    }

    public function insertpengaduan()
    {
        $this->load->model('M_zulladmin');

        $data = [
            'nik' => $this->session->userdata('nik'),
            'id_subkategori' => $this->input->post('subkategori'),
            'tgl_pengaduan' => date('Y-m-d'),
            'isi_laporan' => $this->input->post('isi'),
            'foto' => $this->input->post('foto'),
            'status' => 0
        ];

        $this->M_zulluser->insertpengaduan($data);
        $this->session->set_flashdata('pengaduan', '<div class="alert alert-success" role="alert"> Berhasil ditambahkan! </div>');
        redirect('C_zulluser/pengaduan');
    }

    public function get_sub_kategori()
    {
        $id_kategori = $this->input->post('id');
        $sub_kategori = $this->db->get_where('subkategori', ['id_kategori' => $id_kategori])->result();
        echo json_encode($sub_kategori);
    }



    public function tambahmengadu()
    {
        $user = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $kategori = $this->input->post('kategori');
        $subkategori = $this->input->post('subkategori');
        $laporan = $this->input->post('laporan');


        $config['upload_path'] = './assets/img/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $this->upload->do_upload('image');
        $uploaded_data = $this->upload->data('file_name');

        echo $uploaded_data;
        $add = array(
            'nik' => $user['nik'],
            'kategori' => $kategori,
            'subkategori' => $subkategori,
            'tgl_pengaduan' => date('Y-m-d'),
            'isi_laporan' => $laporan,
            'foto' => $uploaded_data,
        );

        $this->M_zulluser->insertpengaduan($add);
        $this->session->set_flashdata('pengaduan', '<div class="alert alert-success" role="alert"> Berhasil ditambahkan! </div>');
        redirect('C_zulluser/pengaduan');
    }


    public function profile()
    {
        $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();


        $this->load->view('template/V_zullheader');
        $this->load->view('template/V_zullsidebaruser');
        $this->load->view('template/V_zulltopbaruser', $data);
        $this->load->view('user/V_zullseting');
        $this->load->view('template/V_zullfooteruser');
    }


    public function editprofile()
    {
        $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $user = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $telpon = $this->input->post('telpon');
        $nik = $this->input->post('nik');

        $update = [
            'nama' => $nama,
            'username' => $username,
            'telpon' => $telpon,
            'nik' => $nik,
        ];

        $this->db->where('id', $user['id']);
        $this->M_zulluser->editProfil($update);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Profil berhasil di edit !
		  </div>');
        redirect('C_zulluser/profile');
    }


    public function resetPassword()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short !'
        ]);
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // gagal reset password
            $data['user'] = $this->M_zulluser->userData($this->session->userdata('username'))->row_array();

            $data['riwayat'] = $this->M_zulluser->pengaduan()->result_array();

            $this->load->view('template/V_zullheader');
            $this->load->view('template/V_zullsidebaruser');
            $this->load->view('template/V_zulltopbaruser', $data);
            $this->load->view('user/V_zullseting');
            $this->load->view('template/V_zullfooteruser');
        } else {
            $user = $this->M_zulluser->userData($this->session->userdata('username'))->row_array();

            $data = [
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            $this->db->where('id', $user['id']);
            $this->db->update('masyarakat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Password anda berhasil di reset !
				  </div>');
            redirect('C_zullauth');
        }
    }
}
