<?php

namespace App\Controllers;

class Sistem extends BaseController {

    public function callback($action = null) {
    	if ($action === 'tripay') {

			$json = file_get_contents('php://input');

			$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

			if ($callbackSignature !== hash_hmac('sha256', $json, $this->M_Base->u_get('tripay-private'))) {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			} else if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			} else {

				$data = json_decode($json, true);

				if ($data) {
					if (is_array($data)) {
						$id = $data['merchant_ref'];

						if ($data['status'] === 'PAID') {
							$orders = $this->M_Base->data_where_array('orders', [
								'order_id' => $id,
								'status' => 'Pending'
							]);

							if (count($orders) === 1) {

								$status = 'Processing';

								$product = $this->M_Base->data_where('product', 'id', $orders[0]['product_id']);

								if (count($product) === 1) {
									
									if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
										$customer_no = $orders[0]['user_id'] . $orders[0]['zone_id'];
									} else {
										$customer_no = $orders[0]['user_id'];
									}

									if ($orders[0]['provider'] == 'DF') {

										$df_user = $this->M_Base->u_get('digi-user');
										$df_key = $this->M_Base->u_get('digi-key');

										$post_data = json_encode([
				                            'username' => $df_user,
				                            'buyer_sku_code' => $product[0]['sku'],
				                            'customer_no' => $customer_no,
				                            'ref_id' => $orders[0]['order_id'],
				                            'sign' => md5($df_user.$df_key.$orders[0]['order_id']),
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
				                            if ($result['data']['status'] == 'Sukses') {
				                                $status = 'Success';
				                            }				                                
				                                $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];

												//echo json_encode(['success' => true]);
				                            }
				                        } else {
				                        	$ket = 'Failed Order';
				                        }
									} else if ($orders[0]['provider'] == 'VP') {

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
                                                    echo json_encode(['success' => true]);
                                                            } else {
                                                                $ket = $result['data']['note'] !== '' ? $result['data']['note'] : $result['data']['note'];

                                                                //echo json_encode(['success' => true]);
                                                            }
                                                        } else {
                                                            $ket = 'Failed Order';
                                                        }                                                        
				                        
				                        
				                    } else if ($orders[0]['provider'] == 'Manual') {
                                                        
                                        $status = 'Processing';
                                        $ket = 'Pesanan siap diproses';
                                        
									} else if ($orders[0]['provider'] == 'AG') {

										$curl = curl_init();

										curl_setopt_array($curl, array(
											CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $orders[0]['order_id'],
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
				                        	
				                            if ($result['data']['status'] == 'Sukses') {
				                                $status = 'Success';
				                            }

				                            $ket = $result['data']['sn'];
				                            //echo json_encode(['success' => true]);
				                        }

									} else {
										$ket = 'Provider tidak ditemukan';
									}
								} else {
									$ket = 'Produk tidak ditemukan';
								}

								$this->M_Base->data_update('orders', [
									'status' => $status,
									'ket' => $ket,
								], $orders[0]['id']);
								echo json_encode(['success' => true]);

							} else {
								$topup = $this->M_Base->data_where_array('topup', [
									'topup_id' => $id,
									'status' => 'Pending',
								]);

								if (count($topup) === 1) {
									$users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);

									if (count($users) === 1) {
										$this->M_Base->data_update('users', [
											'balance' => $users[0]['balance'] + $topup[0]['amount'],
										], $users[0]['id']);

										$this->M_Base->data_update('topup', [
											'status' => 'Success',
										], $topup[0]['id']);

										echo json_encode(['msg' => 'Berhasil {TOPUP}']);
									} else {
										echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
									}
								} else {
									echo json_encode(['success' => true, 'msg' => 'Transaksi tidak ditemukan']);
								}
							}
						} else 	if ($data['status'] === 'EXPIRED') {
							$orders = $this->M_Base->data_where_array('orders', [
								'order_id' => $id,
								'status' => 'Pending'
							]);	

								$status = 'Expired';
								$ket = 'Transaksi Expired';
								$this->M_Base->data_update('orders', [
									'status' => $status,
									'ket' => $ket,
								], $orders[0]['id']);								
								echo json_encode(['success' => true]);
						} else 	if ($data['status'] === 'FAILED') {
							$orders = $this->M_Base->data_where_array('orders', [
								'order_id' => $id,
								'status' => 'Pending'
							]);	

								$status = 'Canceled';
								$ket = 'Transaksi GAGAL';
								$this->M_Base->data_update('orders', [
									'status' => $status,
									'ket' => $ket,
								], $orders[0]['id']);								
								echo json_encode(['success' => true]);								
						
						} else {
							echo json_encode(['success' => true, 'msg' => 'Transaksi tidak ditemukan']);
						}
					} else {
						throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
					}
				} else {
					throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				}
			}
    	} else {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}
    }
}