<?php

namespace App\Controller;

use App\Templates\View;

class HomeController
{
    
    public function render() {
        $home = new View;
        return $home->view();
      
}
}