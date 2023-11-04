<?php

namespace App\Controllers;

class Webhooks extends BaseController {
    public function index()
    {
      $privateKey = 'd548b6dcbad88ebb';
      $callbackSignature = isset($_SERVER['HTTP_X_HUB_SIGNATURE']) ? $_SERVER['HTTP_X_HUB_SIGNATURE'] : '';
      $json = file_get_contents("php://input");
      $signature = hash_hmac('sha1', $json, $privateKey);
      $signatureNew = 'sha1='.$signature;
        if ($callbackSignature == $signatureNew) {
            $data = json_decode($json);
            $data = $data->data;
            $merchantRef = $data->ref_id;
							$cek = $this->M_Base->data_where_array('orders', [
								'order_id' => $merchantRef,
							]);       
            if ($cek) {
                if ($cek->status == 'Success') {
                    echo json_encode(['success' => true]);
                }elseif ($cek->StatusOrder == 'Canceled') {
                    echo json_encode(['success' => true]);
                } else {
                    if ($cek) {
                        if ($data->rc == 00) {
                            $status = 'Success';
                            $ket = $data->sn;
                            $tanggalupdate = date('Y-m-d H:i');
								$this->M_Base->data_update('orders', [
									'status' => $status,
									'ket' => $ket,
									'date_process' => $tanggalupdate,
								], $cek[0]['id']);
								echo json_encode(['Transaksi Sukses' => true]);                            
                        } elseif ($data->rc == 03) {
                            $status = 'Pending';
                            $ket = $data->sn;
                            $tanggalupdate = date('Y-m-d H:i');  
								$this->M_Base->data_update('orders', [
									'status' => $status,
									'ket' => $ket,
									'date_process' => $tanggalupdate,
								], $cek[0]['id']);
								echo json_encode(['Transaksi pending' => true]);                             
                        } else {
                            $status = 'Canceled';
                            $ket = $data->sn;
                            $tanggalupdate = date('Y-m-d H:i');  
								$this->M_Base->data_update('orders', [
									'status' => $status,
									'ket' => $ket,
									'date_process' => $tanggalupdate,
								], $cek[0]['id']);
								echo json_encode(['Transaksi gagal' => true]);                            
                        }
                    } else {
                        echo "GAGAL";
                    }
                }
            } else {
                echo json_encode(['failed' => true]);
            }
        } else {
            echo json_encode(['Invalid signature' => true]);
        }
    }
    //end
}