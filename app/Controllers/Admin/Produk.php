<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Produk extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        $product = [];
        foreach ($this->M_Base->all_data('product') as $loop) {
            $games = $this->M_Base->data_where('games', 'id', $loop['games_id']);

            $nama_games = count($games) == 1 ? $games[0]['games'] : '-';

            $product[] = array_merge($loop, [
                'games' => $nama_games,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Produk',
            'product' => $product,
    	]);

        return view('Admin/Produk/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'games_id' => addslashes(trim(htmlspecialchars($this->request->getPost('games_id')))),
                'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                'price' => addslashes(trim(htmlspecialchars($this->request->getPost('price')))),
                'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                'sku' => addslashes(trim(htmlspecialchars($this->request->getPost('sku')))),
            ];

            if (empty($data_post['games_id']) OR empty($data_post['product']) OR empty($data_post['price']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $games = $this->M_Base->data_where('games', 'id', $data_post['games_id']);

                if (count($games) === 1) {
                    $this->M_Base->data_insert('product', $data_post);

                    $this->session->setFlashdata('success', 'Produk berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Games tidak ditemukan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Produk',
            'games' => $this->M_Base->all_data('games'),
        ]);

        return view('Admin/Produk/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (is_numeric($id)) {
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'games_id' => addslashes(trim(htmlspecialchars($this->request->getPost('games_id')))),
                        'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                        'price' => addslashes(trim(htmlspecialchars($this->request->getPost('price')))),
                        'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                        'sku' => addslashes(trim(htmlspecialchars($this->request->getPost('sku')))),
                    ];

                    if (empty($data_post['games_id']) OR empty($data_post['product']) OR empty($data_post['price']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $games = $this->M_Base->data_where('games', 'id', $data_post['games_id']);

                        if (count($games) === 1) {
                            $this->M_Base->data_update('product', $data_post, $id);

                            $this->session->setFlashdata('success', 'Produk berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $this->session->setFlashdata('error', 'Games tidak ditemukan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Produk',
                    'product' => $product[0],
                    'games' => $this->M_Base->all_data('games'),
                ]);

                return view('Admin/Produk/edit', $data);

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (is_numeric($id)) {
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                $this->M_Base->data_delete('product', $id);
                
                $this->session->setFlashdata('success', 'Produk berhasil dihapus');
                return redirect()->to(base_url() . '/admin/produk');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}

