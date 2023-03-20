<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_zullauth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_zulladmin');
    }


    public function index()
    {
        $check = $this->db->get('petugas')->num_rows();
        if ($check == 0) {

            redirect('C_zullauth/setup');
        }
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Gagal validasi
            $this->load->view('V_zulllogin');
        } else {

            // Lolos validasi
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $masyarakat = $this->db->get_where('masyarakat', ['username' => $username])->row_array();

        // jika usernya ada
        if ($masyarakat) {

            // cek password
            if (password_verify($password, $masyarakat['password'])) {


                $data = [
                    'username' => $masyarakat['username'],
                    'password' => $masyarakat['password'],
                ];

                // kondisi
                $this->session->set_userdata($data);
                // if ($this->form_validation->run() == true) {

                //     redirect('C_zulluser');
                // } else {

                //     redirect('C_zullauth');
                // }
                if ($masyarakat['active'] == 'aktif') {
                    redirect('C_zulluser');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Akun telah di suspend ! </div>');
                    redirect('C_zullauth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Wrong password !
		  	</div>');
                redirect('C_zullauth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Username is not registered !
		  	</div>');
            redirect('C_zullauth');
        }
    }

    public function register()
    {

        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
            'matches' => 'password dont match !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim');


        if ($this->form_validation->run() == false) {

            $data['title'] = 'Register Account';
            $this->load->view('V_zullregister', $data);
        } else {

            $data = array(
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'telpon' => htmlspecialchars($this->input->post('telepon', true)),
                'active'=>'aktif'
            );

            $this->db->insert('masyarakat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Congratulation your account has been created !
		  	</div>');
            redirect('C_zullauth');
        }
    }


    public function setup()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
            'matches' => 'password dont match !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('telp', 'telp', 'required|trim');


        if ($this->form_validation->run() == false) {

            $data['title'] = 'Register Account';
            $this->load->view('admin/V_zullsetup', $data);
        } else {

            $data = array(
                'nama_petugas' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'telpon' => htmlspecialchars($this->input->post('telp', true)),
                'level' => 'admin',
                'active'=>'active'
            );

            $this->db->insert('petugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Congratulation your account has been created !
		  	</div>');
            redirect('C_zullauth/login_admin');
        }
    }


    public function login_admin()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Gagal validasi
            $this->load->view('admin/V_zulllogin');
        } else {

            // Lolos validasi
            $this->_login_admin();
        }
    }


    private function _login_admin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $masyarakat = $this->db->get_where('petugas', ['username' => $username])->row_array();

        // jika usernya ada
        if ($masyarakat) {

            // cek password
            if (password_verify($password, $masyarakat['password'])) {


                $data = [
                    'username' => $masyarakat['username'],
                    'password' => $masyarakat['password'],
                ];

                // kondisi
                $this->session->set_userdata($data);
                // if ($this->form_validation->run() == true) {

                //     redirect('C_zulladmin');
                // } else {

                //     redirect('C_zullauth');
                // }
                if ($masyarakat['status'] == 'active') {
                    redirect('C_zulladmin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Akun telah di suspend ! </div>');
                    redirect('C_zullauth/login_admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Wrong password !
		  	</div>');   
                redirect('C_zullauth/login_admin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Username is not registered !
		  	</div>');
            redirect('C_zullauth/login_admin');
        }
    }


    public function registrasi_petugas()
    {

        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
            'matches' => 'password dont match !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('telpon', 'telpon', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required|trim');

        $data = array(
            'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas')),
            'username' => htmlspecialchars($this->input->post('username')),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'telpon' => htmlspecialchars($this->input->post('telpon')),
            'level' => htmlspecialchars($this->input->post('level')),
        );

        $this->M_zulladmin->insertpetugas($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Congratulation your account has been created !
		  	</div>');
        redirect('C_zulladmin/petugas');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert" >
            You Have Been Logout !
            </div>');
        redirect('C_zullauth');
    }

    public function logoutadmin()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> 
            You Have Been Logout !
            </div>');
        redirect('C_zullauth/login_admin');
    }
}
