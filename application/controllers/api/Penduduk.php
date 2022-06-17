<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';


class Penduduk extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penduduk_model', 'penduduk');
        $this->methods['index_get']['limit'] = 100; // 500 requests per hour per user/key
    }
//mengambil data penduduk
    public function index_get()
    {
        $id = $this->get('id_user');
        if( $id === null) {
            $penduduk = $this->penduduk->getPenduduk();
        } else {
            $penduduk = $this->penduduk->getPenduduk($id);
        }
        
        if($penduduk){
            $this->response([
                'status' => true,
                'data' => $penduduk
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
 
}