<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Html2Text\Html2Text;

class Home extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('level') == 'Administrator' or $this->session->userdata('level') == 'User') {
            $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin";
            redirect($uri1 . '/dashboard');
        } else {
            $data['title']  = 'Login';
            $this->load->view('home', $data);
        }
    }

    public function login()
    {
        if ($this->session->userdata('level') == 'Administrator' or $this->session->userdata('level') == 'User') {
            $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin";
            redirect($uri1 . '/dashboard');
        } else {
            $data['title']  = 'Login';
            $digit1 = mt_rand(1, 20);
            $digit2 = mt_rand(1, 20);

            $captcha = array('captcha' => $digit1 + $digit2);

            $this->session->set_userdata($captcha);
            $data['captcha'] = "$digit1 + $digit2 = ?";

            $data['aplikasi'] = $this->m_model->get_desc('tb_aplikasi');
            $data['fungsi']       = $this->m_model->get_desc('tb_fungsi');
            $this->load->view('login', $data);
        }
    }

    public function auth()
    {
        date_default_timezone_set('Asia/Jakarta');

        $username   = $_POST['username'];
        $password   = $_POST['password'];
        // $jawaban    = $_POST['jawaban'];

        // if (!empty($jawaban)) {
        // if ($jawaban == $this->session->userdata('captcha')) {

        $where = array('username' => $username);

        $cek = $this->m_model->get_where($where, 'tb_user');

        if ($cek->num_rows() > 0) {
            foreach ($cek->result_array() as $row) {

                if (password_verify($password, $row['password'])) {

                    $datauser = array(
                        'id'            => $row['id'],
                        'nama'          => $row['nama'],
                        'telp'          => $row['telp'],
                        'email'         => $row['email'],
                        'username'      => $row['username'],
                        'skin'          => $row['skin'],
                        'level'         => $row['level'],
                        'foto'          => $row['foto'],
                        'terdaftar'     => $row['terdaftar']
                    );

                    $this->session->set_userdata($datauser);

                    $insertLog = array(
                        'idUser'    => $row['id'],
                        'status'    => 'Login',
                        'ipAddress' => $_SERVER['REMOTE_ADDR'],
                        'device'    => $_SERVER['HTTP_USER_AGENT'],
                        'terdaftar' => date('Y-m-d H:i:s'),
                    );

                    $this->m_model->insert($insertLog, 'tb_log');

                    $uri1 = $row['level'] === "User" ? "user" : "admin";
                    redirect($uri1 . '/dashboard');
                } else {
                    $this->session->set_flashdata('pesan', 'Password anda salah!');
                    redirect('home/login');
                }
            }
        } else {
            $this->session->set_flashdata('pesan', 'Username tidak ditemukan!');
            redirect('home/login');
        }
        // } else {
        //     $this->session->set_flashdata('pesan', 'Hitung dengan benar!');
        //     redirect('home/login');
        // }
        // } else {
        //     $this->session->set_flashdata('pesan', 'Captcha harap diisi!');
        //     redirect('home/login');
        // }
    }

    public function logout()
    {
        date_default_timezone_set('Asia/Jakarta');

        $insertLog = array(
            'idUser'    => $this->session->userdata('id'),
            'status'    => 'Logout',
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'device'    => $_SERVER['HTTP_USER_AGENT'],
            'terdaftar' => date('Y-m-d H:i:s'),
        );

        $this->m_model->insert($insertLog, 'tb_log');

        $this->session->sess_destroy();
        redirect('home/login');
    }

    public function signup()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->form_validation->set_rules([
            [
                'field'        =>    'nama',
                'label'        =>    'Nama Lengkap',
                'rules'        =>    'required|is_unique[tb_user.nama]',
                'errors'    => [
                    'required'    => '{field} wajib diisi.',
                    'is_unique'    => '{field} ini sudah ada.'
                ]
            ],
            [
                'field'        =>    'telp',
                'label'        =>    'Telp',
                'rules'        =>    'required',
                'errors'    => [
                    'required'    => '{field} wajib diisi.'
                ]
            ],
            [
                'field'        =>    'email',
                'label'        =>    'Email',
                'rules'        =>    'required|valid_email|is_unique[tb_user.email]',
                'errors'    => [
                    'required'        => '{field} wajib diisi.',
                    'valid_email'    => '{field} wajib berisi alamat email yang valid.',
                    'is_unique'        => '{field} ini sudah ada.'
                ]
            ],
            [
                'field'        =>    'username',
                'label'        =>    'Username',
                'rules'        =>    'required|is_unique[tb_user.email]',
                'errors'    => [
                    'required'        => '{field} wajib diisi.',
                    'is_unique'        => '{field} ini sudah ada.'
                ]
            ],
            [
                'field'        =>    'password',
                'label'        =>    'Password',
                'rules'        =>    'required',
                'errors'    => [
                    'required'    => '{field} wajib diisi.'
                ]
            ],
            [
                'field'        =>    'idFungsi',
                'label'        =>    'Fungsi',
                'rules'        =>    'required',
                'errors'    => [
                    'required'    => '{field} wajib dipilih.'
                ]
            ]
        ]);

        try {
            if ($this->form_validation->run()) {
                $options = [
                    'cost' => 10,
                ];

                $enkripPassword = password_hash($post['password'], PASSWORD_BCRYPT, $options);

                $data = array(
                    'nama'          => $post['nama'],
                    'telp'          => $post['telp'],
                    'email'         => $post['email'],
                    'username'      => $post['username'],
                    'password'      => $enkripPassword,
                    'idFungsi'      => $post['idFungsi'],
                    'level'         => $post['level'],
                    'foto'          => 'no-image.png',
                    'skin'          => 'blue',
                    'terdaftar'     => date('Y-m-d H:i:s')
                );

                $this->m_model->insert($data, 'tb_user');
                $response = [
                    'success'    => true,
                ];
            } else {
                $response = [
                    'error'             => true,
                    'error_nama'        => form_error('nama'),
                    'error_telp'        => form_error('telp'),
                    'error_email'       => form_error('email'),
                    'error_username'    => form_error('username'),
                    'error_password'    => form_error('password'),
                    'error_idFungsi'    => form_error('idFungsi')
                ];
            }
        } catch (\Exception $e) {
            log_message('error: ', $e->getMessage());
            $response = ['error' => false];
        }

        echo json_encode($response);
    }

    public function forget()
    {
        if ($this->session->userdata('level') == 'Administrator' or $this->session->userdata('level') == 'User') {
            $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin";
            redirect($uri1 . '/dashboard');
        } else {
            $data['title']  = 'Lupa Password';
            $data['aplikasi'] = $this->m_model->get_desc('tb_aplikasi');
            $this->load->view('forget', $data);
        }
    }

    public function lupa_password()
    {
        $this->load->model('m_user');

        $this->form_validation->set_rules([
            [
                'field'        =>    'email',
                'label'        =>    'Email',
                'rules'        =>    'required|valid_email',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'valid_email'   => '{field} wajib berisi alamat email yang valid.'
                ]
            ]
        ]);

        if ($this->form_validation->run() == FALSE) {
            $message = new Html2Text(form_error('email'));
            $this->session->set_flashdata('pesan', $message->getText());
            redirect(site_url('home/forget'), 'refresh');
        } else {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->m_user->getUserInfoByEmail($clean);

            if (!$userInfo) {
                $this->session->set_flashdata('pesan', 'Alamat email salah, silakan coba lagi.');
                redirect(site_url('home/forget'), 'refresh');
            } else {
                $token = $this->m_user->insertToken($userInfo->id);
                $qstring = $this->base64url_encode($token);
                $url = site_url() . 'home/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';

                $subject = "APIKAT - Reset Password";

                $message = '';
                $message .= "<p>Anda telah melakukan reset password pada tanggal " . date('d-m-Y H:i:s') . " untuk Username Apikat: <br>";
                $message .= "$userInfo->username</p>";
                $message .= "<p>Silakan klik link dibawah ini:<br>";
                $message .= "$link</p>";

                $data['message'] = $message;
                $data['user'] = $userInfo;

                $message = $this->load->view('admin/templates/emailtemplate', $data, true);
                $message = new Html2Text($message);
                $this->m_model->sendEmail($email, $subject, null, $message->getText());

                $this->session->set_flashdata('pesan_sukses', 'Silahkan cek email anda untuk reset password.');
                redirect(site_url('home/login'), 'refresh');
            }
        }
    }

    public function reset_password()
    {
        $this->load->model('m_user');

        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->m_user->isTokenValid($cleanToken); //either false or array();          

        if (!$user_info) {
            $this->session->set_flashdata('pesan', 'Token tidak valid atau kadaluarsa');
            redirect(site_url('home'), 'refresh');
        }

        $data = array(
            'title' => 'Reset Password',
            'nama' => $user_info->nama,
            'email' => $user_info->email,
            'aplikasi' => $this->m_model->get_desc('tb_aplikasi'),
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules([
            [
                'field'        => 'password',
                'label'        => 'Password Baru',
                'rules'        => 'required',
                'errors'    => [
                    'required'    => '{field} wajib diisi.'
                ]
            ],
            [
                'field'        => 'konfirmasi_pass',
                'label'        => 'Konfirmasi Password',
                'rules'        => 'required|matches[password]',
                'errors'    => [
                    'required'    => '{field} wajib diisi.',
                    'matches'    => '{field} tidak sama dengan Password Baru.'
                ]
            ]
        ]);

        if ($this->form_validation->run() == FALSE) {
            $password = new Html2Text(form_error('password'));
            $konfirmasi_pass = new Html2Text(form_error('konfirmasi_pass'));
            $this->session->set_flashdata('pesan', $password->getText());
            $this->session->set_flashdata('pesan', $konfirmasi_pass->getText());

            $this->load->view('reset_password', $data);
        } else {
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $cleanPost['password'] = $cleanPost['password'];
            $cleanPost['user_id'] = $user_info->id;
            unset($cleanPost['konfirmasi_pass']);

            if (!$this->m_user->updatePassword($cleanPost)) {
                $this->session->set_flashdata('pesan', 'Update password gagal.');
            } else {
                $this->session->set_flashdata('pesan_sukses', 'Password anda sudah diperbaharui. Silakan login.');
            }

            redirect(site_url('home/login'), 'refresh');
        }
    }

    private function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
