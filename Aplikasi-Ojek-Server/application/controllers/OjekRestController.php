<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 8:30:29 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 * 
 */
require APPPATH . '/libraries/REST_Controller.php';

class OjekRestController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

}
