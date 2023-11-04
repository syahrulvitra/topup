<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Konfigurasi extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        if ($this->request->getPost('tombol')) {
            if ($this->request->getPost('tombol') == 'umum') {

                $this->M_Base->u_update('web-title', $this->request->getPost('title'));
                $this->M_Base->u_update('web-name', $this->request->getPost('name'));
                $this->M_Base->u_update('web-keywords', $this->request->getPost('keywords'));
                $this->M_Base->u_update('web-description', $this->request->getPost('descriptiona'));

                $logo = $this->M_Base->upload_file($this->request->getFiles()['logo'], 'assets/images/');
                if ($logo) {
                    $this->M_Base->u_update('web-logo', $logo);
                }

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'banner') {

                $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/banner/');

                if ($image) {
                    $this->M_Base->data_insert('banner', [
                        'image' => $image,
                    ]);

                    $this->session->setFlashdata('success', 'Banner berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar banner tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            } else if ($this->request->getPost('tombol') == 'digi') {
                $this->M_Base->u_update('digi-user', $this->request->getPost('user'));
                $this->M_Base->u_update('digi-key', $this->request->getPost('key'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'vp') {
                $this->M_Base->u_update('vp-user', $this->request->getPost('user'));
                $this->M_Base->u_update('vp-key', $this->request->getPost('key'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));                
            } else if ($this->request->getPost('tombol') == 'ag') {
                $this->M_Base->u_update('ag-merchant', $this->request->getPost('merchant'));
                $this->M_Base->u_update('ag-secret', $this->request->getPost('secret'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'tripay') {
                $this->M_Base->u_update('tripay-key', $this->request->getPost('key'));
                $this->M_Base->u_update('tripay-private', $this->request->getPost('private'));
                $this->M_Base->u_update('tripay-merchant', $this->request->getPost('merchant'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'square') {
                $this->M_Base->u_update('square-license', $this->request->getPost('square'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'wagate') {
                $this->M_Base->u_update('wa-key', $this->request->getPost('key'));
                $this->M_Base->u_update('wa-nomer', $this->request->getPost('nomer'));
                
                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string()))); 
            } else if ($this->request->getPost('tombol') == 'fonnte') {
                $this->M_Base->u_update('wa-fonnte', $this->request->getPost('fonnte'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));                
            } else if ($this->request->getPost('tombol') == 'sm') {
                $this->M_Base->u_update('sm-wa', $this->request->getPost('wa'));
                $this->M_Base->u_update('sm-ig', $this->request->getPost('ig'));
                $this->M_Base->u_update('sm-yt', $this->request->getPost('yt'));
                $this->M_Base->u_update('sm-fb', $this->request->getPost('fb'));
                $this->M_Base->u_update('sm-tw', $this->request->getPost('tw'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'sk') {
                $this->M_Base->u_update('page_sk', $this->request->getPost('page_sk'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Konfigurasi',
            'tripay' => [
                'key' => $this->M_Base->u_get('tripay-key'),
                'private' => $this->M_Base->u_get('tripay-private'),
                'merchant' => $this->M_Base->u_get('tripay-merchant'),
            ],
            'ag' => [
                'merchant' => $this->M_Base->u_get('ag-merchant'),
                'secret' => $this->M_Base->u_get('ag-secret'),
            ],
            'digi' => [
                'user' => $this->M_Base->u_get('digi-user'),
                'key' => $this->M_Base->u_get('digi-key'),
            ],
            'vp' => [
                'user' => $this->M_Base->u_get('vp-user'),
                'key' => $this->M_Base->u_get('vp-key'),
            ],            
            'square' => $this->M_Base->u_get('square-license'),
            'wagate' => [
                'key' => $this->M_Base->u_get('wa-key'),
                'nomer' => $this->M_Base->u_get('wa-nomer'),
            ],
            'fonnte' => $this->M_Base->u_get('wa-fonnte'),            
            'banner' => $this->M_Base->all_data('banner'),
            'page_sk' => $this->M_Base->u_get('page_sk'),
    	]);

        return view('Admin/Konfigurasi/index', $data);
    }

    public function banner($action = null, $id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if ($action === 'delete') {
            if (is_numeric($id)) {
                $this->M_Base->data_delete('banner', $id);

                $this->session->setFlashdata('success', 'Banner berhasil dihapus');
                return redirect()->to(base_url() . '/admin/konfigurasi');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}