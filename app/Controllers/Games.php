<?php

namespace App\Controllers;

class Games extends BaseController {

    public function index($slug = null) {

        if ($slug) {
            $games = $this->M_Base->data_where('games', 'slug', $slug);

            if (count($games) === 1) {
                if ($games[0]['slug'] === $slug) {

                    if ($this->request->getPost('tombol')) {
                        $data_post = [
                            'user_id' => addslashes(trim(htmlspecialchars($this->request->getPost('user_id')))),
                            'zone_id' => addslashes(trim(htmlspecialchars($this->request->getPost('zone_id')))),
                            'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                            'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                            'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                            'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                        ];

                        if (empty($data_post['user_id']) OR empty($data_post['zone_id'])) {
                            $this->session->setFlashdata('error', 'ID Player harus diisi');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['method'])) {
                            $this->session->setFlashdata('error', 'Metode belum dipilih');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['product'])) {
                            $this->session->setFlashdata('error', 'Produk belum dipilih');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['wa'])) {
                            $this->session->setFlashdata('error', 'Nomor whatsapp tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (strlen($data_post['wa']) < 10 OR strlen($data_post['wa']) > 15) {
                            $this->session->setFlashdata('error', 'Nomor whatsapp tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $product = $this->M_Base->data_where('product', 'id', $data_post['product']);

                            if (count($product) === 1) {
                                if ($product[0]['status'] == 'On') {

                                    if ($data_post['method'] === 'balance') {
                                        $method = [
                                            [
                                                'id' => 10001,
                                                'status' => 'On',
                                                'provider' => 'Balance',
                                                'method' => 'Saldo Akun',
                                                'uniq' => 'N',
                                            ]
                                        ];
                                    } else {
                                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                                    }

                                    if (count($method) === 1) {
                                        if ($method[0]['status'] == 'On') {

                                            if ($this->users == false) {
                                                $username = 'Guest';
                                                $username_tripay = 'Guest';
                                            } else {
                                                $username = $this->users['username'];
                                                $username_tripay = $this->users['username'];
                                            }

                                            $status = 'Pending';
                                            $ket = 'Menunggu Pembayaran';

                                            $order_id = date('Ymd') . rand(0000,9999);

                                            $find_price = $this->M_Base->data_where_array('price', [
                                                'method_id' => $data_post['method'],
                                                'product_id' => $data_post['product'],
                                            ]);

                                            $uniq = ($method[0]['uniq'] == 'Y') ? rand(000,999) : 0;

                                            $price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];
                                            
                                            $price = $price + $uniq;

                                            if ($method[0]['provider'] == 'Tripay') {
                                                if ($method[0]['code'] == 'OVO') {
                                                $data = [
                                                    'method'         => $method[0]['code'],
                                                    'merchant_ref'   => $order_id,
                                                    'amount'         => $price,
                                                    'customer_name'  => $username_tripay,
                                                    'customer_email' => 'email@gmail.com',
                                                    'customer_phone' => '081111111',
                                                    'order_items'    => [
                                                        [
                                                            'sku'         => $product[0]['sku'],
                                                            'name'        => $product[0]['product'],
                                                            'price'       => $price,
                                                            'quantity'    => 1,
                                                        ]
                                                    ],
                                                    'callback_url'   => base_url() . '/sistem/callback/tripay',
                                                    'return_url'   => base_url() . '/payment/' . $order_id,
                                                    'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                                                    'signature'    => hash_hmac('sha256', $this->M_Base->u_get('tripay-merchant').$order_id.$price, $this->M_Base->u_get('tripay-private'))
                                                ];
                                                }else {
                                                $data = [
                                                    'method'         => $method[0]['code'],
                                                    'merchant_ref'   => $order_id,
                                                    'amount'         => $price,
                                                    'customer_name'  => $username_tripay,
                                                    'customer_email' => 'email@gmail.com',
                                                    'customer_phone' => $data_post['wa'],
                                                    'order_items'    => [
                                                        [
                                                            'sku'         => $product[0]['sku'],
                                                            'name'        => $product[0]['product'],
                                                            'price'       => $price,
                                                            'quantity'    => 1,
                                                        ]
                                                    ],
                                                    'callback_url'   => base_url() . '/sistem/callback/tripay',
                                                    'return_url'   => base_url() . '/payment/' . $order_id,
                                                    'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                                                    'signature'    => hash_hmac('sha256', $this->M_Base->u_get('tripay-merchant').$order_id.$price, $this->M_Base->u_get('tripay-private'))
                                                ];
                                                }

                                                $curl = curl_init();

                                                curl_setopt_array($curl, [
                                                    CURLOPT_FRESH_CONNECT  => true,
                                                    CURLOPT_URL            => 'https://tripay.co.id/api/transaction/create',
                                                    CURLOPT_RETURNTRANSFER => true,
                                                    CURLOPT_HEADER         => false,
                                                    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->M_Base->u_get('tripay-key')],
                                                    CURLOPT_FAILONERROR    => false,
                                                    CURLOPT_POST           => true,
                                                    CURLOPT_POSTFIELDS     => http_build_query($data),
                                                    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
                                                ]);

                                                $result = curl_exec($curl);
                                                $result = json_decode($result, true);
                                                

                                                if ($result) {
                                                    if ($result['success'] == true) {
                                                        if ($method[0]['code'] == "OVO") {
                                                            $payment_code = $result['data']['checkout_url'];
                                                        }else if (array_key_exists('qr_url', $result['data'])) {
                                                            $payment_code = $result['data']['qr_url'];
                                                        } else {
                                                            $payment_code = $result['data']['pay_code'];
                                                        }
                                                    } else {
                                                        $this->session->setFlashdata('error', 'Result : ' . $result['message']);
                                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                    }
                                                } else {
                                                    $this->session->setFlashdata('error', 'Gagal terkoneksi ke Tripay');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                }
                                                
                                              

                                            } else if ($method[0]['provider'] == 'Balance') {

                                                if ($this->users == false) {
                                                    $this->session->setFlashdata('error', 'Silahkan login dahulu');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                } else if ($this->users['balance'] < $price) {
                                                    $this->session->setFlashdata('error', 'Saldo tidak mencukupi');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                } else {

                                                    $payment_code = 'Saldo Akun';
                                                    $status = 'Processing';

                                                    if (!empty($data_post['zone_id']) AND $data_post['zone_id'] != 1) {
                                                        $customer_no = $data_post['user_id'] . $data_post['zone_id'];
                                                    } else {
                                                        $customer_no = $data_post['user_id'];
                                                    }

                                                    if ($product[0]['provider'] === 'DF') {

                                                        $df_user = $this->M_Base->u_get('digi-user');
                                                        $df_key = $this->M_Base->u_get('digi-key');

                                                        $post_data = json_encode([
                                                            'username' => $df_user,
                                                            'buyer_sku_code' => $product[0]['sku'],
                                                            'customer_no' => $customer_no,
                                                            'ref_id' => $order_id,
                                                            'sign' => md5($df_user.$df_key.$order_id),
                                                        ]);
                                        
                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                                        curl_setopt($ch, CURLOPT_POST, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                                        $result = curl_exec($ch);
                                                        $result = json_decode($result, true);
                                                        
                                                        if (isset($result['data'])) {
                                                            if ($result['data']['status'] == 'Gagal') {
                                                                $ket = $result['data']['message'];
                                                                $status = 'Canceled';
                                                    //echo json_encode(['success' => true]);
                                                            } else {
         $balancesisa = $this->users['balance']; 
         $balancesekarang = $this->users['balance'] - $price;  
                                                    
                                                    $this->M_Base->data_update('users', [
                                                        'balance' => $this->users['balance'] - $price,
                                                    ], $this->users['id']); 
				                            if ($result['data']['status'] == 'Sukses') {
				                                $status = 'Success';
				                            }                                                    
                                                                $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
                                            $wagate1 = $this->M_Base->u_get('wa-key');
                                            $wagate2 =$this->M_Base->u_get('wa-fonnte');                                                                
                                                                
        $t = "*[NOTIFIKASI | Pesanan]*
        *Username :* $username
        *Invoice :* $order_id
        *Product Name :* ".$games[0]['games']."
        *Product Data Name :* ".$product[0]['product']."
        *Price :* Rp.$price
        *Payment Method :* ".$method[0]['method']."
        *Balance Sisa :* Rp.$balancesisa
        *Balance Sekarang :* Rp.$balancesekarang
        *User Input:* $customer_no\n";                                                                
                                                                
                                          if ($wagate1 != '') {
                                 $requestpesan = $this->M_Base->post2('https://wagate.squaresender.my.id/app/api/send-message', [
                                    'api_key' => $wagate1,
                                    'sender' => $this->M_Base->u_get('wa-nomer'),
                                    'number' => $this->M_Base->u_get('wa-nomer'),
                                    'message' => $t,  
                                    ]);
                                          } else {      
                                 $requestpesan = $this->M_Base->post3('https://api.fonnte.com/send', [
                                    'target' => $this->M_Base->u_get('wa-nomer'),
                                    'message' => $t,
                                    'delay' => '2',
                                    'schedule' => '0',
                                    'countryCode' => '62',    
                                ], $wagate2);
                                          }                                                                

                                                                //echo json_encode(['success' => true]);
                                                            }
                                                        } else {
                                    $this->session->setFlashdata('error', 'Produk sedang tidak tersedia');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                        
                                                   } else if ($product[0]['provider'] === 'VP') {

                                                        $vp_user = $this->M_Base->u_get('vp-user');
                                                        $vp_key = $this->M_Base->u_get('vp-key');
                                                        $signe = $vp_user.$vp_key;
                                                        $sign = md5($signe);
                                                        
                                                        $curl1 = curl_init();
                                        
                                                        curl_setopt_array($curl1, array(
                                                            CURLOPT_URL => 'https://vip-reseller.co.id/api/game-feature',
                                                            CURLOPT_RETURNTRANSFER => true,
                                                            CURLOPT_ENCODING => '',
                                                            CURLOPT_MAXREDIRS => 10,
                                                            CURLOPT_TIMEOUT => 0,
                                                            CURLOPT_FOLLOWLOCATION => true,
                                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                            CURLOPT_CUSTOMREQUEST => 'POST',
                                                            CURLOPT_POSTFIELDS => array('key' => $vp_key, 'sign' => $sign, 'type' => 'order', 'service' => $product[0]['sku'], 'data_no' => $data_post['user_id'], 'data_zone' => $data_post['zone_id']),
                                                            ));
                                                            
                                                        $result = curl_exec($curl1);
                                                        $result = json_decode($result, true);
                                                        
                                                        if (isset($result['data'])) {
                                                            if ($result['data']['status'] != 'waiting') {
                                                                $ket = $result['message'];
                                                                $status = 'Canceled';
                                                   // echo json_encode(['success' => true]);
                                                            } else {
                                                    $this->M_Base->data_update('users', [
                                                        'balance' => $this->users['balance'] - $price,
                                                    ], $this->users['id']);
                                                                $ket = $result['data']['note'] !== '' ? $result['data']['note'] : $result['data']['note'];

                                                               // echo json_encode(['success' => true]);
                                                            }
                                                        } else {
                                    $this->session->setFlashdata('error', $result['message']);
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }                                                        
                                                    } else if ($product[0]['provider'] == 'Manual') {
                                                        
                                                        $status = 'Processing';
                                                        $ket = 'Pesanan siap diproses';
                                                        
                                                    } else if ($product[0]['provider'] === 'AG') {

                                                        $curl = curl_init();

                                                        curl_setopt_array($curl, array(
                                                            CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $order_id,
                                                            CURLOPT_RETURNTRANSFER => true,
                                                            CURLOPT_ENCODING => '',
                                                            CURLOPT_MAXREDIRS => 10,
                                                            CURLOPT_TIMEOUT => 0,
                                                            CURLOPT_FOLLOWLOCATION => true,
                                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                            CURLOPT_CUSTOMREQUEST => 'GET',
                                                            CURLOPT_POSTFIELDS => '',
                                                            CURLOPT_HTTPHEADER => array(
                                                                'Content-Type: application/x-www-form-urlencoded'
                                                            ),
                                                        ));

                                                        $result = curl_exec($curl);
                                                        $result = json_decode($result, true);

                                                        if ($result['status'] == 0) {
                                                            $ket = $result['error_msg'];
                                                            $status = 'Canceled';
                                                    //echo json_encode(['success' => true]);
                                                        } else {
                                                    $this->M_Base->data_update('users', [
                                                        'balance' => $this->users['balance'] - $price,
                                                    ], $this->users['id']);                                                            
                                                            
                                                            if ($result['data']['status'] == 'Sukses') {
                                                                $status = 'Success';
                                                            }

                                                            $ket = $result['data']['sn'];
                                                        }

                                                    } else {
                                                        $ket = 'Provider tidak ditemukan';
                                                    }

                                                    //$this->M_Base->data_update('users', [
                                                     //   'balance' => $this->users['balance'] - $price,
                                                   // ], $this->users['id']);
                                                   echo json_encode(['success' => true]);
                                                }

                                            } else if ($method[0]['provider'] == 'Manual') {
                                                $payment_code = $method[0]['rek'];
                                            } else {
                                                $this->session->setFlashdata('error', 'Metode tidak terdaftar');
                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                            }

                                            $this->M_Base->data_insert('orders', [
                                                'order_id' => $order_id,
                                                'username' => $username,
                                                'wa' => $data_post['wa'],
                                                'product_id' => $product[0]['id'],
                                                'product' => $product[0]['product'],
                                                'price' => $price,
                                                'user_id' => $data_post['user_id'],
                                                'zone_id' => $data_post['zone_id'],
                                                'nickname' => $data_post['username'],
                                                'method_id' => $method[0]['id'],
                                                'method' => $method[0]['method'],
                                                'games' => $games[0]['games'],
                                                'games_id' => $games[0]['id'],
                                                'status' => $status,
                                                'ket' => $ket,
                                                'payment_code' => $payment_code,
                                                'provider' => $product[0]['provider'],
                                                'date' => date('Y-m-d'),
                                                'date_create' => date('Y-m-d G:i:s'),
                                                'date_process' => date('Y-m-d G:i:s'),
                                            ]);
                                            $wagate1 = $this->M_Base->u_get('wa-key');
                                            $wagate2 =$this->M_Base->u_get('wa-fonnte');
                                                $t = "Halo kak $username,\n
Berikut adalah rincian pesanan Anda:
- Produk : ".$product[0]['product']."
- No.Invoice : $order_id
- Harga : Rp $price
- Metode Pembayaran : ".$method[0]['method']."\n
Untuk selengkapnya silahkan lihat pada link yang tertera di bawah ini.
" .base_url() . '/payment/'.$order_id."\n
Terima kasih.
*".$this->M_Base->u_get('web-name')."*";
                                          if ($wagate1 != '') {
                                 $requestpesan = $this->M_Base->post2('https://wagate.squaresender.my.id/app/api/send-message', [
                                    'api_key' => $wagate1,
                                    'sender' => $this->M_Base->u_get('wa-nomer'),
                                    'number' => $data_post['wa'],
                                    'message' => $t,  
                                    ]);
                                          } else {      
                                 $requestpesan = $this->M_Base->post3('https://api.fonnte.com/send', [
                                    'target' => $data_post['wa'],
                                    'message' => $t,
                                    'delay' => '2',
                                    'schedule' => '0',
                                    'countryCode' => '62',
                                ], $wagate2);
                                          }
                                
                                
                                            
                                                        if ($method[0]['code'] == "OVO") {
                                                            $this->session->setFlashdata('success', 'Pesanan berhasil dibuat');
                                                            return redirect()->to($result['data']['checkout_url']);
                                                        }                                            

                                            $this->session->setFlashdata('success', 'Pesanan berhasil dibuat');
                                            return redirect()->to(base_url() . '/payment/' . $order_id);

                                        } else {
                                            $this->session->setFlashdata('error', 'Metode pembayaran sedang gangguan');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Metode pembayaran tidak ditemukan');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                } else {
                                    $this->session->setFlashdata('error', 'Produk sedang gangguan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Produk tidak ditemukan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        }
                    }

                    $data = array_merge($this->base_data, [
                        'title' => $games[0]['games'],
                        'games' => $games[0],
                        'pay_balance' => $this->M_Base->u_get('pay_balance'),
                        'method' => $this->M_Base->data_where('method', 'status', 'On'),
                        'product' => $this->M_Base->data_where('product', 'games_id', $games[0]['id'], 'status', 'On'),
                    ]);

                    return view('Games/index', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function order($action = null, $id = null) {

        if ($action === 'get-price') {
            if (is_numeric($id)) {
                $product = $this->M_Base->data_where('product', 'id', $id);

                if (count($product) == 1) {
                    $price = [];
                    foreach ($this->M_Base->all_data('method') as $loop) {

                        $find_price = $this->M_Base->data_where_array('price', [
                            'method_id' => $loop['id'],
                            'product_id' => $id
                        ]);

                        $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                        $price[] = [
                            'method' => $loop['id'],
                            'price' => number_format($custom_price,0,',','.'),
                        ];
                    }

                    if ($this->M_Base->u_get('pay_balance') == 'Y') {

                        $find_price = $this->M_Base->data_where_array('price', [
                            'method_id' => 10001,
                            'product_id' => $id
                        ]);

                        $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                        $price[] = [
                            'method' => 'balance',
                            'price' => number_format($custom_price,0,',','.'),
                        ];
                    }

                    echo json_encode($price);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($action == 'get-detail') {

            if ($this->request->getPost('user_id') AND $this->request->getPost('zone_id') AND $this->request->getPost('method') AND $this->request->getPost('wa')) {
                $data_post = [
                    'user_id' => addslashes(trim(htmlspecialchars($this->request->getPost('user_id')))),
                    'zone_id' => addslashes(trim(htmlspecialchars($this->request->getPost('zone_id')))),
                    'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                    'product' => $id,
                    'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                ];

                $product = $this->M_Base->data_where('product', 'id', $data_post['product']);

                if (count($product) === 1) {
                    
                    if ($data_post['method'] === 'balance') {
                        $method = [
                            [
                                'method' => 'Saldo Akun',
                            ],
                        ];
                    } else {
                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                    }

                    if (count($method) === 1) {

                        $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);

                        if (count($games) == 1) {

                            $price = $this->M_Base->data_where_array('price', [
                                'method_id' => $data_post['method'],
                                'product_id' => $data_post['product'],
                            ]);

                            $real_price = count($price) == 1 ? $price[0]['price'] : $product[0]['price'];

                            if ($data_post['zone_id'] != 1) {
                                $target = $data_post['user_id'] . ' (' . $data_post['zone_id'] . ')';
                            } else {
                                $target = $data_post['user_id'];
                            }

                            if ($games[0]['check_status'] == 'Y') {

                                $result = $this->M_Base->post('https://www.squarestore.web.id/apiv3/' . $games[0]['check_code'], [
                                    'token' => $this->M_Base->u_get('square-license'),
                                    'userid' => $data_post['user_id'],
                                    'serverid' => $data_post['zone_id'],
                                ]);

                               if ($result) {
                                    if ($result['ok'] == true) {
                                        echo json_encode([
                                            'status' => true,
                                            'msg' => '
                                            <form action="" method="POST">

                                                <input type="hidden" name="user_id" value="'.$data_post['user_id'].'">
                                                <input type="hidden" name="zone_id" value="'.$data_post['zone_id'].'">
                                                <input type="hidden" name="username" value="'.$result['name'].'">
                                                <input type="hidden" name="method" value="'.$data_post['method'].'">
                                                <input type="hidden" name="product" value="'.$data_post['product'].'">
                                                <input type="hidden" name="wa" value="'.$data_post['wa'].'">

                                                <table style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Kategori Layanan:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$games[0]['games'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Nominal Layanan:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$product[0]['product'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Nickname:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$result['name'].' </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">UserID:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$target.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Metode Pembayaran:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$method[0]['method'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-left pt-2 pb-2"> Pastikan data game Anda sudah benar. Kesalahan input data game bukan tanggung jawab kami. </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn text-white" type="button" data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit" name="tombol" value="submit">Bayar Sekarang</button>
                                                </div>
                                            </form>
                                            ',
                                        ]);
                                    } else {
                                        echo json_encode([
                                            'status' => false,
                                            'msg' => $result['msg'],
                                        ]);
                                    }
                                    
                               } else {
                                    echo json_encode([
                                        'status' => false,
                                        'msg' => 'Akun gagal dicek'
                                    ]);
                                }
                            } else {
                                echo json_encode([
                                    'status' => true,
                                    'msg' => '
                                    <form action="" method="POST">

                                        <input type="hidden" name="user_id" value="'.$data_post['user_id'].'">
                                        <input type="hidden" name="zone_id" value="'.$data_post['zone_id'].'">
                                        <input type="hidden" name="method" value="'.$data_post['method'].'">
                                        <input type="hidden" name="product" value="'.$data_post['product'].'">
                                        <input type="hidden" name="wa" value="'.$data_post['wa'].'">

                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">Kategori Layanan:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$games[0]['games'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">Nominal Layanan:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$product[0]['product'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">UserID:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$target.'</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">Metode Pembayaran:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$method[0]['method'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-left pt-2 pb-2"> Pastikan data game Anda sudah benar. Kesalahan input data game bukan tanggung jawab kami. </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <button class="btn text-white" type="button" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" type="submit" name="tombol" value="submit">Bayar Sekarang</button>
                                        </div>
                                    </form>
                                    ',
                                ]);
                            }
                        } else {
                            echo json_encode([
                                'status' => false,
                                'msg' => 'Games tidak ditemukan',
                            ]);
                        }
                    } else {
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Metode pembayaran tidak ditemukan',
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Produk tidak ditemukan',
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Pembelian gagal dilakukan',
                ]);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
