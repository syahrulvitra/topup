<?php

namespace App\Controllers;

class Pages extends BaseController {

    public function sk() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Syarat & Ketentuan',
            'page_sk' => $this->M_Base->u_get('page_sk'),
    	]);

        return view('Pages/sk', $data);
    }

    public function price() {

        $product = [];
        foreach (array_reverse($this->M_Base->all_data_order('games', 'sort')) as $game) {
            $data_product = $this->M_Base->data_where_array('product', [
                'games_id' => $game['id']
            ], 'price');

            if (count($data_product) !== 0) {
                $product[] = [
                    'games' => $game['games'],
                    'image' => $game['image'],
                    'product' => array_reverse($data_product),
                ];
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Harga',
            'price' => $product,
            'menu_active' => 'Price',
    	]);

        return view('Pages/price', $data);
    }

    public function method() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Metode',
            'method' => $this->M_Base->all_data('method'),
            'menu_active' => 'Method',
    	]);

        return view('Pages/method', $data);
    }

    public function login() {

        if ($this->users !== false) {
            return redirect()->to(base_url());
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $users = $this->M_Base->data_where('users', 'username', $data_post['username']);

                if (count($users) === 1) {
                    if ($users[0]['username'] === $data_post['username']) {
                        if ($users[0]['status'] === 'On') {
                            if (password_verify($data_post['password'], $users[0]['password'])) {

                                $this->session->set('username', $users[0]['username']);

                                $this->session->setFlashdata('success', 'Login berhasil');
                                return redirect()->to(base_url() . '/user');
                            } else {
                                $this->session->setFlashdata('error', 'Username atau password salah');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Akun kamu telah dinonaktifkan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Username atau password salah');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Username atau password salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Login',
            'menu_active' => 'Login',
    	]);

        return view('Pages/login', $data);
    }

    public function logout() {

        $this->session->remove('username');

        $this->session->setFlashdata('success', 'Logout berhasil');
        return redirect()->to(base_url() . '/login');
    }
}
