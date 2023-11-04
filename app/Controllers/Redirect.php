<?php

namespace App\Controllers;

class Redirect extends BaseController {
        public function index()
    {
      $invoiceid = $this->input->get('tripay_merchant_ref');
      redirect('/payment/'.$invoiceid);        
    }
    
}