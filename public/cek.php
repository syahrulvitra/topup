<?php
         $curl = curl_init();
          $postData = [
            'userid' => '282055369',
            'serverid' => '9470',
            'token' => 'GO7wmJ3SJwnqs5ePbr3mH8t5rZxcwMeCgXBR5aLfwDCFHJg9WoyQ56qZ7ODh4LOv',
          ];

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.squarestore.web.id/apiv3/ml",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postData ,
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
            ),
          ));
          $resp = curl_exec($curl);
          $err = curl_error($curl);
        curl_close($curl); 
        echo $resp;