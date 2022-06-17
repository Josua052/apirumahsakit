<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';


class History extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('History_model', 'history');
        $this->methods['index_get']['limit'] = 100; // 500 requests per hour per user/key
    }

    public function index_get()
    {
        $id = $this->get('id_user');
        if( $id === null) {
            $history = $this->history->getHistory();
        } else {
            $history = $this->history->getHistory($id);
        }
        
        if($history){
            $this->response([
                'status' => true,
                'data' => $history
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function index_put()
    {
        $id = $this->put('id_history');
        $data = [
            'nama' => $this->put('nama'),
            'tindakan' => $this->put('tindakan'),
            'status' => $this->put('status'),
            'tanggal_keluar' => $this->put('tanggal_keluar')
        ];
        if( $this->history->updateHistory($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'history has been update.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'tindakan' => $this->post('tindakan'),
            'status' => $this->post('status'),
            'riwayat_penyakit' => $this->post('riwayat_penyakit'),
            'tanggal_masuk' => $this->post('tanggal_masuk'),
            'tanggal_keluar' => $this->post('tanggal_keluar')
        ];

        if( $this->history->createHistory($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new history has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_patch()
    {
        $id = $this->patch('id_user');
        $data = [
            'tindakan' => $this->patch('tindakan'),
            'status' => $this->patch('status')
        ];
        if( $this->history->patchUser($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Status has been update.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}