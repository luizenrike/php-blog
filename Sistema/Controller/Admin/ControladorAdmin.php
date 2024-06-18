<?php

namespace Sistema\Controller\Admin;

use Sistema\Nucleo\Controlador;

class ControladorAdmin extends Controlador{

    public function __construct()
    {
        parent::__construct(ADMIN_TEMPLATE_VIEW_ROUTE);
    }
}

?>