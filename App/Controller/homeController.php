<?php

namespace App\Controller;

use App\Framework\Controller;

class HomeController extends Controller
{
    
    public function index() {
        
        $this->generateView(array());    
}
}