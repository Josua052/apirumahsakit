<?php

class Penduduk_model extends CI_Model
{
    public function getPenduduk($id = null) 
    {
        if( $id === null ) {
            return $this->db->get('penduduk')->result_array();
        } else {
            return $this->db->get_where('penduduk', ['id_user' => $id])->result_array();
        }
      
    }
    /*
    public function deleteHistory($id_history)
    {
        $this->db->delete('history', ['id_history' => $id_history]);
        return $this->db->affected_rows();

    }
    
    */
}